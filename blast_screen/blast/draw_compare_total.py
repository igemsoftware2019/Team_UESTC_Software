# compare each value of the blast results

import csv
import matplotlib.pyplot as plt
import matplotlib as mtp
import math
from functools import reduce
import numpy as np

def readcsv(path):
    with open(path,'r') as f:
        a = []
        b = []
        rander = csv.DictReader(f)
        i = 0
        for r in rander:
            igemid = r['igemid']
            unid = r['unid']
            a.append(unid)
            b.append(igemid)
            i += 1
        a = list_dict_duplicate_removal(a)
        b = list_dict_duplicate_removal(b)
        return i, len(a), len(b)

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

def draw(l):
    plt.xlabel('Attribute')
    plt.ylabel('Value')
    plt.title('The comparison between last year and this year')
    labels = ['amount_reflection', 'amount_unid', 'amount_igemid']

    x1 = [1, 31, 61]
    x2 = [4, 34, 64]
    x3 = [7, 37, 67]
    x4 = [10, 40, 70]
    x5 = [13, 43, 73]
    x6 = [16, 46, 76]
    x7 = [19, 49, 79]
    x8 = [22, 52, 82]

    y1 = l[0:3]
    y2 = l[3:6]
    y3 = l[6:9]
    y4 = l[9:12]
    y5 = l[12:15]
    y6 = l[15:18]
    y7 = l[18:21]
    y8 = l[21:24]

    plt.bar(x1, y1, facecolor='red', width=2, label='thre_0.5')
    plt.bar(x2, y2, facecolor='blue', width=2, label='thre_0.55')
    plt.bar(x3, y3, facecolor='red', width=2, label='thre_0.6')
    plt.bar(x4, y4, facecolor='blue', width=2, label='thre_0.65')
    plt.bar(x5, y5, facecolor='red', width=2, label='thre_0.7',tick_label = labels)
    plt.bar(x6, y6, facecolor='blue', width=2, label='thre_0.75')
    plt.bar(x7, y7, facecolor='red', width=2, label='thre_0.8')
    plt.bar(x8, y8, facecolor='blue', width=2, label='thre_0.85')

    for x, y in zip(x1, y1):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x2, y2):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x3, y3):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x4, y4):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x5, y5):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x6, y6):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x7, y7):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')
    for x, y in zip(x8, y8):
        plt.text(x, y + 1000, '%d' % y, ha='center', va='top')

    plt.legend()
    plt.savefig('whole\compare_result\/comparison_threshold.jpg')
    plt.show()

def Main():
    plt.style.use('ggplot')
    plt.figure(figsize=(20,8))

    amount_len_cur1, amount_unid_cur1, amount_igemid_cur1 = readcsv('whole\weight_modify/test77_0.5_0.1_0.5_0.4.csv')
    amount_len_cur2, amount_unid_cur2, amount_igemid_cur2 = readcsv('whole\weight_modify/test113_0.55_0.1_0.5_0.4.csv')
    amount_len_cur3, amount_unid_cur3, amount_igemid_cur3 = readcsv('whole\weight_modify/test149_0.6_0.1_0.5_0.4.csv')
    amount_len_cur4, amount_unid_cur4, amount_igemid_cur4 = readcsv('whole\weight_modify/test185_0.65_0.1_0.5_0.4.csv')
    amount_len_cur5, amount_unid_cur5, amount_igemid_cur5 = readcsv('whole\weight_modify/test221_0.7_0.1_0.5_0.4.csv')
    amount_len_cur6, amount_unid_cur6, amount_igemid_cur6 = readcsv('whole\weight_modify/test257_0.75_0.1_0.5_0.4.csv')
    amount_len_cur7, amount_unid_cur7, amount_igemid_cur7 = readcsv('whole\weight_modify/test293_0.8_0.1_0.5_0.4.csv')
    amount_len_cur8, amount_unid_cur8, amount_igemid_cur8 = readcsv('whole\weight_modify/test329_0.85_0.1_0.5_0.4.csv')

    l =[amount_len_cur1, amount_unid_cur1, amount_igemid_cur1,
        amount_len_cur2, amount_unid_cur2, amount_igemid_cur2,
        amount_len_cur3, amount_unid_cur3, amount_igemid_cur3,
        amount_len_cur4, amount_unid_cur4, amount_igemid_cur4,
        amount_len_cur5, amount_unid_cur5, amount_igemid_cur5,
        amount_len_cur6, amount_unid_cur6, amount_igemid_cur6,
        amount_len_cur7, amount_unid_cur7, amount_igemid_cur7,
        amount_len_cur8, amount_unid_cur8, amount_igemid_cur8]
    draw(l)

Main()