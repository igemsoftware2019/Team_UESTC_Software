# data after update has some differences, so we should give some detailed information and save them as csv files

import csv
import copy
def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a

def compare(l1,l2):
    list_dif = []
    list_same = []
    i = 0
    # remark there is a row save into list_same
    for l in l1:
        flag = 0
        for ll in l2:
            if ll['igemid'] == l['igemid'] and ll['unid'] == l['unid'] and ll['start_gene'] == l['start_gene']:
                list_same.append(l)
                flag = 1
                break
        if flag != 1:
            list_dif.append(l)
            print(i)
            i += 1
    return list_same, list_dif

list1 = readcsv('datasets\/data.csv')
list2 = readcsv('datasets\/data_old.csv')
keys = []
for k in list1[0].keys():
    keys.append(k)
list_same, list_dif = compare(list1, list2)

i = 1
with open('datasets\/data_differ.csv','w') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append(' ')
    for j in range(len(keys)):
        first_row.append(keys[j])
    writer.writerow(first_row)
    print(first_row)
    for d in list_dif:
        a = []
        a.append(i)
        for v in d.values():
            a.append(v)
        writer.writerow(a)
        i += 1
i = 1
with open('datasets\/data_same.csv','w') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append(' ')
    for j in range(len(keys)):
        first_row.append(keys[j])
    writer.writerow(first_row)
    print(first_row)
    for d in list_same:
        a = []
        a.append(i)
        for v in d.values():
            a.append(v)
        writer.writerow(a)
        i += 1