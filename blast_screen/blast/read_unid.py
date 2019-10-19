# get all unid and information from the test csv files from formula.py

import csv
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        i = 0
        for r in rander:
            unid = r['unid']
            a.append(unid)
            i += 1
        a = list_dict_duplicate_removal(a)
        return a, i

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

threshold = [0.4, 0.45, 0.5, 0.55, 0.6, 0.65, 0.7]
weight = []
for i in range(1,9):
    for j in range(1, 10 - i):
        w = [i * 0.1]
        w.append(j * 0.1)
        w.append((10 - i - j) * 0.1)
        weight.append(w)

j = 1
for t in threshold:
    x = []
    y = []
    max = 0
    name = ''
    for i in range(len(weight)):
        s1 = str(round(weight[i][0], 1))
        s2 = str(round(weight[i][1], 1))
        s3 = str(round(weight[i][2], 1))
        s = s1[2] + '_' + s2[2] + '_' + s3[2]
        path = 'whole\weight_modify\/test'+ str(j) + "_" + str(round(t,2)) + '_' + s1 + '_' + s2 + '_' + s3 + '.csv'
        l1,length = readcsv(path)
        print('test%d: %d; unid: %d; threshold:%f; w_id: '%(j, length, len(l1), t) +s1+'; w_score: '+s2+'; w_evalue: '+s3 )
        j += 1
