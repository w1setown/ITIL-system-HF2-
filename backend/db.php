<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$host = 'localhost';            // Your database host
$dbname = 'it_servicedb';       // Name of the database
$username = 'gabriel';          // Your database username
$password = 'you_shall_pass';   // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Return a JSON response with the error message
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}