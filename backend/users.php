<?php
include 'cors.php';
require_once 'db.php';

try {
    $stmt = $pdo->prepare("SELECT id, username, role FROM user");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}