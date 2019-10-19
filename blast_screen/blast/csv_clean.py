# find all different parts between biobrick and features in data_normal.csv.

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
    l_c = []
    igem_id = []
    # temporarily save the info having the same igemid
    l_e = []
    # if flag equals to 0, means it is the first row; if equals to 1, means it is just from BioBrick
    flag = 0
    k = 0
    for e in l:
        # when the current element has the same igem_id, we save them to l_e[]
        # add l_e into l_c
        k += 1
        print(k)
        if e['type'] == 'BioBrick': continue
        if e['igemid'] not in igem_id and flag != 0:
            l_e = list_dict_duplicate_removal(l_e)
            # compare if there are some differences between all and featured data
            l_c += l_e
            l_e = []
        # address type of BioBrick, we don't need biobrick, because the feature biobrick has the same purpose as the type "all".
        # Sun Jianan only save biobricks which has the same igemid with the whole igem biobrick
        li = ['All','Reporter', 'Coding', 'Composite', 'Device', 'Generator', 'Inverter', 'Measurement', 'Plasmid', 'Protein_Domain', 'Signalling', 'Translational_Unit']
        if e['type'] in li:
            igem_id.append(e['igemid'])
        # address when there is not the type of BioBrick

        values = save_into_dict(e)
        dic = dict(zip(keys, values))
        l_e.append(dic)
        flag = 1
    # for our method to judge if we get ending is to find the appearance of igemid, so we will omit the last l_e
    return l_c + l_e

def save_into_dict(e):

    values = []
    for j in range(len(keys)):
        values.append(e[keys[j]])
    return values

list1, keys = readcsv('datasets\/data_normal.csv')
list_after_scratch = scratch(list1)

i = 1
with open('datasets\/data_after_clean.csv','w', newline='') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append('new_number')
    for i in range(len(keys)):
        if i == 0:
            first_row.append('pre_number')
            continue
        first_row.append(keys[i])
    writer.writerow(first_row)
    print(first_row)
    i = 1
    for d in list_after_scratch:
        a = []
        a.append(i)
        # only add elements into a[], because the fifth and sixth elements is just used to filter.
        for j in range(len(d)):
            a.append(d[keys[j]])
        writer.writerow(a)
        print(a)
        i += 1