import csv
f3 = 'whole/weight_modify/test185_0.65_0.1_0.5_0.4.csv'

def readcsv(path):
    with open(path,'r') as f:
        igemid = []
        rander = csv.DictReader(f)
        id = ''
        count = 0
        c = []
        for r in rander:
            if id != r['igemid']:
                if id != '': c.append(count)
                id = r['igemid']
                igemid.append(id)
                count = 1
            else: count += 1
        c.append(count)
        return igemid, c
igemid, count = readcsv(f3)
max = max(count)
amount = [0 for x in range(max+1)]
for i in range(len(igemid)):
    amount[count[i]] += 1
for c in range(max):
    if amount[c] > 0: print("count_%d: %d"%(c, amount[c]))