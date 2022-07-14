<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
$host="DB_HOST_HERE";
$user="DB_USERNAME_HERE";
$db="DB_HERE";



try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,"PASSWORD_HERE");
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>