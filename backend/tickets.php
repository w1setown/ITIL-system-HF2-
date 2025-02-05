<?php
include 'cors.php';
require_once 'db.php';

function handleRequest($pdo) {
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                return getTicketById($pdo, $_GET['id']);
            }
            return getAllTickets($pdo);
            
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['action'])) {
                switch($data['action']) {
                    case 'create':
                        return createTicket($pdo, $data);
                    case 'update':
                        return updateTicket($pdo, $data);
                    case 'delete':
                        return deleteTicket($pdo, $data);
                }
            }
            return ['error' => 'Invalid action'];
    }
}

function getAllTickets($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM ticket ORDER BY created_at DESC");
    $stmt->execute();
    return ['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
}

function getTicketById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM ticket WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return ['success' => true, 'data' => $stmt->fetch(PDO::FETCH_ASSOC)];
}

function createTicket($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO ticket (title, description, tstatus, priority, created_at) 
                          VALUES (:title, :description, :tstatus, :priority, NOW())");
    $stmt->execute([
        ':title' => $data['title'],
        ':description' => $data['description'],
        ':tstatus' => $data['tstatus'],
        ':priority' => $data['priority']
    ]);
    
    return ['success' => true, 'id' => $pdo->lastInsertId()];
}

function updateTicket($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE ticket SET 
        title = :title, 
        description = :description, 
        tstatus = :tstatus, 
        priority = :priority 
        WHERE id = :id");
        
    $stmt->execute([
        ':id' => $data['id'],
        ':title' => $data['title'],
        ':description' => $data['description'],
        ':tstatus' => $data['tstatus'],
        ':priority' => $data['priority']
    ]);
    
    return ['success' => true, 'data' => ['id' => $data['id']]];
}

function deleteTicket($pdo, $data) {
    $stmt = $pdo->prepare("DELETE FROM ticket WHERE id = :id");
    $stmt->execute([':id' => $data['id']]);
    return ['success' => true];
}

$result = handleRequest($pdo);
echo json_encode($result);