import pymysql
import csv

# non-feature text given by Jianan Sun
# file = open('chu_bla_re.txt', 'r')

file = open('datasets/blast_re_test.txt', 'r')
# file = open('datasets/chu_bla_re.txt', 'r')

ds = []
k = 1
# k is a flag which remark that we get the ordered keys
keys = []

for fs in file:
    fs = fs.replace('OrderedDict([','{')
    fs = fs.replace('])','}')
    fs = fs.replace('}{', '}\n{')
    with open('datasets/data.csv', 'w+', encoding='utf-8') as f:
        f.write(fs)
    fs = fs.split('\n')
    for f in fs:
        f = f.replace('\',','\':')
        f = f.replace(')','')
        f = f.replace('(','')
        ds.append(eval(f))
        if k == 1:
            f = f.replace('{','')
            ff = f.split(',')
            i = 0
            # 11 means the length of a dictionary
            for i in range(14):
                ff1 = ff[i].split(':')[0]
                ff1 = ff1.split('\'')[1]
                keys.append(ff1)
            k = 0
i=1

with open('datasets/data.csv', 'w+', encoding='utf-8') as f:
    writer = csv.writer(f)
    first_row = []
    first_row.append(' ')
    for val in keys:
        first_row.append(val)
    writer.writerow(first_row)
    print(first_row)
    for d in ds:
        a=[]
        a.append(i)
        j = 0
        for j in range(14):
            a.append(d[keys[j]])
        writer.writerow(a)
        i+=1
        print(i)


