<?php
require_once 'db.php';

try {
    // Fetch the title and content from the database
    $stmt = $pdo->prepare("SELECT title, content FROM knowledgebase");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $response = [
        'title' => isset($results[0]['title']) ? $results[0]['title'] : 'Default FAQ Title',
        'content' => $results
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}