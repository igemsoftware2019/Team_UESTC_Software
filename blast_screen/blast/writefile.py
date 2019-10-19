class W_F:
    def __init__(self,ds):
        self.ds = ds

    def writer(self,path):
        outf = open(path, 'r+')
        for dss in self.ds:
            outf.write(str(dss))
            if type(dss) == "list":
                for dsss in dss:
                    outf.write(dsss)
            outf.write('\n')
        outf.close()
        return