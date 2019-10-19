import os
import csv
import numpy as np
from Bio import SeqIO
from keras.models import load_model
import pymysql
import sys

#print(sys.argv)
path=os.path.abspath('..')
print(path)

oneHotDict = {'A': np.array([1, 0, 0, 0]), 'G': np.array([0, 1, 0, 0]), 'C': np.array([0, 0, 1, 0]),
              'T': np.array([0, 0, 0, 1]), 'N': np.array([0, 0, 0, 0]), 'M': np.array([0, 0, 0, 0]),
              'K': np.array([0, 0, 0, 0]), 'D': np.array([0, 0, 0, 0]), 'R': np.array([0, 0, 0, 0]),
              'Y': np.array([0, 0, 0, 0]), 'S': np.array([0, 0, 0, 0]), 'W': np.array([0, 0, 0, 0])}
# config = tf.ConfigProto()
# config.gpu_options.allow_growth = True
# session = tf.Session(config=config)

# np.array：生成矩阵的函数；
# map(function(),parameter),返回数组，前面是计算函数，后面是输入,每次一个参数进入；
# lambda(x,y:function(x,y))声明变量
#**vectorrizeseq 函数将seq序列转化为array数组，便于储存以及运算
def vectorizeseq(seq):
    return np.array(list(map(lambda letter: oneHotDict[letter], seq)))

