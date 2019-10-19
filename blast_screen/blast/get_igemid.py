import csv
from functools import reduce

def readcsv(path):
    with open(path,'r') as f:
        a = []
        b = []
        rander = csv.DictReader(f)
        for r in rander:
            unid = r['unid']
            igemid = r['igemid']
            b.append(unid)
            a.append(igemid)
        a = list_dict_duplicate_removal(a)
        b = list_dict_duplicate_removal(b)
        return a, b

def list_dict_duplicate_removal(data_list):
    run_function = lambda x, y: x if y in x else x + [y]
    return reduce(run_function, [[], ] + data_list)

l1,u1 = readcsv('whole\/data_identity.csv')
l2,u2 = readcsv('whole\/data_score.csv')
l3,u3 = readcsv('whole\/data_expect.csv')
l = l1 + l2 + l3
l = list_dict_duplicate_removal(l)
u = u1 + u2 + u3
u = list_dict_duplicate_removal(u)

def writefile(s,l):
    with open('whole\/'+ s +'.txt', 'w') as f:
        for d in l:
            f.write(d)
            f.write('\n')
        print(s + ":" + str(len(l)))
    f.close()

writefile("data_identity_igemid", l1)
writefile("data_score_igemid", l2)
writefile("data_expect_igemid", l3)
writefile("data_identity_unid", u1)
writefile("data_score_unid", u2)
writefile("data_expect_unid", u3)
writefile("data_total_igemid", l)
writefile("data_total_unid", u)
