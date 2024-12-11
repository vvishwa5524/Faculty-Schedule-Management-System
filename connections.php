<?php
$dblocalhost="localhost";
$dbuser = "root";
$dbpass="";
$dbname="main";
// if(!$con=mysqli_connect($dblocalhost,$dbuser,$dbpass,$dbname)){
//     die("failed to connect !");
// }
try {
    $pdo = new PDO("mysql:host=$dblocalhost;dbname=$dbname", $dbuser,$dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>