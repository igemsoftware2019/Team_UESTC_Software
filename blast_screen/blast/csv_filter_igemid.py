# find all igemid that their identity are less 0.4

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

# l1 = readcsv('datasets\/data_filter_.4.csv')

# with open('datasets\/data_filter_differ_igemid.txt','w') as f:
#     for d in l1:
#         f.write(d)
#         f.write('\n')

l1 = readcsv('test\/data_id.csv')
print(len(l1))