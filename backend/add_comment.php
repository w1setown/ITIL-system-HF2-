<?php
include 'cors.php';
require_once 'db.php';


$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['ticket_id'], $data['user_id'], $data['tcomment'])) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO comment (ticket_id, user_id, tcomment, created_at) 
            VALUES (:ticket_id, :user_id, :tcomment, NOW())
        ");
        $stmt->execute([
            ':ticket_id' => $data['ticket_id'],
            ':user_id' => $data['user_id'],
            ':tcomment' => $data['tcomment']
        ]);

        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing required fields']);
}
