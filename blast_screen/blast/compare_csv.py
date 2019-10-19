# if have feature, remove biobrick and only save the most accurate result; if have no feature, save biobrick

import csv
from functools import reduce
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
        e['igemid'] = e['igemid'].replace(' ', '')
        e['type'] = e['type'].replace(' ','')
        # add l_e into l_c,
        if e['igemid'] not in igem_id and flag != 0:
            l_e = list_dict_duplicate_removal(l_e)
            l_c += l_e
            l_e = []
        # address type of BioBrick
        if e['type'] == 'BioBrick':
            flag = 1
            # default flag is 0, means we don't need to modify the start and stop position
            values = save_into_dict(e)
            dic = dict(zip(keys, values))
            l_e.append(dic)
            igem_id.append(e['igemid'])
        # address when there is not the type of BioBrick
        else:
            # f is a flag, which means we did not find more than 1 result from the same gene part in l_e[]
            f = 0
            if flag == 1:
                flag = 2
                l_e = []
            # here, we don't need more than two results because we just can get one protein in a gene part given by feature
            for i in range(len(l_e)):
                if e['start_gene'] == l_e[i]['start_gene'] and e['stop_gene'] == l_e[i]['stop_gene']:
                    f = 1
            if f != 1:
                values = save_into_dict(e)
                dic = dict(zip(keys, values))
                l_e.append(dic)
        print(k)
        k += 1
    return l_c

def save_into_dict(e):

    values = []
    values.append(e['igemid'])
    values.append(e['unid'])
    start = int(e['start_gene']) + int(e['query_start']) - 1
    values.append(start)
    length = 3 * int(e['length'])
    values.append(length)
    values.append(e['start_gene'])
    values.append(e['stop_gene'])
    return values

list1 = readcsv('datasets\/data.csv')
list_after_scratch = scratch(list1)

i = 1
with open('datasets\/data_after_address.csv','w') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append(' ')
    for i in range(len(keys)-2):
        first_row.append(keys[i])
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