from address_sequences import A_S

# f1 = open('datasets\/test_f.txt','r')
# f2 = open('datasets\/test_no_f.txt','r')
# f3 = open('datasets\/test_no_seq.txt','r')

f1 = open('datasets\/feature_parts.txt','r')
f2 = open('datasets\/no_feature_parts.txt','r')
f3 = open('datasets\/no_sequence_parts.txt','r')

A_S1 = A_S(f1, f2, f3)
l1,l2 = A_S1.main()
l = l1 + l2

with open("Sequences.fasta", "w") as file_output:
    i = 0
    gene_move_empty = []
    keys = ['igem_id', 'type', 'start', 'stop', 'gene_part']
    for g in l:
        file_output.write(">igem_id: " + g['igem_id'])
        j = 1
        gene_move_empty.append(g)
        while j < 4:
            file_output.write("; " + keys[j] + ": "+ str(g[keys[j]]))
            j += 1
        file_output.write("\n"+ g['gene_part'] + "\n")
        i+=1
        print(i)

