# read igemid csv and save the igemid into txt

import csv
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        i = 0
        for r in rander:
            igemid = r['igemid']
            a.append(igemid)
            i += 1
        a = list_dict_duplicate_removal(a)
        return a, i

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

path = 'whole\compare_result\/this_year\/test185_0.65_0.1_0.5_0.4.csv'
l1,length = readcsv(path)
outputpath = 'whole\compare_result\/this_year\igemid_this_year.txt'
with open(outputpath,'w+', newline = '') as f:
    for d in l1:
        f.write(d)
        f.write('\n')
f.close()