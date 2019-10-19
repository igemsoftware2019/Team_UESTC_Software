from uni import UpdateUniprot
from string_up import UpdateString
from kegg_up import UpdateKegg
from go_up import UpdateGo
import os

with open('count_funs.txt', 'r', encoding='utf8') as fs:
    for count_funs in fs:
        uni = UpdateUniprot(int(count_funs), int(count_funs))
        count_fun = uni.updateuni()

        stri = UpdateString(int(count_fun[0]), int(count_fun[1]))
        count_fun = stri.updatestring()

        keg = UpdateKegg(int(count_fun[0]), int(count_fun[1]))
        count_fun = keg.updatekegg()

        go = UpdateGo(int(count_fun[0]), int(count_fun[1]))
        count_fun = go.updatego()

        os.system('py -2 ' + 'brenda_up.py ' + str(count_fun[0]) + ' ' + str(count_fun[1]))


'''
uni = UpdateUniprot(int(count_funs), int(count_funs))
        count_fun = uni.updateuni()

        stri = UpdateString(int(count_fun[0]), int(count_fun[1]))
        count_fun = stri.updatestring()

        keg = UpdateKegg(int(count_fun[0]), int(count_fun[1]))
        count_fun = keg.updatekegg()

        go = UpdateGo(int(count_fun[0]), int(count_fun[1]))
        count_fun = go.updatego()
        
        
keg = UpdateKegg(5, 5)
        count_fun = keg.kegg3()
'''

