<?php
include("cors.php");

// db connection for both programmers
$host = 'localhost';
$dbname = 'it_servicedb';


$username1 = 'gabriel';
$password1 = 'you_shall_pass';


$username2 = 'root';
$password2 = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username1, $password1);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e1) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username2, $password2);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e2) {
        // error msg if fail
        die(json_encode(['error' => 'Database connection failed: ' . $e2->getMessage()]));
    }
}