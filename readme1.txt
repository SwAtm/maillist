Changes to be done:

file: maillist/application/config/constants.php

Folder to save generated reports, should be writable
define('SAVEPATH','/home/freak/');

May not be necessary to change so long as images load.
define ('IMGPATH', 'application/');


//name in header
define ('NAME', 'Ramakrishna Mission Ashrama, Belgaum');

//name on receipt
define ('NAMER', 'Ramakrishna Mission Ashrama');

//address line 1 on receipt
define ('ADD1', 'Fort, Belgaum, Karnataka - 590016');

//address line 2 on receipt
define ('ADD2', 'Ph: 0831 2432789 / 2970320 / 321 :: email: belgaum@rkmm.org');

//designation
define ('DESIGN', 'Secretary');

//name of adhyaksha/secy
define ('DNAME', 'Swami Atmapranananda');


application/config/database towards end of file
set database connection parameters

applicatios/views/receipts/rprint
Change 80G regn number and PAN


Replace Signature.jpg in maillist/application
Replace logo.jpg in maillist/application


import database

Backend:
table pwd
generate hash for your password and add to this table
present pwd is fort07



