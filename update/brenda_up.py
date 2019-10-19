# -*- coding: utf-8 -*-
from SOAPpy import Client
import hashlib
import MySQLdb
import re
import sys

re_sp = re.compile('#(?=ecNumber\*|application\*|commentary\*|organism\*|literature\*|engineering\*|ic50Value\*|'
                   'ic50ValueMaximum\*|inhibitor\*|ligandStructureId\*|kmValue\*|kmValueMaximum\*|substrate\*|role\*|'
                   'ligand\*|localization\*|idGo\*|textmining\*|metalsIons\*|molecularWeight\*|molecularWeightMaximum\*|'
                   'naturalSubstrates\*|organismNaturalSubstrates\*|commentaryNaturalSubstrates\*|naturalProducts\*|'
                   'commentaryNaturalProducts\*|organismNaturalProducts\*|reversibility\*|organicSolvent\*|'
                   'oxidationStability\*|pathway\*|link\*|source_database\*|phOptimum\*|phOptimumMaximum\*|'
                   'phRange\*|phRangeMaximum\*|phStability\*|phStabilityMaximum\*|piValue\*|piValueMaximum\*|'
                   'reference\*|authors\*|title\*|journal\*|volume\*|pages\*|year\*|pubmedId\*|sourceTissue\*|'
                   'specificActivity\*|specificActivityMaximum\*|storageStability\*|substrates\*|commentarySubstrates\*|'
                   'literatureSubstrates\*|organismSubstrates\*|products\*|commentaryProducts\*|literatureProducts\*|'
                   'organismProducts\*|synonyms\*|temperatureOptimum\*|temperatureOptimumMaximum\*|temperatureRange\*|'
                   'temperatureRangeMaximum\*|temperatureStability\*|temperatureStabilityMaximum\*|inhibitors\*|'
                   'recommendedName\*|goNumber\*|reaction\*)')

con = MySQLdb.connect('localhost', 'root', 'sjn990329..', 'a')
cur = con.cursor()

def com(sql):
    try:
        cur.execute(sql)
    except Exception as e:
        with open('e/e.txt', 'a') as file:
            file.write(str(e) + '\n' + sql + '\n')
    else:
        con.commit()

class UpdateBrenda:
    def __init__(self, count_funs, count_funs_als):
        self.count_funs = count_funs
        self.count_funs_als = count_funs_als

    def updatebrenda(self):
        funcs = ['getApplication', 'getCrystallization', 'getEngineering', 'getIc50Value', 'getInhibitors', 'getKmValue',
                 'getLigands', 'getLocalization', 'getMetalsIons', 'getMolecularWeight', 'getNaturalSubstratesProducts',
                 'getOrganicSolventStability', 'getOxidationStability', 'getPathway', 'getPhOptimum', 'getPhRange',
                 'getPhStability', 'getPiValue', 'getPurification', 'getReference', 'getSourceTissue',
                 'getSpecificActivity', 'getStorageStability', 'getSubstratesProducts', 'getSynonyms',
                 'getTemperatureOptimum', 'getTemperatureRange', 'getTemperatureStability', 'getRecommendedName',
                 'getReaction']
        for func in funcs:
            print(self.count_funs)
            print(func)
            self.cli(func)
            self.count_f()

    def count_f(self):
        self.count_funs = self.count_funs - 1
        if self.count_funs < 0:
            self.count_funs_als = self.count_funs_als + 1
        with open('count_funs.txt', 'wb+') as fs:
            fs.write(str(self.count_funs_als))

    def ins_to_mysql(self, resultstring, tablename):
        txt = resultstring.split('#!')
        for t in txt:
            xtx = re.split(re_sp, t)
            ta_k = ''
            ta_v = ''
            for x in xtx:
                ta_k = ta_k + ',' + x.split('*')[0].lower().replace('inhibitors', 'inhibitor')
                ta_v = ta_v + ',"' + '*'.join(x.split('*')[1:]).replace('"', '\\"') + '"'
            ta_k = ta_k[1:]
            ta_v = ta_v[1:]
            sql = 'insert into %s(%s) values(%s);' % (tablename, ta_k, ta_v)
            print sql.encode('utf-8')
            com(sql)

    def cli(self, tname):
        if not self.count_funs > 0:
            sql = 'select distinct ecnumber from ecs where ecnumber not in (select ecnumber from %s)' % tname[3:].lower()
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                resultString = ''
                print r[0]
                url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
                password = hashlib.sha256("sjnbrenda").hexdigest()
                parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
                client = Client.SOAPProxy(url)
                try:
                    exec 'resultString = client.%s(parameters)' % tname
                except Exception as e:
                    with open('e/e.txt', 'a') as file:
                        file.write(tname+'\n'+str(e)+'\n'+parameters+'\n')
                else:
                    if resultString:
                        self.ins_to_mysql(resultString[:-1], tname[3:].lower())

count_fun = sys.argv[1]
count_fun_als = sys.argv[2]
br = UpdateBrenda(int(count_fun), int(count_fun_als))
br.updatebrenda()

'''
sql = 'select ecnumber from ecs'
cur.execute(sql)
res = cur.fetchall()
count = 1
for r in res:
    print r[0]
    url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
    password = hashlib.sha256("sjnbrenda").hexdigest()
    parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
    client = Client.SOAPProxy(url)
    resultString = client.getApplication(parameters)
    txt = resultString.split('#!')
    for t in txt:
        print t

    print count

    count = count + 1
'''

