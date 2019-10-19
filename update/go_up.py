import urllib.request as urlrequest
import json
from pymysql_com import com, cur

class UpdateGo:
    def __init__(self, count_funs, count_funs_als):
        self.count_funs = count_funs
        self.count_funs_als = count_funs_als

    def updatego(self):
        self.go()
        self.count_f()
        return [int(self.count_funs), int(self.count_funs_als)]

    def count_f(self):
        self.count_funs = self.count_funs - 1
        if self.count_funs < 0:
            self.count_funs_als = self.count_funs_als + 1
        with open('count_funs.txt', 'w', encoding='utf8') as fs:
            fs.write(str(self.count_funs_als))

    def go(self):
        if not self.count_funs > 0:
            sql = "select uniid from uni1 where uniid !='' and uniid not in (select uniid from go);"
            cur.execute(sql)
            bls = cur.fetchall()
            for bl in bls:
                url_visit = 'https://www.ebi.ac.uk/QuickGO/services/annotation/search?geneProductId=%s' % bl[0]
                print(url_visit)
                try:
                    crawl_content = urlrequest.urlopen(url_visit).read()
                except:
                    pass
                else:
                    data = json.loads(crawl_content)
                    # print(data)
                    ass = data['results']
                    for a in ass:
                        # print(type(a))
                        b = a['id']
                        # print(b.split('!')[0])
                        # print("geneProductId: ", a['geneProductId'])
                        c = a['reference']
                        # print(c.split(':')[0])
                        # print(c.split(':')[1])
                        if c.split(':')[0] == "GO_REF":
                            if a['withFrom']:
                                e = ""
                                fss = a['withFrom']
                                for f in fss:
                                    dss = f['connectedXrefs']

                                    for d in dss:
                                        e = e + "," + d['db'] + ":" + d['id']
                            else:
                                e = ""
                            sql = 'insert into go values("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")' % (
                                bl[0], a['geneProductId'], a['symbol'], a['qualifier'], a['goId'],
                                "https://www.ebi.ac.uk/QuickGO/term/" + a['goId'], a['goEvidence'], a['evidenceCode'],
                                "https://www.ebi.ac.uk/QuickGO/term/" + a['evidenceCode'], a['reference'],
                                "https://github.com/geneontology/go-site/blob/master/metadata/gorefs/goref-" + c.split(':')[
                                    1] + ".md", str(a['taxonId']),
                                "https://www.uniprot.org/taxonomy/" + str(a['taxonId']), a['assignedBy'], a['goAspect'],
                                a['goName'], e[1:])
                            print(sql)
                            com(sql)
                        else:
                            if a['withFrom']:
                                e = ""
                                fss = a['withFrom']
                                for f in fss:
                                    dss = f['connectedXrefs']

                                    for d in dss:
                                        e = e + "," + d['db'] + ":" + d['id']

                            else:
                                e = ""
                            sql = 'insert into go values("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")' % (
                                bl[0], a['geneProductId'], a['symbol'], a['qualifier'], a['goId'],
                                "https://www.ebi.ac.uk/QuickGO/term/" + a['goId'], a['goEvidence'], a['evidenceCode'],
                                "https://www.ebi.ac.uk/QuickGO/term/" + a['evidenceCode'], a['reference'],
                                "https://europepmc.org/abstract/MED/" + c.split(':')[1], str(a['taxonId']),
                                "https://www.uniprot.org/taxonomy/" + str(a['taxonId']), a['assignedBy'], a['goAspect'],
                                a['goName'], e[1:])
                            print(sql)
                            com(sql)