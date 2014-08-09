createZip
=========

Creating a zip archive from a folder :

The function takes two parameters. 
The first is the source file path 
The second and the path to the archive.

For example : createZip('../www/','../backup/'.date("j-m-Y_G-i").'/');

This php script can be used to backup a folder with a CRON.

* author Clément POUJOL alias Monobloclimber
* version 1
* copyright clementpoujol.fr