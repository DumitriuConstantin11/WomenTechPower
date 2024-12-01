<?php
session_start();
include_once "config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['event_id'];
    $memberId = $_POST['member_id'];
    $review = $_POST['review'];

    $db = new DBController();

    $query = "INSERT INTO event_reviews (event_id, member_id, review) VALUES (?, ?, ?)";
    $params = [$eventId, $memberId, $review];

    try {
        $db->updateDB($query, $params);
        header("Location: event.php?id=$eventId&review_submitted=1");
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
