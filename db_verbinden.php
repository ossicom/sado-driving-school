<?php
//env datei einbinden
require_once ('vendor/autoload.php');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASS = $_ENV['DB_PASS'];
$DB_NAME = $_ENV['DB_NAME'];


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME ); 
if ($mysqli->connect_error) {
  echo "<h2 style='color: red;'>Fehler bei der Datenbank Verbindung: </h2>"  . mysqli_connect_error() ;
    exit();
}else {
    $db_ok = "<h2 style='color: green; ' >Database Connection in Admin OK! </h2>";
    }
if (!$mysqli->set_charset('utf8')) {
   echo "<h2 style='color: red;'Fehler beim Laden von UTF8 </h2>"  . $mysqli->error;
}

?>