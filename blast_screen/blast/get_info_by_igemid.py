# get info from csv by using all igemid of last year.

import csv

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a, list(a[0].keys())


file = open('whole\compare_result\/last_year\igemid_last_year.txt', 'r')
csv_file, keys = readcsv('whole\compare_result\/this_year\/test185_0.65_0.1_0.5_0.4.csv')
igem_l = []
for f in file:
    igem_l.append(f.split('\n')[0])

i = 0
k = 0
l = []
# save relative info into l
while i < len(csv_file):
    # scan each row of igem_l to find the first fit one
    for k in range(len(igem_l)):
        if csv_file[i]['igemid'] == igem_l[k]:
            j = i
            while j < len(csv_file) and csv_file[j]['igemid'] == igem_l[k]:
                j += 1
            l += csv_file[i:j]
            i = j - 1
            del igem_l[k]
            break
    i += 1
    print(i)

with open('whole\compare_result\/info_get_by_igem.csv', 'w+', newline='', encoding='utf-8') as f:
    writer = csv.writer(f)
    writer.writerow(keys)
    for d in l:
        a=[]
        j = 0
        for j in range(len(keys)):
            a.append(d[keys[j]])
        writer.writerow(a)
        i+=1

f.close()