from Bio.Blast import NCBIXML
import pymysql
from functools import reduce
from collections import OrderedDict
import copy
import math
import re as e

class A_X:

    def formula(self,le):
        p_score = float(le['score']) / (7 * int(le['hsplen']))
        p_id = float(le['identity'])
        if le['expect'] == 0.0:
            p_evalue = 1
        else:
            p_evalue = -math.log(float(le['expect']), 10)
            p_evalue = math.log(p_evalue, 6) / 3
        # the smaller, the better
        result = p_id * 0.1 + p_score * 0.5 + p_evalue * 0.4
        return result

    def Main(self,s):
        result = open("datasets\/blast_origin_data\/whole_seq.xml",'rb')
        file = open("datasets\/blast_result_test_"+ s +".txt", 'w')
        file.close()

        # only use one sequence to blast, then you can use the following command to get your blast result
        # bla = NCBIXML.read(result)
        fs = []
        # if you use mutiple sequences to blast, you should use the next sentence to get your result
        blast_results = NCBIXML.parse(result)
        # p is the label of our iteration number
        p = 0
        for bla in blast_results:
            # re is the part of our current iteration block
            re = []
            # save origin data into hh{}
            for ali in bla.alignments:
                for hsp in ali.hsps:

                    # get a ordered dictionary, which can be clear for us to do some reports
                    hh = OrderedDict()
                    hh['igemid'] = ''
                    hh['type'] = ''
                    hh['start_gene'] = ''
                    hh['stop_gene'] = ''
                    hh['unid'] = ali.title.split('|')[3]
                    hh['score'] = hsp.score
                    hh['expect'] = hsp.expect
                    hh['alilen'] = ali.length
                    hh['hsplen'] = hsp.align_length
                    hh['query_start'] = hsp.query_start
                    # hh['length'] is the length of current nucl sequence
                    hh['length'] = hsp.query_end - hsp.query_start + 1
                    hh['query_stop'] = hsp.query_end
                    # hsp.query is the protein sequence translated by current nucl query sequence
                    hh['identities'] = hsp.identities
                    hh['identity'] = hsp.identities / hh['hsplen']
                    hh['query'] = hsp.query
                    re.append(hh)
            a = 0
            while a < len(re):
                b = a + 1
                result1 = A_X1.formula(re[a])
                if result1 < 0.65: del re[a]
                else:
                    while b < len(re):
                        result2 = A_X1.formula(re[b])
                        if result2 < 0.65:
                            del re[b]
                            continue
                        elif result2 > result1:
                            c = re[b]
                            re[b] = re[a]
                            re[a] = c
                        b = b + 1
                    a = a + 1

            a = 0
            for r in re:
                b = a + 1
                for rr in re[b:]:
                    # delete the detected gene given by blast. and find the next one
                    if r['query_start'] >= rr['query_start'] and r['query_start'] <= rr['query_stop']:
                        if rr['query_stop'] >= r['query_stop']:
                            del re[b]
                        else:
                            # overl: the length that different genes cover each other
                            overl = rr['query_stop'] - r['query_start'] + 1
                            if overl >= r['length'] * 0.1:
                                del re[b]
                            else:
                                b = b + 1
                    elif r['query_stop'] <= rr['query_start'] and r['query_stop'] >= rr['query_stop'] and r['start'] <= rr['start']:
                        if rr['length'] > r['length'] * 0.1:
                            del re[b]
                    elif r['query_stop'] >= rr['query_start'] and r['query_stop'] <= rr['query_stop']:
                        overl = r['query_stop'] - rr['query_start'] + 1
                        if overl >= r['length'] * 0.1:
                            del re[b]
                        else:
                            b = b + 1
                    else:
                        b = b + 1
                a = a + 1

            file = open("whole\/blast_result_"+ s +".txt", 'a+', encoding='utf-8')
            for r in re:
                if r['expect'] < 0.00001:
                    # only when we use deepcopy, the address of f will not change
                    f = copy.deepcopy(r)
                    igemid = bla.query.split(':')[1]
                    f['igemid'] = igemid.split(';')[0].replace(' ', '')
                    type = bla.query.split(':')[2]
                    f['type'] = type.split(';')[0].replace(' ', '')
                    start = bla.query.split(':')[3]
                    f['start_gene'] = start.split(';')[0].replace(' ', '')
                    stop = bla.query.split(':')[4]
                    f['stop_gene'] = stop.split(';')[0].replace(' ', '')
                    fs.append(f)
                    p += 1
            print(p)

        fs = self.list_dict_duplicate_removal(fs)

        for f in fs:
            file.write(str(f))
        file.close()

    def list_dict_duplicate_removal(self,data_list):
        run_function = lambda x, y: x if y in x else x + [y]
        return reduce(run_function, [[], ] + data_list)

A_X1 = A_X()
A_X1.Main('formula')
