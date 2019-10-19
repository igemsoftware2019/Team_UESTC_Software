# normalize our data.csv
import csv
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a, list(a[0].keys())

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

def scratch(l):
    values = []
    for e in l:
        # when the current element has the same igem_id, we save them to l_e[]
        values.append(normalize_data(e))
    return values

def normalize_data(e):

    values = []
    e['igemid'] = e['igemid'].replace(' ', '')
    e['type'] = e['type'].replace(' ', '')
    e['length'] = 3 * int(e['length'])
    for j in range(len(keys)):
        values.append(e[keys[j]])
    return values

list1, keys = readcsv('datasets\/data.csv')
list_normal = scratch(list1)

with open('datasets\/data_normal.csv','w', newline='') as f:
    writer = csv.writer(f)
    writer.writerow(keys)
    print(keys)
    for d in list_normal:
        a = []
        # only add elements into a[]
        for j in range(len(d)):
            a.append(d[j])
        writer.writerow(a)
        print(a)