# def prom_identify(species, file_path, file_key):
def prom_identify(species, seq ,key):
    print(len(seq))
    seq = seq.upper() #大写化
    flag = 0
    tlen = 0
    #物种是人，老鼠，筷子芥。load其机器学习的本地.h5文件
    if species == 'Human' or species == 'Mouse' or species == 'Arabis':
        print(path+'/web_prom/model/{0}_Prom_Exon.h5'.format(species))
        classifier_exon = load_model(path+'/web_prom/model/{0}_Prom_Exon.h5'.format(species))
        classifier_intron = load_model(path+'/web_prom/model/{0}_Prom_Intron.h5'.format(species))
        classifier_3utr = load_model(path+'/web_prom/model/{0}_Prom_3UTR.h5'.format(species))
        print(5656)
        #print(classifier_3utr)
        # for record in SeqIO.parse("{0}".format(file_path), "fasta"):
        #     record.seq = str(record.seq).upper()
        #     writer.writerow([">"+str(record.id)+str(record.description)])

        #seq按照其长度是否符合标准划分，该项拟于php中完成判断，之传给python可用的seq！！！
        i = 0
        if len(seq) > 260:
            flag = 1
        # if len(seq) < 251:
        #     writer.writerow(["- 251bp at least!"])
        if len(seq) > 251:
            tlen = 1
            #writer.writerow(["Region_start", "Region_end", "Prom_Exon", "Prom_Intron", "Prom_3UTR", "Average_score", "Label"])
            temp_list = list()
            while i < (len(seq) - 250):
                #print('sss')
                #seq[i:251 + i] 鬼畜的表达式，得到i～251+i-1的序列
                temp_list.append([np.array(vectorizeseq(str(seq[i:251 + i]))), i])
                #print(temp_list)
                #30万这个参数是真的看不懂
                #30万应该是由于数据量过大。。。
                if len(temp_list) >= 300000:
                    #temp_list 超过30万，意味着序列长度至少30万。。。。
                    x_pre_temp = np.array([temp[0] for temp in temp_list])
                    pos_list = np.array([temp[1] for temp in temp_list])
                    temp_list = []
                    y_cur_exon = classifier_exon.predict(x_pre_temp)
                    y_cur_intron = classifier_intron.predict(x_pre_temp)
                    y_cur_3utr = classifier_3utr.predict(x_pre_temp)
                    #loadmodel
                    res = []
                    for j in range(len(y_cur_3utr)):
                        nmsl = 0
                        if y_cur_exon[j][1] > 0.7:
                            nmsl += 1
                        if y_cur_intron[j][1] > 0.7:
                            nmsl += 1
                        if y_cur_3utr[j][1] > 0.7:
                            nmsl += 1
                        if nmsl >= 2:
                            y_final = 'Y'
                        else:
                            y_final = 'N'
                        res0 = ([str(pos_list[j] + 1), str(pos_list[j] + 251), format(y_cur_exon[j][1], '.5f'),
                                         format(y_cur_intron[j][1], '.5f'), format(y_cur_3utr[j][1], '.5f'),
                                         format((y_cur_exon[j][1]+y_cur_intron[j][1]+y_cur_3utr[j][1])/3.0, '.5f'),
                                         y_final])
                        res.append(res0)
                        # 结果存储到数据库
                        conn = get_conn('155.138.228.218', 3306, 'root', 'igem2019', 'a')
                        cursor1 = conn.cursor()
                        sql1 = "SELECT * FROM index_a WHERE key_a = '%s';" % (key)
                        print('bp超过30万的情况！！！')
                        cursor1.execute(sql1)
                        row = cursor1.fetchall()
                        cursor1.close()
                        #print(row)
                        if row:
                            # 已有的key；直接输出结果
                            print('查询key中！')
                        else:
                            for result in res:
                                #print(result)
                                cursor = conn.cursor()
                                sql = (
                                    "INSERT INTO index_a(seq, species, Region_start, Region_end, Prom_Exon, Prom_Intron, Prom_3UTR, Average_score, Label, key_a) "
                                    "VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')"
                                    % (seq, species, result[0], result[1], result[2], result[3], result[4], result[5],
                                       result[6], key))
                                cursor.execute(sql)
                                conn.commit()
                                cursor.close
                        conn.close
                        #print(res)
                i += 1
                #print(i)

            #对应30万参数，这里应该是小于30万的操作。
            x_pre_temp = np.array([temp[0] for temp in temp_list])
            pos_list = np.array([temp[1] for temp in temp_list])
            y_cur_exon = classifier_exon.predict(x_pre_temp)
            y_cur_intron = classifier_intron.predict(x_pre_temp)
            y_cur_3utr = classifier_3utr.predict(x_pre_temp)
            res = list([[0] for i in range(len(x_pre_temp))])
            #print(len(res))
            for j in range(len(x_pre_temp)):#这里循环长度不同！
                nmsl = 0
                if y_cur_exon[j][1] > 0.7:
                    nmsl += 1
                if y_cur_intron[j][1] > 0.7:
                    nmsl += 1
                if y_cur_3utr[j][1] > 0.7:
                    nmsl += 1
                if nmsl >= 2:
                    y_final = 'Y'
                else:
                    y_final = 'N'
                #print('sacxs')
                #输出前俩参数是位置参数；第三四五是loadmodel计算结果；六是平均数；最后一个nmsl
                res0 = ([str(pos_list[j] + 1), str(pos_list[j] + 251), format(y_cur_exon[j][1], '.5f'),
                                 format(y_cur_intron[j][1], '.5f'), format(y_cur_3utr[j][1], '.5f'),
                                 format((y_cur_exon[j][1] + y_cur_intron[j][1] + y_cur_3utr[j][1]) / 3.0, '.5f'),
                                 y_final])
                #print(res0)
                res[int(pos_list[j])] = res0

        # 结果存储到数据库
        conn = get_conn('155.138.228.218', 3306, 'root', 'igem2019', 'a')
        cursor1 = conn.cursor()
        sql1 = "SELECT * FROM index_a WHERE key_a = '%s';" % (key)
        cursor1.execute(sql1)
        row = cursor1.fetchall()
        cursor1.close()
        #print(row)
        if row:
            # 已有的key；直接输出结果
            print('查询key中！')
        else:
            for result in res:
                #print(result)
                cursor = conn.cursor()
                sql = ( "INSERT INTO index_a(seq, species, Region_start, Region_end, Prom_Exon, Prom_Intron, Prom_3UTR, Average_score, Label, key_a) "
                        "VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')"
                        % (seq, species, result[0], result[1], result[2], result[3], result[4], result[5], result[6], key))
                cursor.execute(sql)
                conn.commit()
                cursor.close
        conn.close

    #物种是剩下的那三种;结构跟上面的人物种基本一致
    # species == 'Ecoli_sigma54' or
    elif species == 'Ecoli_sigma70' or species == 'Bacillus':
        classifier = load_model(path+'/web_prom/model/{0}.h5'.format(species))
        seq = seq.upper()  # 大写化
        if len(seq) > 81:
            flag = 1
        i = 0
        tlen = 1
        temp_list = list()
        while i < (len(seq) - 80):
            temp_list.append([np.array(vectorizeseq(str(seq[i:81 + i]))), i])
            if len(temp_list) >= 300000:
                x_pre_temp = np.array([temp[0] for temp in temp_list])
                pos_list = np.array([temp[1] for temp in temp_list])
                temp_list = []
                y_cur = classifier.predict(x_pre_temp)
                res = []
                for j in range(len(y_cur)):
                    if y_cur[j][1] > 0.5:
                        y_final = 'Y'
                    else:
                        y_final = 'N'
                    res0 = ([str(pos_list[j] + 1), str(pos_list[j] + 81), format(y_cur[j][1], '.5f'),
                                     y_final])
                    res.append(res0)
                # 结果存储到数据库
                conn = get_conn('155.138.228.218', 3306, 'root', 'igem2019', 'a')
                cursor1 = conn.cursor()
                sql1 = "SELECT * FROM index_b WHERE key_a = '%s';" % (key)
                cursor1.execute(sql1)
                row = cursor1.fetchall()
                cursor1.close()
                if row:
                    # 已有的key；直接输出结果
                    print('查询key中！')
                else:
                    for result in res:
                        cursor = conn.cursor()
                        sql = ("INSERT INTO index_b(seq, species, Region_start, Region_end, Score, Label, key_a) "
                               "VALUES ('%s','%s','%s','%s','%s','%s','%s')"
                               % (seq, species, result[0], result[1], result[2], result[3], key))
                        cursor.execute(sql)
                        conn.commit()
                        cursor.close
                conn.close

            i += 1

        x_pre_temp = np.array([temp[0] for temp in temp_list])
        pos_list = np.array([temp[1] for temp in temp_list])
        y_cur = classifier.predict(x_pre_temp)
        res = []
        for j in range(len(y_cur)):
            if y_cur[j][1] > 0.5:
                y_final = 'Y'
            else:
                y_final = 'N'
            res0 = ([str(pos_list[j] + 1), str(pos_list[j] + 81), format(y_cur[j][1], '.5f'),
                             y_final])
            res.append(res0)
            #print(res0)
        # 结果存储到数据库
        conn = get_conn('155.138.228.218', 3306, 'root', 'igem2019', 'a')
        cursor1 = conn.cursor()
        sql1 = "SELECT * FROM index_b WHERE key_a = '%s';" % (key)
        cursor1.execute(sql1)
        row = cursor1.fetchall()
        cursor1.close()
        #print(row)
        if row:
            # 已有的key；直接输出结果
            print('查询key中！')
        else:
            for result in res:
                #print(result)
                cursor = conn.cursor()
                sql = ("INSERT INTO index_b(seq, species, Region_start, Region_end, Score, Label, key_a) "
                        "VALUES ('%s','%s','%s','%s','%s','%s','%s')"
                        % (seq, species, result[0], result[1], result[2], result[3], key))
                cursor.execute(sql)
                conn.commit()
                cursor.close
        conn.close
        # if tlen == 0:
        #     print('Input sequence must more than 81bp!')

    return flag


