<?php
include 'cors.php';
require_once 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'], $data['title'], $data['description'], $data['tstatus'], $data['priority'])) {
    try {
        $stmt = $pdo->prepare("UPDATE ticket SET title = :title, description = :description, tstatus = :tstatus, priority = :priority WHERE id = :id");
        $stmt->execute([
            'id' => $data['id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'tstatus' => $data['tstatus'],
            'priority' => $data['priority']
        ]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid input']);
}