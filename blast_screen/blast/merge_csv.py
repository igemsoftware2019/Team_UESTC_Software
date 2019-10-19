# if have feature, remove biobrick; if have no feature, save biobrick
from functools import reduce
import csv
keys = ['igemid', 'unid', 'start', 'length', 'start_gene', 'stop_gene']

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

def scratch(l):
    l_c = []
    igem_id = []
    # temporary save the info having the same igemid
    l_e = []
    # if flag equals to 0, means it is the first row; if equals to 1, means it is just from BioBrick
    flag = 0
    k = 0
    for e in l:
        # when the current element has the same igem_id, we save them to l_e[]
        # add l_e into l_c,
        if e['igemid'] == '': continue
        if e['igemid'] not in igem_id and flag != 0:
            l_e = list_dict_duplicate_removal(l_e)
            l_c += l_e
            igem_id.append(e['igemid'])
            l_e = []
        # address type of BioBrick
        if flag == 0:
            flag = 1
            igem_id.append(e['igemid'])
        if e['igemid'] in igem_id:
            values = save_into_dict(e)
            dic = dict(zip(keys, values))
            l_e.append(dic)
        print(k)
        k += 1
    l_e = list_dict_duplicate_removal(l_e)
    l_c += l_e
    return l_c

def save_into_dict(e):
    values = []
    values.append(e['igemid'])
    values.append(e['unid'])
    start = int(e['start_gene']) + int(e['query_start']) - 1
    values.append(start)
    values.append(e['length'])
    return values

list1 = readcsv('datasets\/data_after_clean.csv')
list_after_scratch = scratch(list1)

i = 1
with open('datasets\/data_after_merge.csv','w') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append(' ')
    for j in range(len(keys)-2):
        first_row.append(keys[j])
    writer.writerow(first_row)
    print(first_row)
    for d in list_after_scratch:
        a = []
        a.append(i)
        # only add 4 elements into a[], because the fifth and sixth elements is just used to filter.
        for j in range(4):
            a.append(d[keys[j]])
        writer.writerow(a)
        print(a)
        i += 1