<?php
include 'cors.php';
require_once 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['title'], $data['description'], $data['tstatus'], $data['priority'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO ticket (title, description, tstatus, priority, created_at) VALUES (:title, :description, :tstatus, :priority, NOW())");
        $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':tstatus' => $data['tstatus'],
            ':priority' => $data['priority']
        ]);

        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid input']);
}