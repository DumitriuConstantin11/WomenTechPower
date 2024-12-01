<?php
session_start();
include_once "config/database.php";

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $eventId = $_GET['id'];
    $memberId = $_SESSION['user_id'];

    try {
        $db = new DBController();
        $query = "INSERT INTO event_registrations (member_id, event_id) VALUES (?, ?)";
        $params = [$memberId, $eventId];

        $db->updateDB($query, $params);

        echo "Te-ai înregistrat cu succes la eveniment!";
        header("Location: event.php?id=$eventId");
        exit;
    } catch (Exception $e) {
        echo "Eroare: " . $e->getMessage();
    }
}
