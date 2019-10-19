import copy
class A_S:

    keys = ['igem_id', 'type', 'start', 'stop', 'gene_part']

    def __init__(self, f1, f2, f3):
        self.f1 = f1
        self.f2 = f2
        self.f3 = f3

    def address_feature(self, f):
        list = []
        igem_id = []
        for fs in f:
            values = fs.replace("\t", "")
            # from second position to the last position, step is 2
            values = values.split("\"")[1:-1:2]
            if len(values) < 5:
                continue
            # add the whole gene into the dictionary
            else:
                if (values[0] not in igem_id) and (values[1] != "BioBrick"):
                    value_new = copy.deepcopy(values)
                    igem_id.append(value_new[0])
                    value_new[1] = "All"
                    value_new[2] = 1
                    value_new[3] = len(value_new[4])
                    dic = dict(zip(self.keys, value_new))
                    print(dic)
                    list.append(dic)

                # split gene
                igem_id.append(values[0])
                start = int(values[2])
                stop = int(values[3])
                if len(values[4]) != stop - start + 1:
                # split gene into part
                    values.append(values[4][start - 1:stop])
                    values.pop(4)
                dic = dict(zip(self.keys, values))
                print(dic)
                list.append(dic)
        return list

    def address_no_feature(self, f):
        list = []
        for fs in f:
            values = fs.replace("\t", "")
            # from second position to the last position, step is 2
            values = values.split("\"")[1:-1:2]
            dic = dict(zip(self.keys, values))
            list.append(dic)
        return list

    def address_no_sequence_parts(self, f):
        pass

    def main(self):
        l1 = self.address_feature(self.f1)
        l2 = self.address_no_feature(self.f2)
        # self.address_no_sequence_parts(self.f3)
        return l1,l2