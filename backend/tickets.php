<?php
include 'cors.php';
require_once 'db.php';

function fetchAllTickets($pdo) {
    $stmt = $pdo->prepare("SELECT id, title, description, tstatus, priority, created_at FROM ticket");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchTicketById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT id, title, description, tstatus, priority, created_at FROM ticket WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

try {
    if (isset($_GET['id'])) {
        $ticket = fetchTicketById($pdo, $_GET['id']);
        echo json_encode($ticket);
    } else {
        $tickets = fetchAllTickets($pdo);
        echo json_encode($tickets);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}