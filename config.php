<?php

$host = 'localhost';
$dbname = 'user-role-permission-php';
$dbuser = 'root';
$dbpassword = '';

try{
    $pdo = new PDO("mysql:host=$host; dbname=$dbname", $dbuser, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'Connection error: ' . $e->getMessate();
}

