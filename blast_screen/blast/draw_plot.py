from PIL import Image
import csv
import matplotlib.pyplot as plt

def readcsv(path):
    with open(path,'r') as f:
        a = []
        rander = csv.DictReader(f)
        for r in rander:
            a.append(r)
        return a, list(a[0].keys())

threshold = [0.4, 0.45, 0.5, 0.55, 0.6, 0.65, 0.7, 0.75, 0.8]
weight = []
for i in range(1,9):
    for j in range(1, 10 - i):
        w = [i * 0.1]
        w.append(j * 0.1)
        w.append((10 - i - j) * 0.1)
        weight.append(w)

j = 1
k = 0
colors = ['b','g','r','y','c','k','m', 'b', 'g']
arr_percent = []
csv_name = []
plt.style.use('ggplot')
plt.figure(figsize=(20,8))
for t in threshold:
    x = []
    y = []
    max = 0
    name = ''
    for i in range(len(weight)):
        s1 = str(round(weight[i][0], 1))
        s2 = str(round(weight[i][1], 1))
        s3 = str(round(weight[i][2], 1))
        s = s1[2] + '_' + s2[2] + '_' + s3[2]
        path = 'whole\weight_modify\/test'+ str(j) + "_" + str(round(t,2)) + '_' + s1 + '_' + s2 + '_' + s3 + '.csv'
        csv_name.append(s)
        dic, key =readcsv(path)
        count = 0
        for le in dic:
            if len(le['source']) > 15: count += 1
        percent = count / len(dic)
        arr_percent.append(percent)
        if max < percent:
            max = percent
            name = s
        x.append(s)
        y.append(percent)
        print(j)
        j += 1
    plt.plot(x, y,label = "threshold: " + str(round(t,2)) + "|max: " + str(round(max*100,2)) + "%" + "|name: " + str(name), color = colors[k], marker='o', markerfacecolor = 'w', markersize = 5)
    k += 1
plt.xlabel("csv_name")
plt.ylabel("percentage of intersections formed by three collection")
plt.title("tendency of the total of intersections--id")
plt.legend()
plt.savefig('whole\/tendency_id.jpg')
def draw_score_evalue(position):
    plt.figure(figsize=(20, 8))
    # draw 7 colors lines.
    # k is the position of threshold[]
    k = 0
    for t in threshold:
        # find each part ordered by score, i is the value of score/evalue
        # a is the position array of elements in csv_name[] ordered by score/evalue
        a = []
        x = []
        y = []
        for i in range(1,9):
            j = 0
            for l in csv_name[k*len(weight):(1+k)*len(weight)]:
                if l[position] == str(i): a.append(j+k*len(weight))
                j += 1
        for aa in a:
            x.append(csv_name[aa])
            y.append(arr_percent[aa])
        plt.plot(x, y, label = "threshold: " + str(round(t,2)), color=colors[k], marker='o', markerfacecolor='w', markersize=5)
        k += 1

draw_score_evalue(2)
plt.xlabel("csv_name")
plt.ylabel("percentage of intersections formed by three collection")
plt.title("tendency of the total of intersections--score")
plt.legend()
plt.savefig('whole\/tendency_score.jpg')


draw_score_evalue(4)
plt.xlabel("csv_name")
plt.ylabel("percentage of intersections formed by three collection")
plt.title("tendency of the total of intersections--evalue")
plt.legend()
plt.savefig('whole\/tendency_evalue.jpg')
plt.show()
