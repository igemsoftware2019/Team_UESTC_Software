# scratch rows whose identities are less than 0.85
import csv

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a,list(a[0].keys())

list1,keys = readcsv('datasets\/data_normal.csv')
list2 = []
list3 = []
for a in list1:
    if float(a['identity'])<0.4: list2.append(a)
    else: list3.append(a)

i = 1
with open('datasets\/data_filter_.4.csv','w') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append('new_number')
    for j in range(len(keys)):
        if j == 0:
            first_row.append('pre_number')
            continue
        first_row.append(keys[j])
    writer.writerow(first_row)
    for d in list2:
        a = []
        a.append(i)
        for j in range(len(d)):
            a.append(d[keys[j]])
        writer.writerow(a)
        print(a)
        i += 1
    print(first_row)
