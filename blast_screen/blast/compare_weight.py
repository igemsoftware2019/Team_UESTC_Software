# merge three csv into one csv, easier for us to compare.
from functools import reduce
import csv

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a, a[0].keys()

# get all igemid from text
def readtxt(path):
    igemid = []
    f = open(path,'r')
    for ff in f:
        igemid.append(ff.replace('\n',''))
    return igemid

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

def save_into_dict(e):
    values = []
    for j in range(1,len(key)):
        values.append(e[key[j]])
    return values

# find all rows has the same igemid
def insert_del(l, id, l_e):
    i = 0
    # include what we want to delete after this function
    arr_del = []
    # include rows satisfy our conditions in l
    while len(l) > i:
        if l[i]['igemid'] == id:
            # insert row into l_e
            e = save_into_dict(l[i])
            l_e.append(e)
            arr_del.append(i)
        i += 1
    return l_e, arr_del

# delete rows which are added into l_e
def del_used(arr_del, l):
    for num in arr_del[::-1]:
        del l[num]
    return l

# scan each row and find the same 2 seq, delete one
def scan_row(l1,l2, flag, add):
    i = 0
    # when f equals to 0, means this row is firstly mated, otherwise, it was mated, so we don't need to count.
    f = 0
    # delete all of the rows
    while i < len(l2):
        # 10（igemid），14（unid），12+19（12: start position of whole seq，19: inner start position), 20（length）
        if l1[10] == l2[i][10] and l1[14] == l2[i][14] and ( int(l1[12]) + int(l1[19]) ) == ( int(l2[i][12]) + int(l2[i][19])) and l1[20] == l2[i][20]:
            del l2[i]
            if f == 0:
                flag += add
                f = 1
            continue
        i += 1
    return l2, flag

# additional function
def inter_compare(l1, l2):
    # using the idea of binary: 1,2,4. we can find what we want by their sum
    s = ""
    l_1 = []
    l_2 = []

    i = 0
    while i < len(l1):
        flag = 1
        l = []
        # return a list which has been deleted the same info, only left the differ rows
        l2, flag = scan_row(l1[i], l2, flag, 2)
        # if flag == 3: s ="181, 154"
        if flag == 1:
            s ="181"
            l.append(s)
            for ll in l1[i]:
                l.append(ll)
            l_1.append(l)
        i += 1

    i = 0
    while i < len(l2):
        l = []
        l.append("154")
        for ll in l2[i]:
            l.append(ll)
        l_2.append(l)
        i += 1

    return l_1 + l_2

def list_merge(l1, l2, igemid):
    l = []
    i = 1
    # order by igemid
    for id in igemid:
        l_e = []
        if len(l1) > 0:
            l_e, arr_del = insert_del(l1, id, l_e)
            l1 = del_used(arr_del, l1)
            length1 = len(arr_del)
        if len(l2) > 0:
            l_e, arr_del = insert_del(l2, id, l_e)
            l2 = del_used(arr_del, l2)
        l_e = inter_compare(l_e[:length1], l_e[length1:])
        for le in l_e:
            l.append(le)
        print(i)
        i += 1
    return l


list_181, keys = readcsv('whole\weight_modify/test188_0.65_0.1_0.8_0.1.csv')
list_154, _ = readcsv('whole\weight_modify/test185_0.65_0.1_0.5_0.4.csv')
igemid = readtxt('whole\/data_total_igemid.txt')
key = []
key.append("weight")
for k in keys:
    key.append(k)
list1 = list_merge(list_181, list_154, igemid)

i = 1
with open('whole\/differ_154_181.csv','w', newline='') as f:
    writer = csv.writer(f)
    first_row = []
    for j in range(len(key)):
        if key[j] == ' ': first_row.append('pre_num')
        else: first_row.append(key[j])
    writer.writerow(first_row)
    for d in list1:
        writer.writerow(d)
        i += 1