import numpy as np
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt
import csv
import math
import scipy.stats as stats
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            if r['expect'] == '0.0':
                p_evalue = 1
            else:
                p_evalue = -math.log(float(r['expect']), 10)
            a.append(p_evalue)
        return a

def norm(l,s):
    plt.figure(dpi=100)
    mu = np.mean(l)
    sigma = np.std(l)
    n, bins, patches = plt.hist(l, 100, rwidth=0.9, normed=True, facecolor = 'blue')
    y = mlab.normpdf(bins,mu,sigma)
    sum = 0
    middle = 0
    for i in range(len(y)):
        if sum > 0.5:
            middle = bins[i]
            break
        else:
            sum+=y[i]*(bins[1]-bins[0])

    plt.plot(bins,y, label = 'middle: %.3f' %middle)
    plt.xlabel('E-Value')
    plt.ylabel('Probability')
    plt.title('histogram: $\mu$ = ' + str(round(mu, 3)) + ', $\sigma$ = '+str(round(sigma,3)))
    plt.legend()
    plt.savefig('whole\/' + s + '.jpg')

list1 = readcsv('whole\/data_merge_id_evalue_score.csv')
norm(list1, 'evalue_mid_log')