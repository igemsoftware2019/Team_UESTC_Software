import csv
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            type = r['type'].replace(' ', '')
            a.append(type)
            a = list_dict_duplicate_removal(a)
        return a

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

list = readcsv('datasets\/data_normal.csv')
print(len(list))
print(list)