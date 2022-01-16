<?php

$servername = "localhost";
$password = "unixpass";
$username = "unix";
$dsn = "mysql:host=$servername;finalproject";

$pdo = new PDO($dsn, $username, $password); 

?>

