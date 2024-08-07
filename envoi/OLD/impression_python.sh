#! /bin/bash

# on place la liste des fichiers à imprimer dans un fichier /tmp/ls.txt
/bin/ls *.py > /tmp/ls.txt

# on trie selon l'ordre alphabétique du nom
# /bin/cat /tmp/ls.txt | /usr/bin/sort -t _ -k 4 > /tmp/ls2.txt
/bin/cat /tmp/ls.txt | /usr/bin/sort -t _ -k 3 > /tmp/ls2.txt

echo "prêt à imprimer "$(sed -n '$=' /tmp/ls2.txt)" fichiers"
# on imprime chaque fichier
while read ligne
do
    echo "impression de "$ligne
    /usr/bin/a2ps $ligne
done < /tmp/ls2.txt

echo "c'est fini"

