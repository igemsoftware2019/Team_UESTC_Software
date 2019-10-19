import numpy as np
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt
import csv
import scipy.stats as stats
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            result = float(r['result'])
            a.append(result)
        return a

def draw_lines(bins, y, amount,color):
    i = 0
    sum = 0
    for i in range(len(y)):
        sum += y[i]
        if sum > amount: break
    plt.vlines(bins[i], 0, 20, color, '--', label='threshold: '+ str(round(bins[i],4)))
    return bins[i]

def poisson_func(l,s):

    mu = np.mean(l)
    sigma = np.std(l)
    # origin data
    n, bins, patches = plt.hist(l, 100, rwidth=0.9, normed=True, facecolor = 'blue')
    max = 0
    lam = 0
    x = []
    for p in range(len(n)):
        if max < n[p]:
            max = n[p]
            lam = bins[p]
        if p % 5 !=0: x.append(bins[p]*1.25)
    # fitting function
    xx = range(0,80)
    y = stats.poisson.pmf(xx, mu = int(lam*80))
    plt.plot(x, y/(bins[1] - bins[0]), color = 'r')
    t = draw_lines(bins, y, 0.15, 'r')
    t2 = draw_lines(bins, y, 0.1, 'y')
    t3 = draw_lines(bins, y, 0.05, 'g')
    plt.xlabel('Result')
    plt.ylabel('Probability')
    plt.title('histogram: $λ$ = '+str(round(lam,3)))
    plt.legend()
    plt.subplots_adjust(left = 0.15)
    plt.savefig('whole\/'+ s +'.png')
    return t, t2, t3

weight = []
for i in range(1,9):
    for j in range(1, 10 - i):
        w = [i * 0.1]
        w.append(j * 0.1)
        w.append((10 - i - j) * 0.1)
        weight.append(w)
plt.style.use('ggplot')
threshold1 = []
threshold2 = []
threshold3 = []
for i in range(len(weight)):
    plt.figure(dpi=100)
    s = str(round(weight[i][0],1)) +'_'+ str(round(weight[i][1],1)) +'_'+ str(round(weight[i][2],1))
    list1= readcsv('whole\weight_modify/test_'+ s + '.csv')
    t1, t2, t3 = poisson_func(list1,s)
    threshold1.append(t1)
    threshold2.append(t2)
    threshold3.append(t3)
print('mean of 15%:')
print(np.mean(threshold1))
print('mean of 10%:')
print(np.mean(threshold2))
print('mean of 5%:')
print(np.mean(threshold3))