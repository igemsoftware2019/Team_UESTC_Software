from bs4 import BeautifulSoup
import requests
from pymysql_com import com, cur

class UpdateUniprot:
    def __init__(self, count_funs, count_funs_als):
        self.count_funs = count_funs
        self.count_funs_als = count_funs_als

    def updateuni(self):
        self.uni()
        self.count_f()
        self.uni_publications()
        self.count_f()
        self.uni_db()
        self.count_f()
        self.uni_feature()
        self.count_f()
        self.uni_comment()
        self.count_f()
        self.uni_recommendedname()
        self.count_f()
        return [int(self.count_funs), int(self.count_funs_als)]

    def count_f(self):
        self.count_funs = self.count_funs - 1
        if self.count_funs < 0:
            self.count_funs_als = self.count_funs_als + 1
        with open('count_funs.txt', 'w', encoding='utf8') as fs:
            fs.write(str(self.count_funs_als))

    def uni(self):
        if not self.count_funs > 0:
            sql = "select distinct uniid from igemuni where uniid !='' and uniid not in (select uniid from uni1)"
            cur.execute(sql)
            bls = cur.fetchall()
            count = 1
            for bl in bls:
                url = 'https://www.uniprot.org/uniprot/%s.xml' % bl[0]
                while True:
                    try:
                        r = requests.get(url, timeout=10)
                    except:
                        continue
                    else:
                        if r.status_code == 200:
                            break
                        else:
                            continue
                s = BeautifulSoup(r.text, 'lxml')
                print(bl[0])

                name = s.find('name')
                if name:
                    if name.string:
                        name = name.string
                    else:
                        name = ''
                else:
                    name = ''

                uniid = s.find('accession')
                if uniid:
                    if uniid.string:
                        uniid = uniid.string
                    else:
                        uniid = ''
                else:
                    uniid = ''

                gene = s.find('gene')
                if gene:
                    gene_name = gene.find('name')
                    if gene_name:
                        if gene_name.string:
                            gene_name = gene_name.string
                        else:
                            gene_name = ''
                    else:
                        gene_name = ''
                else:
                    gene_name = ''

                organism = s.find('name', attrs={'type': 'scientific'})
                if organism:
                    if organism.string:
                        organism = organism.string
                    else:
                        organism = ''
                else:
                    organism = ''

                Taxonomic_identifier = s.find('dbreference', {'type': 'NCBI Taxonomy'})
                for key, value in Taxonomic_identifier.attrs.items():
                    # print(key)
                    print(value)

                Taxonomic_lineage = s.find_all('lineage')
                taxs = ''
                for a in Taxonomic_lineage:
                    taxon = a.find_all('taxon')
                    for b in taxon:
                        taxs = taxs + '>' + str(b.string)
                taxs = taxs[1:]
                print(taxs)

                keyword = s.find_all('keyword')
                keys = ''
                for a in keyword:
                    keys = keys + ',' + str(a.string)
                keys = keys[1:]

                sequence_m = s.find_all('sequence')
                for a in sequence_m:
                    if a.parent.name == 'entry':
                        try:
                            seq = str(a.string)
                        except:
                            seq = ''

                    try:
                        seq_l = a.attrs['length']
                    except:
                        seq_l = ''

                    try:
                        seq_ma = a.attrs['mass']
                    except:
                        seq_ma = ''

                    try:
                        seq_c = a.attrs['checksum']
                    except:
                        seq_c = ''

                    try:
                        seq_m = a.attrs['modified']
                    except:
                        seq_m = ''

                    seq_d = 'length:' + seq_l + ',mass:' + seq_ma + ',checksum:' + seq_c + ',modified:' + seq_m

                    print(seq)
                    print(seq_d)

                sql = 'insert into uni1 values("%s","%s","%s","%s","%s","%s","%s","%s","%s" )' % (
                name, uniid, gene_name, organism, value, taxs, keys, seq_d, seq)
                print(sql)
                com(sql)
                print(count)
                count = count + 1

    def uni_publications(self):
        if not self.count_funs > 0:
            sql = "select distinct uniid from uni1 where uniid !='' and uniid not in (select uniid from uni_publications)"
            cur.execute(sql)
            bls = cur.fetchall()
            count = 1
            for bl in bls:
                url = 'https://www.uniprot.org/uniprot/%s.xml' % bl[0]
                while True:
                    try:
                        r = requests.get(url, timeout=10)
                    except:
                        continue
                    else:
                        if r.status_code == 200:
                            break
                        else:
                            continue
                s = BeautifulSoup(r.text, 'lxml')
                print(bl[0])

                ass = s.find_all('reference')
                for a in ass:
                    ci = a.find('citation')

                    try:
                        na = ci.attrs['name']
                    except:
                        na = ''

                    try:
                        vo = ci.attrs['volume']
                    except:
                        vo = ''

                    try:
                        da = ci.attrs['date']
                    except:
                        da = ''

                    try:
                        fi = ci.attrs['first']
                    except:
                        fi = ''

                    try:
                        la = ci.attrs['last']
                    except:
                        la = ''

                    ti = a.find('title')
                    if ti:
                        if ti.string:
                            ti = ti.string
                        else:
                            ti = ''
                    else:
                        ti = ''

                    bis = a.find_all('person')
                    name = ''
                    for bi in bis:
                        if name:
                            name = name + ',' + bi.attrs['name']
                        else:
                            name = bi.attrs['name']

                    dbs = a.find_all('dbreference')
                    dbr = ''
                    for db in dbs:
                        if dbr:
                            dbr = dbr + ',' + db.attrs['type'] + ':' + db.attrs['id']
                        else:
                            dbr = db.attrs['type'] + ':' + db.attrs['id']

                    scs = a.find_all('scope')
                    sco = ''
                    for sc in scs:
                        sco = str(sc.string) + ',' + sco
                    sco = sco[:-1]

                    strain = a.find('strain')
                    if strain:
                        if strain.string:
                            strain = strain.string
                        else:
                            strain = ''
                    else:
                        strain = ''

                    sql = 'insert into uni_publications values("%s","%s","%s","%s","%s","%s","%s")' % (
                    bl[0], na + vo + ":" + fi + "-" + la + "(" + da + ")", ti, name, dbr, sco, strain)
                    print(sql)
                    com(sql)
                    print(count)
                    count = count + 1

    def uni_db(self):
        if not self.count_funs > 0:
            sql = "select distinct uniid from uni1 where uniid !='' and uniid not in(select uniid from uni_db)"
            cur.execute(sql)
            bls = cur.fetchall()
            count = 1
            for bl in bls:
                url = 'https://www.uniprot.org/uniprot/%s.xml' % bl[0]
                while True:
                    try:
                        r = requests.get(url, timeout=10)
                    except:
                        continue
                    else:
                        if r.status_code == 200:
                            break
                        else:
                            continue
                s = BeautifulSoup(r.text, 'lxml')
                print(bl[0])

                ass = s.find_all('dbreference')
                for a in ass:
                    if a.parent.name == 'entry':
                        try:
                            type = "type:" + a.attrs['type'] + "," + "id:" + a.attrs['id']
                        except:
                            type = ''

                        pros = a.find_all('property')
                        pro = ''
                        for b in pros:
                            if pro:
                                pro = b.attrs['type'] + ':' + b.attrs['value'] + "." + pro
                            else:
                                pro = b.attrs['type'] + ':' + b.attrs['value']

                        sql = 'insert into uni_db values("%s","%s","%s","%s")' % (bl[0], ':'.join(type.split(',')[0].split(':')[1:]), ':'.join(type.split(',')[1].split(':')[1:]), pro)
                        print(sql)
                        com(sql)
                        print(count)
                        count = count + 1
            sql = 'select distinct uniid,type from uni_db where (uniid,type) not in (select uniid,type from uni_db1)'
            if cur.execute(sql) > 0:
                duts = cur.fetchall()
                for dut in duts:
                    sql = 'select distinct id from uni_db where uniid = "%s" and type = "%s"' % (dut[0], dut[1])
                    if cur.execute(sql) > 0:
                        dids = cur.fetchall()
                        id = ''
                        for did in dids:
                            id = id + ';' + did[0]
                        id = id[1:]
                        sql = 'insert into uni_db1 values("%s","%s","%s")' % (dut[0], dut[1], id)
                        print(sql)
                        com(sql)


    def uni_feature(self):
        if not self.count_funs > 0:
            sql = "select distinct uniid from uni1 where uniid !='' and uniid not in (select uniid from uni_feature)"
            cur.execute(sql)
            bls = cur.fetchall()
            count = 1
            for bl in bls:
                url = 'https://www.uniprot.org/uniprot/%s.xml' % bl[0]
                while True:
                    try:
                        r = requests.get(url, timeout=10)
                    except:
                        continue
                    else:
                        if r.status_code == 200:
                            break
                        else:
                            continue
                s = BeautifulSoup(r.text, 'lxml')
                print(bl[0])

                ass = s.find_all('feature')
                for a in ass:
                    type = a.attrs['type']
                    try:
                        des = ':' + a.attrs['description']
                    except:
                        des = ''

                    bss = a.find_all('begin')
                    begin = ''
                    for b in bss:
                        try:
                            begin = b.attrs['position']
                        except:
                            begin = ''

                    css = a.find_all('end')
                    end = ''
                    for c in css:
                        try:
                            end = c.attrs['position']
                        except:
                            end = ''

                    dss = a.find_all('position')
                    pos = ''
                    for d in dss:
                        try:
                            pos = d.attrs['position']
                        except:
                            pos = ''

                    sql = 'insert into uni_feature values("%s","%s","%s","%s","%s")' % (
                    bl[0], type + des, begin, end, pos)
                    print(sql)
                    com(sql)
                    print(count)
                    count = count + 1

    def uni_comment(self):
        if not self.count_funs > 0:
            sql = "select distinct uniid from igemuni where uniid !='' and uniid not in (select uniid from uni_comment)"
            cur.execute(sql)
            bls = cur.fetchall()
            c = 1
            for bl in bls:
                url = 'https://www.uniprot.org/uniprot/' + bl[0] + '.xml'
                while True:
                    try:
                        r = requests.get(url, timeout=10)
                    except:
                        pass
                    else:
                        if r.status_code == 200:
                            break
                        else:
                            pass
                s = BeautifulSoup(r.text, 'lxml')
                print(bl[0])
                ass = s.find_all('comment')
                for a in ass:
                    if a.parent.name == 'entry':
                        type = a.attrs['type']
                        print(type)
                        text = ''
                        if type == 'subcellular location':
                            bs = a.find('subcellularlocation')
                            for b in bs.contents:
                                if b != '\n':
                                    try:
                                        text = text + '\n' + b.string
                                    except:
                                        pass
                        elif type == 'interaction':
                            bs = a.find_all('interactant')
                            if bs:
                                for b in bs:
                                    text = text + '\n' + b.attrs['intactid']
                        elif type == 'sequence caution':
                            bs = a.find('conflict')
                            if bs:
                                text = text + 'reason:' + bs.attrs['type'] + '\n'
                                b = bs.find('sequence')
                                try:
                                    print(b.attrs)
                                except:
                                    pass
                                else:
                                    for k, v in b.attrs.items():
                                        text = text + k + ':' + v + '\n'
                        elif type == 'biophysicochemical properties':
                            bs = a.find_all('km')
                            if bs:
                                for b in bs:
                                    try:
                                        print(b.string)
                                    except:
                                        pass
                                    else:
                                        text = text + b.string + '\n'
                            else:
                                bs = a.find('absorption')
                                if bs:
                                    text = text + 'absorption:'
                                    maxx = bs.find('max')
                                    try:
                                        print(maxx.string)
                                    except:
                                        pass
                                    else:
                                        text = text + maxx.string + '\n'
                                    txt = bs.find('text')
                                    if txt:
                                        try:
                                            print(txt.string)
                                        except:
                                            pass
                                        else:
                                            text = text + txt.string
                        elif type == 'cofactor':
                            bs = a.find_all('cofactor')
                            for b in bs:
                                mm = b.find('name')
                                try:
                                    print(mm.string)
                                except:
                                    pass
                                else:
                                    text = text + mm.string + '\n'
                        elif type == 'mass spectrometry':
                            text = text + 'mass:' + a.attrs['mass'] + '\n'
                            bs = a.find_all('location')
                            for b in bs:
                                for k, v in b.attrs.items():
                                    text = text + k + ':' + v
                        elif type == 'online information':
                            text = text + a.attrs['name'] + ':'
                            b = a.find('link')
                            text = text + b.attrs['uri']
                        else:
                            for b in a.find_all('text'):
                                try:
                                    text = text + '\n' + b.string
                                except:
                                    pass
                        sql = 'insert into uni_comment values("%s","%s","%s")' % (bl[0], type, text.strip())
                        print(sql)
                        com(sql)
                        print(c)
                        c = c + 1

    def uni_recommendedname(self):
        if not self.count_funs > 0:
            sql = 'select distinct uniid from igemuni where uniid not in (select uniid from uni_recommendedname)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                uniid = r[0]
                url = 'https://www.uniprot.org/uniprot/' + uniid + '.xml'
                print(url)
                session = requests.session()
                session.keep_alive = False
                while True:
                    rp = session.get(url)
                    if rp.status_code == 200:
                        rp.encoding = rp.apparent_encoding
                        break
                    else:
                        break
                if rp.status_code != 200:
                    with open('e\\e.txt', 'a', encoding='utf-8') as file:
                        file.write(url + '\n' + str(rp.status_code) + '\n')
                if rp:
                    s = BeautifulSoup(rp.text, 'lxml')
                    pro = s.find('protein')
                    res = pro.find('recommendedname')
                    dos = pro.find_all('domain')
                    if res:
                        ful1 = res.find('fullname')
                        if ful1:
                            ful = ful1.string
                        else:
                            ful = ''
                        sho1 = res.find('shortname')
                        if sho1:
                            sho = sho1.string
                        else:
                            sho = ''
                        ecs = res.find_all('ecnumber')
                        ec = ''
                        if ecs:
                            for i in ecs:
                                ec = ec + i.string + ';'
                        alt = ''
                        if dos:
                            alts = res.find_all('alternativename')
                            if alts:
                                for i in alts:
                                    ful2 = i.find('fullname')
                                    alt = alt + ful2.string + ';'
                        else:
                            alts = pro.find_all('alternativename')
                            if alts:
                                for i in alts:
                                    ful2 = i.find('fullname')
                                    alt = alt + ful2.string + ';'
                        sql = 'insert into uni_recommendedname values("%s","%s","%s","%s","%s")' % (uniid, ful, sho, ec, alt)
                        print(sql)
                        com(sql)

                    if dos:
                        for do in dos:
                            ful1 = do.find('fullname')
                            if ful1:
                                ful = ful1.string
                            else:
                                ful = ''
                            sho1 = do.find('shortname')
                            if sho1:
                                sho = sho1.string
                            else:
                                sho = ''
                            ecs = do.find_all('ecnumber')
                            ec = ''
                            if ecs:
                                for i in ecs:
                                    ec = ec + i.string + ';'
                            alts = do.find_all('alternativename')
                            alt = ''
                            if alts:
                                for i in alts:
                                    ful2 = i.find('fullname')
                                    alt = alt + ful2.string + ';'
                            print(alt)
                            sql = 'insert into uni_domain values("%s","%s","%s","%s","%s")' % (uniid, ful, sho, ec, alt)
                            print(sql)
                            com(sql)
                print(count)
                count = count + 1
