<?php  /* db-tilkobling */
/*
 *  Programmet foretar tilkobling til database-server og valg av database
 */

// Henter database-kredentialer fra miljøvariabler
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

// Etablerer tilkobling til MySQL-databasen
$db=mysqli_connect($host,$username,$password,$database) or die ("ikke kontakt med database-server");
/* tilkobling til database-serveren utført */
 ?>