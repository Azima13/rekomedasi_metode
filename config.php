<?php

//-- database configurations
$dbhost='wisata-sql.mysql.database.azure.com';
$dbuser='mysqldbuser@wisata-sql';
$dbpass='azima0311#';
$dbname='db_wisata_lombok';
//-- database connections
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
//-- halt and show error message if connection fail

if ($db->connect_error) {
    die('Connect Error ('.$db->connect_errno.')'.$db->connect_error);
}

?>
