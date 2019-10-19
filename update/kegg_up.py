import requests
from pymysql_com import com, cur
import re

re_space = re.compile('[\s]+')
re_rn = re.compile('R[0-9]+')
re_cpd = re.compile('\[CPD:.*\]')

class UpdateKegg:
    def __init__(self, count_funs, count_funs_als):
        self.count_funs = count_funs
        self.count_funs_als = count_funs_als

    def updatekegg(self):
        self.unikegg()
        self.count_f()
        self.kegg1()
        self.count_f()
        self.kegg1_2()
        self.count_f()
        self.kegg1_3()
        self.count_f()
        self.kegg2()
        self.count_f()
        self.kegg3()
        self.count_f()
        self.kegg1_alldbs()
        self.count_f()
        self.kegg1_brite()
        self.count_f()
        self.kegg1_disease()
        self.count_f()
        self.kegg1_drug()
        self.count_f()
        self.kegg1_module()
        self.count_f()
        self.kegg1_network()
        self.count_f()
        self.kegg1_motif()
        self.count_f()
        self.kegg1_org()
        self.count_f()
        self.kegg1_pathway()
        self.count_f()
        self.kegg1_position()
        self.count_f()
        self.kegg1_structure()
        self.count_f()
        self.kegg1_tax()
        self.count_f()
        self.kegg2_alldbs()
        self.count_f()
        self.kegg2_brite()
        self.count_f()
        self.kegg2_disease()
        self.count_f()
        self.kegg2_module()
        self.count_f()
        self.kegg2_pathway()
        self.count_f()
        self.kegg3_alldbs()
        self.count_f()
        self.kegg3_allreac()
        self.count_f()
        self.kegg3_class()
        self.count_f()
        self.kegg3_ko()
        self.count_f()
        self.kegg3_pathway()
        self.count_f()
        self.kegg3_product()
        self.count_f()
        self.kegg3_substrate()
        self.count_f()
        self.kegg_reference()
        self.count_f()
        return [int(self.count_funs), int(self.count_funs_als)]

    def count_f(self):
        self.count_funs = self.count_funs - 1
        if self.count_funs < 0:
            self.count_funs_als = self.count_funs_als + 1
        with open('count_funs.txt', 'w', encoding='utf8') as fs:
            fs.write(str(self.count_funs_als))

    def unikegg(self):
        if not self.count_funs > 0:
            sql = 'select distinct uniid from igemuni where uniid not in (select uniid from unikegg)'
            cur.execute(sql)
            res = cur.fetchall()
            url = 'http://rest.kegg.jp/conv/genes/uniprot:'
            count = 0
            c = 1
            a = 1
            for re in res:
                if count < 10:
                    if a == 1:
                        url = url + re[0]
                        a = a + 1
                    else:
                        url = url + '+uniprot:' + re[0]
                    count = count + 1
                elif count == 10 or c == len(res):
                    print(url)
                    try:
                        rs = requests.get(url)
                    except:
                        rs = ''
                    else:
                        for r in rs.text.split('\n'):
                            if r:
                                print(r.split('\t')[0])
                                print(r.split('\t')[1])
                                sql = 'insert into unikegg values("%s","%s");' % (
                                str(r.split('\t')[0][3:]), str(r.split('\t')[1]))
                                com(sql)
                    url = 'http://rest.kegg.jp/conv/genes/uniprot:' + re[0]
                    a = 2
                    count = 1
                c = c + 1

            print(url)
            try:
                rs = requests.get(url)
            except:
                rs = ''
            else:
                for r in rs.text.split('\n'):
                    if r:
                        print(r.split('\t')[0])
                        print(r.split('\t')[1])
                        sql = 'insert into unikegg values("%s","%s");' % (str(r.split('\t')[0][3:]), str(r.split('\t')[1]))
                        com(sql)

    def kegg1(self):
        if not self.count_funs > 0:
            sql = 'select distinct keggid from unikegg where keggid not in (select keggid from kegg1)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for f in res:
                kegg = {}
                f = f[0].replace('\n', '').strip()
                if f:
                    url = 'http://rest.kegg.jp/get/' + f
                    print(url)
                    while True:
                        r = requests.get(url, timeout=10)
                        if r:
                            break
                    if r.status_code == 200:
                        r.encoding = r.apparent_encoding
                        txt = r.text.split('\n')
                        for t in txt:
                            if t != '///' and t:
                                if t[0] != ' ':
                                    a, b = 0, 0
                                    tag = ''
                                    for x in t:
                                        if x != ' ':
                                            a = a + 1
                                        else:
                                            break
                                    for x in t[a:]:
                                        if x == ' ':
                                            b = b + 1
                                        else:
                                            break
                                    tag = t[:a]
                                    kegg[tag] = t[a + b:]
                                else:
                                    kegg[tag] = kegg[tag] + '\n' + t[a + b:]
                        ta_k, ta_v = 'keggid', '"' + f + '"'
                        for k, v in kegg.items():
                            print(k + ':' + v)
                            ta_k = ta_k + ',' + k
                            ta_v = ta_v + ',"' + v.replace('"', '\\"') + '"'
                        sql = 'insert into kegg1(' + ta_k + ')' + ' values(' + ta_v + ');'
                        com(sql)

                    else:
                        with open('e\\e.txt', 'a', encoding='utf-8') as file:
                            file.write(str(r.status_code) + '\n' + url + '\n')

                print(count)
                count = count + 1

    def kegg1_2(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where orthology != "" and keggid not in (select keggid from kegg1_ko)'
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                url = 'http://rest.kegg.jp/link/ko/' + r[0]
                print(url)
                respons = requests.get(url)
                if respons.status_code == 200:
                    respons.encoding = respons.apparent_encoding
                    txt = respons.text.split('\n')
                    for t in txt:
                        if t:
                            sql = 'insert into kegg1_ko values("%s","%s")' % (t.split('\t')[0], t.split('\t')[1].split(':')[1])
                            print(sql)
                            com(sql)

    def kegg1_3(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where orthology != "" and keggid not in (select id from ecs)'
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                url = 'http://rest.kegg.jp/link/enzyme/' + r[0]
                print(url)
                respons = requests.get(url)
                if respons.status_code == 200:
                    respons.encoding = respons.apparent_encoding
                    txt = respons.text.split('\n')
                    for t in txt:
                        if t:
                            sql = 'insert into ecs values("%s","%s")' % (t.split('\t')[0], t.split('\t')[1].split(':')[1])
                            print(sql)
                            com(sql)

            sql = 'select uniid,ecnumber from uni_domain where ecnumber != ""'
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                txt = r[1][:-1].split(';')
                for t in txt:
                    if t:
                        sql = 'insert into ecs values("%s","%s")' % (r[0], t)
                        print(sql)
                        com(sql)

            sql = 'select uniid,ecnumber from uni_recommendedname where ecnumber != ""'
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                txt = r[1][:-1].split(';')
                for t in txt:
                    if t:
                        sql = 'insert into ecs values("%s","%s")' % (r[0], t)
                        print(sql)
                        com(sql)

    def kegg2(self):
        if not self.count_funs > 0:
            sql = 'select distinct koid from kegg1_ko where koid != "" and koid not in (select koid from kegg2)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for fff in res:
                ff = fff[0].split(';')
                for f in ff:
                    kegg = {}
                    f = f.replace('\n', '')
                    if f:
                        url = 'http://rest.kegg.jp/get/ko:' + f
                        print(url)
                        while True:
                            try:
                                r = requests.get(url, timeout=300)
                            except Exception as e:
                                with open('e//e.txt', 'a', encoding='utf-8') as file:
                                    file.write(str(e) + '\n' + url + '\n')
                                break
                            else:
                                break
                        if r:
                            if r.status_code == 200:
                                r.encoding = r.apparent_encoding
                                txt = r.text.split('\n')
                                for t in txt:
                                    if t != '///' and t:
                                        if t[0] != ' ':
                                            a, b = 0, 0
                                            tag = ''
                                            for x in t:
                                                if x != ' ':
                                                    a = a + 1
                                                else:
                                                    break
                                            for x in t[a:]:
                                                if x == ' ':
                                                    b = b + 1
                                                else:
                                                    break
                                            tag = t[:a]
                                            kegg[tag] = t[a + b:]
                                        else:
                                            kegg[tag] = kegg[tag] + '\n' + t[a + b:]
                                ta_k, ta_v = 'koid', '"' + f + '"'
                                for k, v in kegg.items():
                                    ta_k = ta_k + ',' + k
                                    ta_v = ta_v + ',"' + v.replace('"', '\\"') + '"'
                                sql = 'insert into kegg2(' + ta_k.lower() + ')' + ' values(' + ta_v + ');'
                                print(sql)
                                com(sql)

                            else:
                                with open('e\\e.txt', 'a', encoding='utf-8') as file:
                                    file.write(str(r.status_code) + '\n' + url + '\n')

                print(count)
                count = count + 1

    def kegg3(self):
        if not self.count_funs > 0:
            sql = 'select distinct ecnumber from ecs where ecnumber not like "%-%" and ecnumber not like "%n%" ' \
                  'and ecnumber not in (select ecnumber from kegg3)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for rrff in res:
                f = rrff[0]
                kegg = {}
                f = f.replace('\n', '')
                if f:
                    url = 'http://rest.kegg.jp/get/enzyme:' + f
                    print(url)
                    while True:
                        r = requests.get(url)
                        if r:
                            break
                    if r.status_code == 200:
                        r.encoding = r.apparent_encoding
                        txt = r.text.split('\n')
                        for t in txt:
                            if t != '///' and t:
                                if t[0] != ' ':
                                    a, b = 0, 0
                                    tag = ''
                                    for x in t:
                                        if x != ' ':
                                            a = a + 1
                                        else:
                                            break
                                    for x in t[a:]:
                                        if x == ' ':
                                            b = b + 1
                                        else:
                                            break
                                    tag = t[:a]
                                    kegg[tag] = r'%s' % t[a + b:]
                                else:
                                    kegg[tag] = kegg[tag] + '\n' + r'%s' % t[a + b:]
                        ta_k, ta_v = 'ecnumber', '"' + f + '"'
                        for k, v in kegg.items():
                            ta_k = ta_k + ',' + k
                            ta_v = ta_v + ',"' + v.replace('"', '\\"') + '"'
                        sql = 'insert into kegg3(' + ta_k.lower() + ')' + ' values(' + ta_v + ');'
                        print(sql)
                        com(sql)

                    else:
                        with open('e\\e.txt', 'a', encoding='utf-8') as file:
                            file.write(str(r.status_code) + '\n' + url + '\n')

                print(count)
                count = count + 1

    def kegg1_alldbs(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where (alldbs = "" or alldbs is null) and dblinks != ""'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.genome.jp/dbget-bin/get_linkdb?' + r[0].replace(':', '+')
                sql = 'update kegg1 set alldbs = "%s" where keggid = "%s"' % (url, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg1_brite(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where (brite_url = "" or brite_url is null) and brite != ""'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                brite_url = 'https://www.kegg.jp/kegg-bin/search_brite?option=-a&search_string=%s&prefix=%s' % (
                r[0].split(':')[1],
                r[0].split(':')[0])
                sql = 'update kegg1 set brite_url = "%s" where keggid = "%s"' % (brite_url, r[0])
                print(sql)
                com(sql)
                print(count)
                count = count + 1

    def kegg1_disease(self):
        if not self.count_funs > 0:
            sql = 'select keggid,disease from kegg1 where disease != "" and keggid not in (select keggid from kegg1_disease)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                print(r[1])
                txt = r[1].split('\n')
                for t in txt:
                    rows = re.split(re_space, t)
                    diid = rows[0]
                    dise = ''
                    for row in rows[1:]:
                        if dise:
                            dise = dise + ' ' + row
                        else:
                            dise = row
                    dise_url = 'https://www.kegg.jp/dbget-bin/www_bget?ds:' + diid
                    sql = 'insert into kegg1_disease values("%s","%s","%s","%s")' % (r[0], diid, dise_url, dise)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg1_drug(self):
        if not self.count_funs > 0:
            sql = 'select keggid,drug_target from kegg1 where drug_target != "" and keggid not in (select keggid from kegg1_drug_target_1)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                print(r[0])
                txt = r[1].split('\n')
                for t in txt:
                    xtx = t.split(':')
                    dr = xtx[0]
                    sql = 'insert into kegg1_drug_target_1 values("%s","%s")' % (r[0], dr)
                    if len(xtx) > 1:
                        drids = re.split(re_space, xtx[1].strip())
                        print(sql)
                        com(sql)
                        for drid in drids:
                            url = 'https://www.kegg.jp/dbget-bin/www_bget?dr:' + drid
                            sql = 'insert into kegg1_drug_target_2 values("%s","%s","%s","%s")' % (r[0], dr, drid, url)
                            print(sql)
                            com(sql)

                print(count)
                count = count + 1

    def kegg1_module(self):
        if not self.count_funs > 0:
            sql = 'select keggid,module from kegg1 where module != "" and keggid not in (select keggid from kegg1_module)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    moid = xtx[0]
                    url = 'https://www.kegg.jp/kegg-bin/show_module?%s+%s' % (moid, r[0].split(':')[1])
                    mo = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            if mo:
                                mo = mo + ' ' + x
                            else:
                                mo = x
                    sql = 'insert into kegg1_module values("%s","%s","%s","%s")' % (r[0], moid, url, mo)
                    print(sql)
                    com(sql)

                    print(count)
                    count = count + 1

    def kegg1_network(self):
        if not self.count_funs > 0:
            sql = 'select keggid,network from kegg1 where network != "" and keggid not in (select keggid from kegg1_network)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    neid = xtx[0]
                    if 'nt' in neid:
                        url = 'https://www.kegg.jp/kegg-bin/show_network?' + neid
                    else:
                        url = 'https://www.kegg.jp/dbget-bin/www_bget?ne:' + neid
                    network = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            network = network + ' ' + x
                    network = network.strip()
                    sql = 'insert into kegg1_network values("%s","%s","%s","%s")' % (r[0], neid, url, network)
                    print(sql)
                    com(sql)
                print(count)
                count = count + 1

    def kegg1_motif(self):
        if not self.count_funs > 0:
            sql = 'select keggid,motif from kegg1 where motif != "" and keggid not in (select keggid from kegg1_motif)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = re.split(re_space, r[1])
                for t in txt[1:]:
                    motif_url = 'https://www.genome.jp/dbget-bin/www_bget?pfam:' + t
                    sql = 'insert into kegg1_motif values("%s","%s","%s","%s")' % (r[0], 'Pfam', t, motif_url)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg1_org(self):
        if not self.count_funs > 0:
            sql = 'select keggid,organism from kegg1 where (organism_short,organism_full,organism_url)=("","","")'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = re.split(re_space, r[1].strip())
                org_s = txt[0]
                org_u = 'https://www.kegg.jp/kegg-bin/show_organism?org=' + org_s
                org_f = ''
                for t in txt[1:]:
                    org_f = org_f + ' ' + t
                org_f = org_f.strip()
                sql = 'update kegg1 set organism_short = "%s", organism_full = "%s", organism_url = "%s" where keggid = "%s"' % (
                    org_s, org_f, org_u, r[0])
                print(sql)
                com(sql)
                print(count)
                count = count + 1

    def kegg1_pathway(self):
        if not self.count_funs > 0:
            sql = 'select keggid,pathway from kegg1 where pathway != "" and keggid not in (select keggid from kegg1_pathway)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt_1s = r[1].split('\n')
                for txt_1 in txt_1s:
                    txt = re.split(re_space, txt_1)
                    pathid = txt[0]
                    path_url = 'https://www.kegg.jp/kegg-bin/show_pathway?' + pathid + '+' + r[0].split(':')[1]
                    pathway = ''
                    for t in txt[1:]:
                        pathway = pathway + ' ' + t
                    pathway = pathway[1:]
                    sql = 'insert into kegg1_pathway values("%s","%s","%s","%s")' % (r[0], pathid, path_url, pathway)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg1_position(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where (position_url is Null or position_url = "") and position != ""'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                tag = 0
                c = 0
                url = 'https://www.kegg.jp/kegg-bin/show_genomemap?ORG=%s&ACCESSION=%s' % (
                r[0].split(':')[0], r[0].split(':')[1])
                print(url)
                while True:
                    try:
                        response = requests.get(url)
                    except:
                        pass
                    else:
                        if response.status_code == 200:
                            tag = 200
                            break
                        elif response.status_code == 404:
                            tag = 404
                            break
                    c = c + 1
                    if c == 1:
                        break
                if tag == 200:
                    sql = 'update kegg1 set position_url = "%s" where keggid = "%s"' % (url, r[0])
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg1_structure(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where structure != "" and (structure_url = "" or structure_url is null)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.genome.jp/dbget-bin/pdb_list.cgi?' + r[0]
                sql = 'update kegg1 set structure_url = "%s" where keggid = "%s"' % (url, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg1_tax(self):
        if not self.count_funs > 0:
            sql = 'select keggid,taxonomy from kegg1 where taxonomy != "" and ((tax_id,tax_lin) = ("","") or (tax_id is null and tax_lin is null))'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                txid = txt[0]
                txlin = ''
                if len(txt) > 1:
                    for x in txt[1:]:
                        txlin = txlin + x
                txlin = txlin.strip()
                sql = 'update kegg1 set tax_id="%s",tax_lin="%s" where keggid = "%s"' % (txid, txlin, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg2_alldbs(self):
        if not self.count_funs > 0:
            sql = 'select koid from kegg2 where dblinks != "" and (alldbs = "" or alldbs is null)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.genome.jp/dbget-bin/get_linkdb?orthology+' + r[0]
                sql = 'update kegg2 set alldbs = "%s" where koid = "%s"' % (url, r[0])
                com(sql)

                print(count)
                count = count + 1

    def kegg2_brite(self):
        if not self.count_funs > 0:
            sql = 'select koid from kegg2 where brite != "" and (brite_url = "" or brite_url is null)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.kegg.jp/kegg-bin/search_brite?option=-a&search_string=' + r[0]
                sql = 'update kegg2 set brite_url = "%s" where koid = "%s"' % (url, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg2_disease(self):
        if not self.count_funs > 0:
            sql = 'select koid,disease from kegg2 where disease != "" and koid not in (select koid from kegg2_disease)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    deid = xtx[0]
                    de_url = 'https://www.kegg.jp/dbget-bin/www_bget?ds:' + deid
                    de_s = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            de_s = de_s + ' ' + x
                        de_s = de_s.strip()
                    sql = 'insert into kegg2_disease values("%s","%s","%s","%s")' % (r[0], deid, de_url, de_s)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg2_module(self):
        if not self.count_funs > 0:
            sql = 'select koid,module from kegg2 where module != "" and koid not in (select koid from kegg2_module)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    deid = xtx[0]
                    de_url = 'https://www.kegg.jp/kegg-bin/show_module?%s+%s' % (deid, r[0])
                    de_s = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            de_s = de_s + ' ' + x
                        de_s = de_s.strip()
                    sql = 'insert into kegg2_module values("%s","%s","%s","%s")' % (r[0], deid, de_url, de_s)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg2_pathway(self):
        if not self.count_funs > 0:
            sql = 'select koid,pathway from kegg2 where pathway != "" and koid not in (select koid from kegg2_pathway)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    deid = xtx[0]
                    de_url = 'https://www.kegg.jp/kegg-bin/show_pathway?%s+%s' % (deid, r[0])
                    de_s = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            de_s = de_s + ' ' + x
                        de_s = de_s.strip()
                    sql = 'insert into kegg2_pathway values("%s","%s","%s","%s")' % (r[0], deid, de_url, de_s)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg3_alldbs(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber from kegg3 where dblinks != "" and ecnumber not like "%-%"'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.genome.jp/dbget-bin/get_linkdb?enzyme+' + r[0]
                sql = 'update kegg3 set alldbs = "%s" where ecnumber = "%s"' % (url, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg3_allreac(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber,all_reac from kegg3 where all_reac != "" and ecnumber not like "%-%" and (all_reac_url = "" or all_reac_url is null)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.kegg.jp/dbget-bin/www_bget?reaction'
                txt = r[1].split('\n')
                print(r[0])
                for t in txt:
                    xtx = re.split(re_space, t)
                    for x in xtx:
                        sp = re.search(re_rn, x)
                        if sp:
                            reac = x[sp.span()[0]:sp.span()[1]]
                            print(reac)
                            url = url + '+' + reac
                print(url)
                sql = 'update kegg3 set all_reac_url = "%s" where ecnumber = "%s";' % (url, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg3_class(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber from kegg3 where class != "" and ecnumber not like "%-%" and (class_url is null or class_url = "")'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'https://www.kegg.jp/kegg-bin/get_htext?htext=ko01000&option=-a&query=' + r[0]
                sql = 'update kegg3 set class_url = "%s" where ecnumber = "%s"' % (url, r[0])
                print(sql)
                com(sql)

                print(count)
                count = count + 1

    def kegg3_ko(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber,orthology from kegg3 where ecnumber not in (select ecnumber from kegg3_ko) and orthology != "" and ecnumber not like "%-%"'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    koid = xtx[0]
                    url = 'https://www.kegg.jp/dbget-bin/www_bget?ko:' + koid
                    ko = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            ko = ko + ' ' + x
                        ko = ko.strip()
                    sql = 'insert into kegg3_ko values("%s","%s","%s","%s")' % (r[0], koid, url, ko)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg3_pathway(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber,pathway from kegg3 where pathway != "" and ecnumber not like "%-%" and ecnumber not in (select ecnumber from kegg3_pathway)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    xtx = re.split(re_space, t)
                    koid = xtx[0]
                    url = 'https://www.kegg.jp/kegg-bin/show_pathway?%s+%s' % (koid, r[0])
                    ko = ''
                    if len(xtx) > 1:
                        for x in xtx[1:]:
                            ko = ko + ' ' + x
                        ko = ko.strip()
                    sql = 'insert into kegg3_pathway values("%s","%s","%s","%s")' % (r[0], koid, url, ko)
                    print(sql)
                    com(sql)

                print(count)
                count = count + 1

    def kegg3_product(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber,product from kegg3 where product != "" and ecnumber not like "%-%" and ecnumber not in (select ecnumber from kegg3_product)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    if t:
                        cpd_sp = re.search(re_cpd, t)
                        cpd = t.replace(';', '').strip()
                        cpdid = ''
                        cpd_url = ''
                        if cpd_sp:
                            cpdid = t[cpd_sp.span()[0]: cpd_sp.span()[1]][5:-1]
                            cpd_url = 'https://www.kegg.jp/dbget-bin/www_bget?cpd:' + cpdid
                            cpd = t[:cpd_sp.span()[0]].strip()
                        sql = 'insert into kegg3_product values("%s","%s","%s","%s")' % (r[0], cpd, cpdid, cpd_url)
                        print(sql)
                        com(sql)

                print(count)
                count = count + 1

    def kegg3_substrate(self):
        if not self.count_funs > 0:
            sql = 'select ecnumber,substrate from kegg3 where substrate != "" and ecnumber not like "%-%" and ecnumber not in (select ecnumber from kegg3_substrate)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                txt = r[1].split('\n')
                for t in txt:
                    if t:
                        cpd_sp = re.search(re_cpd, t)
                        cpd = t.replace(';', '').strip()
                        cpdid = ''
                        cpd_url = ''
                        if cpd_sp:
                            cpdid = t[cpd_sp.span()[0]: cpd_sp.span()[1]][5:-1]
                            cpd_url = 'https://www.kegg.jp/dbget-bin/www_bget?cpd:' + cpdid
                            cpd = t[:cpd_sp.span()[0]].strip()
                        sql = 'insert into kegg3_substrate values("%s","%s","%s","%s")' % (r[0], cpd, cpdid, cpd_url)
                        print(sql)
                        com(sql)

                print(count)
                count = count + 1

    def kegg_reference(self):
        if not self.count_funs > 0:
            sql = 'select keggid from kegg1 where reference != "" and keggid not in (select kke from kegg_reference)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'http://rest.kegg.jp/get/' + r[0]
                print(url)
                rp = requests.get(url)
                if rp.status_code == 200:
                    rp.encoding = rp.apparent_encoding
                    txt = rp.text.split('\n')
                    txt = txt[:-2]
                    a = 0
                    b = len(txt) + 1
                    for t in txt:
                        xtx = re.split(re_space, t)
                        if xtx[0] == 'REFERENCE':
                            ref = {}
                            b = a
                            reid = ''
                            for x in xtx[1:]:
                                reid = reid + ' ' + x
                            ref[xtx[0]] = reid.strip()
                        elif xtx[0] == '' and a > b:
                            if t[2] != ' ':
                                info = ''
                                for x in xtx[2:]:
                                    info = info + ' ' + x
                                info = info.strip()
                                tag = xtx[1]
                                ref[tag] = info
                            elif t[2] == ' ':
                                infoo = ' '.join(xtx[1:])
                                info = info + '\n' + infoo
                                info = info.strip()
                                ref[tag] = info
                            if (a < len(txt) - 1 and txt[a + 1][0] != ' ') or (a == len(txt) - 1):
                                b = len(txt) + 1
                                tab_k = 'kke'
                                tab_v = '"' + r[0] + '"'
                                for k, v in ref.items():
                                    tab_k = tab_k + ',' + k
                                    tab_v = tab_v + ',"' + v + '"'
                                sql = 'insert into kegg_reference(%s) values(%s)' % (tab_k, tab_v)
                                print(sql)
                                com(sql)
                        a = a + 1

                print(count)
                count = count + 1

            sql = 'select koid from kegg2 where reference != "" and koid not in (select kke from kegg_reference)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'http://rest.kegg.jp/get/ko:' + r[0]
                print(url)
                rp = requests.get(url)
                if rp.status_code == 200:
                    rp.encoding = rp.apparent_encoding
                    txt = rp.text.split('\n')
                    txt = txt[:-2]
                    a = 0
                    b = len(txt) + 1
                    for t in txt:
                        xtx = re.split(re_space, t)
                        if xtx[0] == 'REFERENCE':
                            ref = {}
                            b = a
                            reid = ''
                            for x in xtx[1:]:
                                reid = reid + ' ' + x
                            ref[xtx[0]] = reid.strip()
                        elif xtx[0] == '' and a > b:
                            if t[2] != ' ':
                                info = ''
                                for x in xtx[2:]:
                                    info = info + ' ' + x
                                info = info.strip()
                                tag = xtx[1]
                                ref[tag] = info
                            elif t[2] == ' ':
                                infoo = ' '.join(xtx[1:])
                                info = info + '\n' + infoo
                                info = info.strip()
                                ref[tag] = info
                            if (a < len(txt) - 1 and txt[a + 1][0] != ' ') or (a == len(txt) - 1):
                                b = len(txt) + 1
                                tab_k = 'kke'
                                tab_v = '"' + r[0] + '"'
                                for k, v in ref.items():
                                    tab_k = tab_k + ',' + k
                                    tab_v = tab_v + ',"' + v + '"'
                                sql = 'insert into kegg_reference(%s) values(%s)' % (tab_k, tab_v)
                                print(sql)
                                com(sql)
                        a = a + 1

                print(count)
                count = count + 1

            sql = 'select ecnumber from kegg3 where reference != "" and ecnumber not in (select kke from kegg_reference)' \
                  'and ecnumber not like "%-%"'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                url = 'http://rest.kegg.jp/get/enzyme:' + r[0]
                print(url)
                rp = requests.get(url)
                if rp.status_code == 200:
                    rp.encoding = rp.apparent_encoding
                    txt = rp.text.split('\n')
                    txt = txt[:-2]
                    a = 0
                    b = len(txt) + 1
                    for t in txt:
                        xtx = re.split(re_space, t)
                        if xtx[0] == 'REFERENCE':
                            ref = {}
                            b = a
                            reid = ''
                            for x in xtx[1:]:
                                reid = reid + ' ' + x
                            ref[xtx[0]] = reid.strip()
                        elif xtx[0] == '' and a > b:
                            if t[2] != ' ':
                                info = ''
                                for x in xtx[2:]:
                                    info = info + ' ' + x
                                info = info.strip()
                                tag = xtx[1]
                                ref[tag] = info
                            elif t[2] == ' ':
                                infoo = ' '.join(xtx[1:])
                                info = info + '\n' + infoo
                                info = info.strip()
                                ref[tag] = info
                            if (a < len(txt) - 1 and txt[a + 1][0] != ' ') or (a == len(txt) - 1):
                                b = len(txt) + 1
                                tab_k = 'kke'
                                tab_v = '"' + r[0] + '"'
                                for k, v in ref.items():
                                    tab_k = tab_k + ',' + k
                                    tab_v = tab_v + ',"' + v.replace('"', '\\"') + '"'
                                sql = 'insert into kegg_reference(%s) values(%s)' % (tab_k, tab_v)
                                print(sql)
                                com(sql)
                        a = a + 1

                print(count)
                count = count + 1