'''
getApplication
getCrystallization
getEngineering
getIc50Value
getInhibitors
getKmValue
getLigands
getLocalization
getMetalsIons
getMolecularWeight
getNaturalSubstratesProducts
getOrganicSolventStability
getOxidationStability
getPathway
getPhOptimum
getPhRange
getPhStability
getPiValue
getPurification
getReference
getSourceTissue
getSpecificActivity
getStorageStability
getSubstratesProducts
getSynonyms
getTemperatureOptimum
getTemperatureRange
getTemperatureStability
'''

'''
    def getApplication(self):
        sql = 'select distinct ecnumber from ecs where ecnumber not in (select ecnumber from application)'
        cur.execute(sql)
        res = cur.fetchall()
        for r in res:
            print r[0]
            url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
            password = hashlib.sha256("sjnbrenda").hexdigest()
            parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
            client = Client.SOAPProxy(url)
            resultString = client.getApplication(parameters)
            if resultString:
                self.ins_to_mysql(resultString, 'application')

    def getCrystallization(self):
        sql = 'select distinct ecnumber from ecs where ecnumber not in (select ecnumber from crystallization)'
        cur.execute(sql)
        res = cur.fetchall()
        for r in res:
            print r[0]
            url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
            password = hashlib.sha256("sjnbrenda").hexdigest()
            parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
            client = Client.SOAPProxy(url)
            resultString = client.getCrystallization(parameters)
            if resultString:
                self.ins_to_mysql(resultString, 'crystallization')

    def getEngineering(self):
        sql = 'select distinct ecnumber from ecs where ecnumber not in (select ecnumber from engineering)'
        cur.execute(sql)
        res = cur.fetchall()
        for r in res:
            print r[0]
            url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
            password = hashlib.sha256("sjnbrenda").hexdigest()
            parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
            client = Client.SOAPProxy(url)
            resultString = client.getEngineering(parameters)
            if resultString:
                self.ins_to_mysql(resultString, 'engineering')

    def getIc50Value(self):
        sql = 'select distinct ecnumber from ecs where ecnumber not in (select ecnumber from ic50value)'
        cur.execute(sql)
        res = cur.fetchall()
        for r in res:
            print r[0]
            url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
            password = hashlib.sha256("sjnbrenda").hexdigest()
            parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
            client = Client.SOAPProxy(url)
            resultString = client.getIc50Value(parameters)
            if resultString:
                self.ins_to_mysql(resultString, 'ic50value')

    def getInhibitors(self):
        sql = 'select distinct ecnumber from ecs where ecnumber not in (select ecnumber from ic50value)'
        cur.execute(sql)
        res = cur.fetchall()
        for r in res:
            print r[0]
            url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
            password = hashlib.sha256("sjnbrenda").hexdigest()
            parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'
            client = Client.SOAPProxy(url)
            resultString = client.getInhibitors(parameters)
            if resultString:
                self.ins_to_mysql(resultString, 'ic50value')
'''

"""
#!/usr/bin/python2
# -*- coding: cp936 -*-
from __future__ import print_function
import string
import hashlib
from SOAPpy import Client ## for usage without WSDL file
import re
import time
import sys
start =time.clock()
import MySQLdb
con = MySQLdb.connect('localhost', 'root', 'sjn990329..', 'a')
cur = con.cursor()
sql = 'select ecnumber from ecs where ecnumber not like "%-%"'
cur.execute(sql)
res = cur.fetchall()
j = 0

for r in res:
    url = "https://www.brenda-enzymes.org/soap/brenda_server.php"
    password = hashlib.sha256("sjnbrenda").hexdigest()
    parameters = "648059716@qq.com," + password + ",ecNumber*" + str(r[0]) + '#'

    print(password)
    print(parameters)

    client = Client.SOAPProxy(url)
    print(client)
    resultString = client.getOrganicSolventStability(parameters)



#3b72fd60014b5147a3bf8a34106cf0d17cc1b9c5157206e5a812599744d74b9b

'''
with open ('EC.txt') as files:
    for str in files:
        str = str.replace('\n','').replace('\r','').replace('','')
        endpointURL = "https://www.brenda-enzymes.org/soap/brenda_server.php"
        password = hashlib.sha256("656301000").hexdigest()
        parameters = "coffeeliii@163.com," + password + ",ecNumber*" + str + "#"
        print(parameters)

client = Client.SOAPProxy(endpointURL)
        jj = 0 ; resultString = ''
        while jj <= 4:
            #jj += 1
            try:
                resultString = client.getOrganicSolventStability(parameters)
            except:
                jj += 1
            else:
                jj += 1
            if resultString :
                break
        if jj == 5 and resultString == '':
            continue
        #print(resultString);print('**',len(resultString),end='*');print(jj)
        sd = resultString.split('!')
        for i in sd:
            #print(i)
            oy_s = i.split('#')
            k = 0
            strp=''
            for t in oy_s:
                ts = t.split('*')[1:]
                scl = ''
                for s in ts:
                    if scl :
                        scl = scl + '*' + s
                    else :
                        scl = s
                strp = strp + '$' + scl
            file_handle = open('getOrganicSolventStability.txt', mode='a')
            try:
                file_handle.write(strp + '\n')
            except:
                continue
            else:
                j += 1
                print(j)
                print(strp)
            file_handle.close()
end = time.clock()
print('Running time: %s Seconds' % (end - start))
'''
"""