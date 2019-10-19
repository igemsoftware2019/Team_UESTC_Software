# provide normal distribution about 4 attributes about recommendation.

import csv
import numpy as np
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        b = []
        c = []
        d = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(int(r['part_use']))
            b.append(int(r['word_ammount']))
            c.append(int(r['reference_ammount']))
            d.append(int(r['submit_time']))
        l = [a, b, c, d]
        return l

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

def draw_lines(bins, y, amount,color):
    i = 0
    sum = 0
    for i in range(len(y)):
        sum += y[i]
        if sum > amount: break
    plt.vlines(bins[i], 0, 0.02, color, '--', label='value: '+ str(round(bins[i],4)))
    return bins[i]

def split_section(l, flag):
    m = max(l)
    mu = np.mean(l)
    sigma = np.std(l)
    bins_interval = 1
    bins = range(min(l), max(l) + bins_interval - 1, bins_interval)
    # origin data

    n, bins, patches = plt.hist(l, bins, rwidth=0.9, normed=True, facecolor='blue')
    # fitting function
    y = mlab.normpdf(bins, mu, sigma)
    s = sum(y)
    t = []
    for i in range(1,10):
        t.append(draw_lines(bins, y, s * 0.1 * i, 'r'))
    plt.plot(bins, y, 'y--')
    plt.xlabel('Number')
    plt.ylabel('Probability')
    plt.title(flag +' - histogram: $\mu$ = ' + str(round(mu, 3)) + ', $\sigma$ =' + str(round(sigma, 3)))
    plt.legend()
    plt.subplots_adjust(left=0.15)
    plt.savefig('recommendation\/' + flag + '.jpg')
    return t

def Main():
    l= readcsv('recommendation/parts_recom.csv')
    plt.style.use('ggplot')
    key = ['part_use', 'word_ammount', 'reference_ammount', 'submit_time']
    t = []
    for i in range(len(l)):
        plt.figure(figsize=(20,8))
        t.append(split_section(l[i], key[i]))
        plt.show()
Main()