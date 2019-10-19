import re

f=open('datasets\Try.fasta','r')
igemid = []
info = []
for line in f:
    if not line.startswith('>'):
        continue
    else:
        info = re.split('[:>; \n]', line)
        if info[3] not in igemid:
            igemid.append(info[3])
with open('test/igemid_random300.txt', 'w') as file:
    for d in igemid:
        file.write(d)
        file.write('\n')
f.close()