def final_process(species, key):
    temp_list = []
    dog = 0
    f = 0
    end = 0

    # 第一种物种情况
    if species == 'Human' or species == 'Mouse' or species == 'Arabis':
        # 数据库获取当前key下的所有信息
        conn = get_conn('155.138.228.218', 3306, 'root', 'igem2019', 'a')
        cursor = conn.cursor()
        sql = "SELECT * FROM index_a WHERE key_a='%s';" % (key)
        cursor.execute(sql)
        row = cursor.fetchall()
        row = list(row)
        cursor.close()

        result = []
        for item in row:
            item = list(item)
            if item[8] == 'Y' and int(item[2]) > int(end):
                # temp_list接受所有判定是 "Y"的起止位置以及评分
                temp_list.append([item[2], item[3], item[7]])
                f = 0
            else:
                # 判断不是Y的情况
                if len(temp_list) > 0:  # 判断是不是第一个符合条件的
                    if dog < int((len(temp_list) + 1) / 5) and f < 4:  # 判断N出现的次数是否超过限制
                        f += 1
                        dog += 1
                        # 符合条件的N标注的数据也被temp_list接受
                        temp_list.append([item[2], item[3], item[7]])
                    # temp_list过短，数据量不够，清零重来
                    elif len(temp_list) < 15:
                        dog = 0
                        f = 0
                        temp_list = []
                    # temp_list数据量够大；且N出现的次数超过限制，进行score比较，最高的作为final_result输出
                    else:
                        temp_max = temp_list[0]
                        for temp in temp_list:
                            if temp[2] > temp_max[2]:
                                temp_max = temp
                        end = temp_list[-1][1]
                        result.append(temp_max)
                        print(temp_max)
                        dog = 0
                        f = 0
                        temp_list = []
        # 处理大量Y出现的情况
        if len(temp_list) >= 15:
            temp_max = temp_list[0]
            for temp in temp_list:
                if temp[2] > temp_max[2]:
                    temp_max = temp
            #print(temp_max)
            result.append(temp_max)

        cursor1 = conn.cursor()
        sql1 = "SELECT * FROM final_result_a WHERE key_a = '%s';" % (key)
        cursor1.execute(sql1)
        row = cursor1.fetchall()
        cursor1.close()
        #print(row)
        if row:
            # 已有的key；直接输出结果
            print('查询key中！')
        else:
            for result0 in result:
                #print(result0)
                cursor2 = conn.cursor()
                sql = ("INSERT INTO final_result_a(species, key_a, Region_start, Region_end, Score) "
                       "VALUES ('%s','%s','%s','%s','%s')"
                       % (species, key, result0[0], result0[1], result0[2]))
                cursor2.execute(sql)
                conn.commit()
                cursor.close
        conn.close()
    # 其他物种
    else:
        # 数据库获取当前key下的所有信息
        conn = get_conn('155.138.228.218', 3306, 'root', 'igem2019', 'a')
        cursor = conn.cursor()
        sql = "SELECT * FROM index_a WHERE key_a='%s';" % (key)
        cursor.execute(sql)
        row = cursor.fetchall()
        row = list(row)
        cursor.close()
        result = []
        for item in row:
            item = list(item)
            if item[6] == 'Y' and int(item[0]) > int(end):
                temp_list.append([item[3], item[4], format(float(item[5]), "0.5f")])
                f = 0
            else:
                if len(temp_list) > 0:  # 判断是不是第一个符合条件的
                    if dog < int((len(temp_list) + 1) / 5) and f < 4:  # 判断N出现的次数是否超过限制
                        f += 1
                        dog += 1
                        temp_list.append([item[3], item[4], format(float(item[5]), "0.5f")])
                    elif len(temp_list) < 15:
                        dog = 0
                        f = 0
                        temp_list = []
                    else:
                        temp_max = temp_list[0]
                        for temp in temp_list:
                            if temp[2] > temp_max[2]:
                                temp_max = temp
                        end = temp_list[-1][1]
                        result.append(temp_max)
                        # print(temp_max)
                        dog = 0
                        f = 0
                        temp_list = []

        cursor1 = conn.cursor()
        sql1 = "SELECT * FROM final_result_b WHERE key_a = '%s';" % (key)
        cursor1.execute(sql1)
        row = cursor1.fetchall()
        cursor1.close()
        # print(row)
        if row:
            # 已有的key；直接输出结果
            print('查询key中！')
        else:
            for result0 in result:
                # print(result0)
                cursor2 = conn.cursor()
                sql = ("INSERT INTO final_result_b(species, key_a, Region_start, Region_end, Score) "
                       "VALUES ('%s','%s','%s','%s','%s')"
                       % (species, key, result0[0], result0[1], result0[2]))
                cursor2.execute(sql)
                conn.commit()
                cursor.close
        conn.close()
    # 没有上面类似的那一部分

def get_conn(a,b,c,d,e):
    conn = pymysql.connect(host = a,port = b,user = c,password = d,database = e)
    #print (conn)
    return conn

# try:
choose = int(sys.argv[1])
print(choose)
if choose:
    # 选择文件方式输入
    selected_species = sys.argv[2]
    key = sys.argv[3]
    print(key)
    Parse = SeqIO.parse(path+'/storage/app/public/' + key + '.fasta', 'fasta')
    # print(Parse)
    # seq = list(Seq.seq for Seq in Parse)
    seq = list(Seq.seq for Seq in Parse)[0]
    print(seq)

else:
    # 选择框框方式输入
    selected_species = sys.argv[2]
    key = sys.argv[4]
    seq = sys.argv[3]
# print(seq)
print(selected_species)
flag = prom_identify(selected_species, seq ,key)
best = final_process(selected_species, key)

print("seq 长度{0}".format(len(seq)))


