# test different formula parameters and modify the weight of each parameter every time.

from functools import reduce
import pylab as pl
import csv
import math

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a, list(a[0].keys())

def modify_weight(l, w1, w2, w3, threshold):
    l_modify = []
    for le in l:
        p_score = float(le['score'])/(7 * int(le['hsplen']))
        p_id = float(le['identity'])
        if le['expect'] == '0.0': p_evalue = 1
        else:
            p_evalue = -math.log(float(le['expect']), 10)
            p_evalue = math.log(p_evalue, 6) / 3
        #     the smaller, the better
        result = p_id * w1 + p_score * w2 + p_evalue * w3
        if result > threshold:
            l_add = []
            l_add.append(p_id)
            l_add.append(w1)
            l_add.append(p_score)
            l_add.append(w2)
            l_add.append(p_evalue)
            l_add.append(w3)
            l_add.append(result)
            l_add.append(threshold)
            l_add += le.values()
            l_modify.append(l_add)
    return l_modify, count

list, key = readcsv('whole\/data_merge_id_evalue_score.csv')
keys = ['p_id', 'w1', 'p_score', 'w2', 'p_evalue', 'w3', 'result', 'threshold']
keys += key
threshold = [0.75,0.8,0.85,0.9]
weight = []
for i in range(1,9):
    for j in range(1, 10 - i):
        w = [i * 0.1]
        w.append(j * 0.1)
        w.append((10 - i - j) * 0.1)
        weight.append(w)

l = []
count = []
for t in threshold:
    for i in range(len(weight)):
        ll, count_e = modify_weight(list, weight[i][0], weight[i][1], weight[i][2], t)
        count.append(count_e)
        l.append(ll)

for j in range(1, len(l) + 1):
    filename = 'whole\weight_modify\/test'+ str(j+252) + "_" \
               + str(round(l[j-1][0][7],2)) + "_" \
               + str(round(l[j-1][0][1],1)) + "_" \
               + str(round(l[j-1][0][3],1)) + "_" \
               + str(round(l[j-1][0][5],1)) + '.csv'
    with open(filename,'w+', newline = '') as f:
        writer = csv.writer(f)
        first_row = []
        for k in keys:
            first_row.append(k)
        writer.writerow(first_row)
        for d in l[j - 1]:
            writer.writerow(d)
    length = len(l[j - 1])
    print('test%d: %d; threshold:%f; w_id:%f; w_score:%f; w_evalue:%f;'%(j+252, length, l[j-1][0][7], l[j-1][0][1], l[j-1][0][3], l[j-1][0][5]))
