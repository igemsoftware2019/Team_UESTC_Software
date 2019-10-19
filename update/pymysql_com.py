import pymysql
import re

con = pymysql.connect('localhost', 'root', 'root', 'a')  // 这个密码需要改成本地密码
cur = con.cursor()
re_space = re.compile('[\s]+')

def com(sql, e_path='e\\e.txt'):
    try:
        cur.execute(sql)
    except Exception as e:
        with open(e_path, 'a', encoding='utf-8') as file:
            file.write(str(e) + '\n' + sql + '\n')
    else:
        con.commit()