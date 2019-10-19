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
        # 1（igemid），5（unid），3+10（4: start position of whole seq，11: inner start position），11（length）
        if l1[1] == l2[i][1] and l1[5] == l2[i][5] and ( int(l1[3]) + int(l1[10]) ) == ( int(l2[i][3]) + int(l2[i][10])) and l1[11] == l2[i][11]:
            del l2[i]
            if f == 0:
                flag += add
                f = 1
            continue
        i += 1
    return l2, flag

# additional function
def inter_compare(l1, l2, l3):
    # using the idea of binary: 1,2,4. we can find what we want by their sum
    s = ""
    l_1 = []
    l_2 = []
    l_3 = []
    i = 0
    while i < len(l1):
        ll1 = l1[i]
        flag = 1
        l = []
        # delete repeat rows in l1.
        l_head = l1[ : i + 1]
        l_tail, flag = scan_row(ll1, l1[ i + 1 : ], flag, 0)
        l1 = l_head + l_tail
        # scan l2, l3 to find if there is a row looks same as ll1
        l2, flag = scan_row(ll1, l2, flag, 2)
        l3, flag = scan_row(ll1, l3, flag, 4)
        if flag == 7: s = "id, evalue, score"
        if flag == 5: s = "id, score"
        if flag == 3: s = "id, evalue"
        if flag == 1: s = "id"
        l.append(s)
        for ll in ll1:
            l.append(ll)
        l_1.append(l)
        i += 1

    i = 0
    while i < len(l2):
        flag = 2
        l = []
        # delete repeat rows in l2.
        l_head = l2[: i + 1]
        l_tail, flag = scan_row(l2[i], l2[i + 1:], flag, 0)
        l2 = l_head + l_tail
        l3, flag = scan_row(l2[i], l3, flag, 4)
        if flag == 6: s ="evalue, score"
        if flag == 2: s ="evalue"
        l.append(s)
        for ll in l2[i]:
            l.append(ll)
        l_2.append(l)
        i += 1

    i = 0
    while i < len(l3):
        l = []
        l_head = l3[: i + 1]
        l_tail, _ = scan_row(l3[i], l3[i + 1:], 0, 0)
        l3 = l_head + l_tail
        l.append("score")
        for ll in l3[i]:
            l.append(ll)
        l_3.append(l)
        i += 1

    return l_1 + l_2 + l_3

def list_merge(l1, l2 ,l3, igemid):
    l = []
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
            length2 = len(arr_del)
        if len(l3) > 0:
            l_e, arr_del = insert_del(l3, id, l_e)
            l3 = del_used(arr_del, l3)
        l_e = inter_compare(l_e[:length1], l_e[length1:length1+length2], l_e[length1+length2:])
        for le in l_e:
            l.append(le)
    return l


list_id, keys = readcsv('whole\/data_identity.csv')
list_evalue, _ = readcsv('whole\/data_expect.csv')
list_score, _ = readcsv('whole\/data_score.csv')
igemid = readtxt('whole\/data_total_igemid.txt')
key = []
key.append("source")
for k in keys:
    key.append(k)
list1 = list_merge(list_id, list_evalue, list_score, igemid)

i = 1
with open('whole\/data_merge_id_evalue_score.csv','w', newline='') as f:
    writer = csv.writer(f)
    first_row = []
    for j in range(len(key)):
        if key[j] == ' ': first_row.append('pre_num')
        else: first_row.append(key[j])
    writer.writerow(first_row)
    for d in list1:
        writer.writerow(d)
        i += 1