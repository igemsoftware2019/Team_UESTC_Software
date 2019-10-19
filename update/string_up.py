import requests
from pymysql_com import com, cur
import urllib.request as urlrequest

class UpdateString:
    def __init__(self, count_funs, count_funs_als):
        self.count_funs = count_funs
        self.count_funs_als = count_funs_als

    def updatestring(self):
        self.scoreinteract()
        self.count_f()
        self.sss()
        self.count_f()
        self.stri()
        self.count_f()
        self.biogrid()
        self.count_f()
        return [int(self.count_funs), int(self.count_funs_als)]

    def count_f(self):
        self.count_funs = self.count_funs - 1
        if self.count_funs < 0:
            self.count_funs_als = self.count_funs_als + 1
        with open('count_funs.txt', 'w', encoding='utf8') as fs:
            fs.write(str(self.count_funs_als))

    def scoreinteract(self):
        if not self.count_funs > 0:
            sql = 'select uni1.uniid,gene_name,shortname,fullname,taxonomic_identifier from uni1,uni_recommendedname where uni1.uniid ' \
                  '= uni_recommendedname.uniid and uni1.uniid not in (select uniid from unistr union select d from d)'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for r in res:
                idens = [r[1], r[2], r[3]]
                co = 0
                for iden in idens:
                    if iden == '' or iden is None:
                        if co == 3:
                            sql = 'insert into d values("%s")' % r[0]
                            print(sql)
                            com(sql)
                        co = co + 1
                        continue

                    url = 'https://string-db.org/api/tsv-no-header/get_string_ids?identifiers=' + iden
                    print(url)
                    response = requests.get(url)
                    if response.status_code == 200:
                        if response.text == '':
                            if co == 3:
                                sql = 'insert into d values("%s")' % r[0]
                                print(sql)
                                com(sql)
                            co = co + 1
                            continue
                        else:
                            response.encoding = response.apparent_encoding
                    else:
                        if co == 3:
                            sql = 'insert into d values("%s")' % r[0]
                            print(sql)
                            com(sql)
                        co = co + 1
                        continue
                    txt = response.text
                    txt = txt.split('\n')
                    rb = txt[0]
                    for t in txt[1:]:
                        if t:
                            ts = str(t).split('\t')
                            if ts[2] == r[4]:
                                rb = t
                    rb = rb.split('\t')
                    uniid = r[0]
                    strid = rb[1].split('.')[1]
                    oxid = rb[2]
                    oxname = rb[3]
                    pre = rb[4]
                    sql = 'insert into unistr values("%s","%s","%s","%s","%s");' % (uniid, strid, pre, oxid, oxname)
                    print(sql)
                    com(sql)
                    print(co)
                    break

            sql = 'select strid,oxid,pre from unistr where strid not in (select strid from score)'
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                strid = r[0]
                oxid = r[1]
                url = 'https://string-db.org/api/tsv-no-header/interaction_partners?identifiers=' + strid + '&required_score=' \
                                                                                                            '900&limit=10&species=' + oxid
                print(url)
                response = requests.get(url)
                if response.status_code == 200:
                    response.encoding = response.apparent_encoding
                    if response.text:
                        txt = response.text.split('\n')
                        for t in txt:
                            if t:
                                t = t.split('\t')
                                sql = 'insert into score values("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")' % \
                                      (r[2], strid, t[1], t[3], t[5], t[6], t[7], t[8], t[9], t[10], t[11], t[12])
                                print(sql)
                                com(sql)

            sql = 'select distinct strid from score where strid not in (select strid from interact)'
            cur.execute(sql)
            res = cur.fetchall()
            for r in res:
                strid = r[0]
                sql = 'select oxid,idb from unistr,score where unistr.strid=score.strid and score.strid="%s"' % strid
                cur.execute(sql)
                fes = cur.fetchall()
                oxid = fes[0][0]
                ids = [strid,]
                for fe in fes:
                    ids.append(fe[1])
                if ids:
                    ids = '%0d'.join(ids)
                    url = 'https://string-db.org/api/tsv-no-header/enrichment?identifiers=' + ids + '&species=' + oxid
                    print(url)
                    response = requests.get(url)
                    if response.status_code == 200:
                        response.encoding = response.apparent_encoding
                        if response.text:
                            txt = response.text.split('\n')
                            for t in txt:
                                if t:
                                    t = t.split('\t')
                                    if strid in t[5]:
                                        sql = 'insert into interact values("%s","%s","%s","%s","%s","%s","%s","%s")' % (
                                            strid, str(t[0]), str(t[1]), str(t[5]), str(t[6]), str(t[7]),
                                            str(t[8]),
                                            str(t[9]))
                                        print(sql)
                                        com(sql)

                print(count)
                count = count + 1

    def sss(self):
        if not self.count_funs > 0:
            sql = 'insert into sss select strid,oxid from unistr union select idb as strid,oxid from score,unistr ' \
                  'where score.strid = unistr.strid'
            com(sql)

    def stri(self):
        if not self.count_funs > 0:
            sql = 'select strid,oxid from sss where (strid,oxid) not in (select strid,oxid from string);'
            cur.execute(sql)
            res = cur.fetchall()
            count = 1
            for re in res:
                while True:
                    url = 'https://string-db.org/api/tsv-no-header/get_string_ids?identifiers=' + re[0] + '&species=' + \
                          re[1]
                    print(url)
                    try:
                        r = requests.get(url)
                    except:
                        pass
                    else:
                        if r.status_code == 200:
                            r.encoding = r.apparent_encoding
                            break
                if r.text:
                    bbs = r.text.strip().split('\t')
                    sql = 'insert into stringa values ("%s","%s","%s","%s","%s")' % (re[0], bbs[4], bbs[2], bbs[3], bbs[5].strip())
                    print(sql)
                    com(sql)
                print(count)
                count = count + 1

    def biogrid(self):
        if not self.count_funs > 0:
            sql = "select gene_name from uni1 where gene_name !='' and gene_name not in (select genname from biogrid_interaction)"
            cur.execute(sql)
            bls = cur.fetchall()
            count = 1
            for bl in bls:
                url_visit = 'https://webservice.thebiogrid.org/interactions/?searchNames=true&geneList=%s&includeEvidence=ture&includeInteractors=true&start=0&interSpeciesExcluded=ture&max=10&accesskey=fbdd7990124cae3f08245b84df60a053' % \
                            bl[0]
                try:
                    crawl_content = urlrequest.urlopen(url_visit).read()
                except:
                    pass
                else:
                    print(crawl_content)
                    cr = r"%s" % crawl_content
                    if cr == '':
                        pass
                    else:
                        sss = crawl_content.decode('UTF-8').split('\n')
                        for ss in sss[:-1]:
                            s = ss.split('\t')
                            print('s7: ' + s[8])
                            print('bl0:' + bl[0])

                            if s[7].upper() == bl[0].upper():
                                print(s[7])
                                gn = bl[0]
                                inn = s[8]
                                bid = s[0]
                                es = s[11]
                                est = s[12]
                                au = s[13]
                                pid = s[14]
                                og = s[15]
                                oi = s[16]
                            else:
                                gn = bl[0]
                                inn = s[7]
                                bid = s[0]
                                es = s[11]
                                est = s[12]
                                au = s[13]
                                pid = s[14]
                                og = s[16]
                                oi = s[15]
                            sql = 'insert into biogrid_interaction values("%s","%s","%s","%s","%s","%s","%s","%s","%s")' % (
                            gn, inn, bid, es, est, au, pid, og, oi)
                            print(sql)
                            com(sql)
                            print(count)
                            count = count + 1