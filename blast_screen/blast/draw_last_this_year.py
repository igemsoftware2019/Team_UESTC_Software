# compare each parameter of the blast results: identity, score, evalue

import csv
import matplotlib.pyplot as plt
import matplotlib as mtp
import math
import numpy as np

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a, list(a[0].keys())

def create_y1(l1):
    v_id = []
    v_score = []
    v_evalue = []
    for i in range(len(l1)):
        v = float(l1[i]['p_id'])/100
        v_id.append(v)
        if float(l1[i]['expect']) == 0: p_evalue = 1
        else:
            p_evalue = -math.log(float(l1[i]['expect']), 10)
            p_evalue = math.log(p_evalue, 6) / 3
        v_evalue.append(p_evalue)
        p_score = float(l1[i]['score']) / (7 * int(l1[i]['hsplen']))
        v_score.append(p_score)
    m1_vid = np.mean(v_id)
    m1_vexpect = np.mean(v_evalue)
    m1_vscore = np.mean(v_score)
    l = [m1_vid, m1_vscore, m1_vexpect]
    return l

def create_y2(l2):
    v_id = []
    v_score = []
    v_evalue = []
    for l in l2:
        v_id.append(float(l['p_id']))
        v_evalue.append(float(l['p_evalue']))
        v_score.append(float(l['p_score']))
    m1_vid = np.mean(v_id)
    m1_vexpect = np.mean(v_evalue)
    m1_vscore = np.mean(v_score)
    l = [m1_vid, m1_vscore, m1_vexpect]
    return l

def draw(l1,l2,l3):
    plt.xlabel('Attribute')
    plt.ylabel('Value')
    plt.title('The comparison between last year and this year')
    labels = ['avg_p_id', 'avg_p_score', 'avg_p_evalue']
    x2 = [10,20,30]
    x3 = [11,21,31]
    x1 = [9,19,29]
    y1 = []
    y2 = []
    y3 = []
    y1 = create_y1(l1)
    y2 = create_y2(l2)
    y3 = create_y2(l3)
    plt.bar(x1, y1, facecolor='red', width=1, label='last_year')
    plt.bar(x2, y2, facecolor='blue', width=1, label='this_year',tick_label = labels)
    for x, y in zip(x1, y1):
        plt.text(x, y + 0.05, '%.3f' % y, ha='center', va='top')
    for x, y in zip(x2, y2):
        plt.text(x, y + 0.05, '%.3f' % y, ha='center', va='top')
    for x, y in zip(x2, y2):
        plt.text(x, y + 0.05, '%.3f' % y, ha='center', va='top')
    plt.legend()
    plt.savefig('whole\compare_result\/comparison.jpg')
    plt.show()
plt.style.use('ggplot')
plt.figure(figsize=(10,8))
csv_file1, keys1 = readcsv('whole\compare_result\/last_year\/exa_filt.csv')
csv_file2, keys2 = readcsv('whole\compare_result\/info_get_by_igem.csv')
csv_file3, keys3 = readcsv('whole\compare_result\/this_year\/test185_0.65_0.1_0.5_0.4.csv')

draw(csv_file1, csv_file2, csv_file3)