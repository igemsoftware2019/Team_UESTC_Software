# if have feature, remove biobrick and only save the most accurate result; if have no feature, save biobrick

import csv
from functools import reduce
keys = ['igemid', 'unid', 'start', 'length']

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

def remove_similar(re):
    a = 0
    for r in re:
        b = a + 1
        for rr in re[b:]:
            # delete the detected gene given by blast. and find the next one
            if r['igemid'] != rr['igemid'] or r['unid'] != rr['unid']: continue
            if r['start'] >= rr['start'] and r['start'] <= rr['start'] + rr['length']:
                if rr['start'] + rr['length'] >= r['start'] + r['length']:
                    del re[b]
                else:
                    # overl: the length that different genes cover each other
                    overl = rr['start'] + rr['length'] - r['start'] + 1
                    if overl >= r['length'] * 0.1:
                        del re[b]
                    else:
                        b = b + 1
            elif r['start'] + r['length'] >= rr['start'] and r['start'] + r['length'] >= rr['start'] + rr['length'] and r['start'] <= rr['start']:
                if rr['length'] > r['length'] * 0.1:
                    del re[b]
            elif r['start'] + r['length'] >= rr['start'] and r['start'] + r['length'] <= rr['start'] + rr['length']:
                overl = r['start'] + r['length'] - rr['start'] + 1
                if overl >= r['length'] * 0.1:
                    del re[b]
                else:
                    b = b + 1
            else:
                b = b + 1
        a = a + 1
    return re

def scratch(l):
    l_c = []
    igem_id = []
    # temporary save the info having the same igemid
    l_e = []
    # if flag equals to 0, means it is the first row; if equals to 1, means it is just from BioBrick
    k = 0
    flag = 0
    # if f = 0, means we can are at the first row of a part using the same igemid
    f = 0
    for e in l:
        # when the current element has the same igem_id, we save them to l_e[]
        # add l_e into l_c
        if e['igemid'] not in igem_id and flag != 0:
            l_e = list_dict_duplicate_removal(l_e)
            l_e = remove_similar(l_e)
            l_c += l_e
            l_e = []
            f = 0
        if f == 0:
            igem_id.append(e['igemid'])
            f = 1
        if flag == 0: flag = 1
        values = save_into_dict(e)
        dic = dict(zip(keys, values))
        l_e.append(dic)
        print(k)
        k += 1
    l_e = list_dict_duplicate_removal(l_e)
    l_e = remove_similar(l_e)
    l_c += l_e
    return l_c

def save_into_dict(e):

    values = []
    values.append(e['igemid'])
    values.append(e['unid'])
    start = int(e['start_gene']) + int(e['query_start']) - 1
    values.append(start)
    values.append(int(e['length']))
    return values

list1 = readcsv('whole\data_formula.csv')
list_after_scratch = scratch(list1)

with open('whole\/data_formula_for_uniprot_quchong.csv','w', newline = '') as f:
    writer = csv.writer(f)
    first_row = []
    for i in range(len(keys)):
        first_row.append(keys[i])
    writer.writerow(first_row)
    print(first_row)
    for d in list_after_scratch:
        a = []
        # only add 4 elements into a[], because the fifth and sixth elements is just used to filter.
        for j in range(4):
            a.append(d[keys[j]])
        writer.writerow(a)
        print(a)