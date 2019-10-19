# find all unid that

import csv
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            unid = r['unid']
            a.append(unid)
        a = list_dict_duplicate_removal(a)
        return a

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

l1 = readcsv('datasets\/data.csv')
l2 = readcsv('datasets\/data_filter_left_accuracy.csv')
print("data: %d" % len(l1))
print("data_filter_left_accuracy: %d" % len(l2))

def compare(l1,l2):
    list_dif = []
    list_same = []
    i = 0
    # remark there is a row save into list_same
    for l in l2:
        if l in l1:
            list_same.append(l)
            continue
        list_dif.append(l)
        print(i)
        i += 1
    return list_same, list_dif

list_same, list_dif = compare(l1, l2)

with open('datasets\/data_filter_differ_unid.txt','w') as f:
    for d in list_dif:
        f.write(d)
        f.write('\n')

with open('datasets\/data_filter_same_unid.txt','w') as f:
    for d in list_same:
        f.write(d)
        f.write('\n')