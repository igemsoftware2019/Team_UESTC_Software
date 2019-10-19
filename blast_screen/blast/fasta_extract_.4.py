import re
import random
file = open('datasets\data_filter_differ_igemid.txt')
igemid_o = []
for id in file:
    new_id = id.replace('\n', '')
    new_id = new_id.replace(' ', '')
    igemid_o.append(new_id)

f=open('datasets\Sequences.fasta')
igemid = []
for i in range(300):
    j = random.randint(1, len(igemid_o))
    if igemid_o[j] not in igemid: j = random.randint(1, len(igemid_o))
    igemid.append(igemid_o[j])

ls=[]
info = []
flag = 0
for line in f:
    if not line.startswith('>'):
        if flag == 1:
            ls.append(line)
            flag = 0
    else:
        info = re.split('[:>; \n]', line)
        if info[3] in igemid:
            ls.append(line)
            flag = 1
f.close()

with open("Try.fasta", "w") as file_output:
    i = 0
    for g in ls:
        file_output.write(g)
        i+=1
        print(i)