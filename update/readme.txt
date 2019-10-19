程序运行在powershell中，使用python [文件名]的方式运行

运行应在空数据库中，先运行a.sql生成数据结构
运行之前需要保证igemuni中有数据
有几处需要更改的地方：
	pymysql_com.py 中的MySQL的配置
	brenda_up.py 中的MySQL的配置
	update_igem.py 中的路径,以及python2的相关命令
	count_funs.txt 中的配置,从头开始，改为0
	还有mysql com的报错路径
如果想更改brenda中的函数，需要更改re_sp的值，以适应新的函数

es.py要单独运行，在运行之前要清空表parts_ec #此表中还应有part_type可在mysql中加入

运行一下两个程序前，先创建新表temp_group,temp_pa，表中只有一列igem_id
para.py生成的是igem_pa中的数据，获取的是parameter的内容
group.py生成的是igem_group中的数据，获取的是与队伍信息有关的内容
运行完后。可以删除这两个临时表
关于igem本身的数据可以单独加入，不在一键更新的大程序中

需要手动生成uni这个表，包含strid和strname这两列