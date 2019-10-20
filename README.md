# [BioMaster2.0](http://bio.biomaster-uestc.com/public/index.php/main/home)

![Please Refresh](https://github.com/igemsoftware2019/Team_UESTC_Software/raw/master/public/static/images/1004.png)


In this repository, not only contain all PHP codes about our web, but also contain all data, updata codes, docker and so on.

### Note : Please use "git clone" to get the repository avoid some big data missing in .zip !

    $ git clone https://github.com/igemsoftware2019/Team_UESTC_Software

## Installation

In order to share our project widely, we decided to use docker. If you only want to try BioMaster2.0, just click [here](http://bio.biomaster-uestc.com/public/index.php/main/home)

If you want to run our project on your localhost to be deepen. Please make sure you have already installed

    docker

and

    docker-compose 1.7.0+.

After gitclone, firstly, go to preject:


    $ cd ./uestcdock/

In this folder, using just one order to repeat our project:


    $ docker-compose up –d php nginx mysql elasticsearch

Then, you can visit http://localhost:80 to see our project running on your local.

### Note : Not all function run normally on docker. If you want to use prediction function, please goto [BioMaster2.0](http://bio.biomaster-uestc.com/public/index.php/main/home) have a try!!!


## Abuout BioMaster2.0

Synthetic biology desiderates a gene computer-aided design (Gene-CAD) system. BioMaster is dedicated to contributing a complete and comprehensive database, which is essential for the Gene-CAD. BioMaster integrated databases such as UniProt, STRING and GO on the basis of iGEM Registry to provide more comprehensive BioBrick information. 

Based on the version 1.0, BioMaster 2.0 has significantly stridden in three aspects: data integrity, searching accuracy and user friendliness. We doubled￼ our main reference databases by adding KEGG, BRENDA and other enzyme-related databases. Considering the feature of sequence annotation, we adopted filtering strategy with novel model to enhance the accuracy of mapping among databases. In addition, we redesigned and reconstructed the website architecture and database structure, and established a weight algorithm for searching results recommendation. 

All endeavors make BioMaster 2.0 a more integrated and more user-friendly database, which provides synthetic biologists with stable data updating and search services in the long term.

## BioME

Hope to make the idea of ynthetic biology more accessible and easier to the public, we decided to develop a puzzle game. BioME comes out.
 
### Usage
After clone, go to folder BioME where contain all we need. Just click "Catan(1).exe" to play. Remeber unchecking "windowed".
For linux user, you need get help from wine running BioME.
