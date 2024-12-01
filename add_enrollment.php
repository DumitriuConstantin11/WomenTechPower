<?php
session_start();
include_once "config/database.php";

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $mentorProgramId = $_GET['id']; // ID-ul programului de mentorat
    $memberId = $_SESSION['user_id']; // ID-ul membrului

    try {
        $db = new DBController();

        $query = "INSERT INTO mentorship_enrollments (program_id, member_id) VALUES (?, ?)";
        $params = [$mentorProgramId, $memberId];

        $db->updateDB($query, $params);

        echo "Te-ai înregistrat cu succes la programul de mentorat!";
        header("Location: profile.php");
        exit;
    } catch (Exception $e) {
        echo "Eroare: " . $e->getMessage();
    }
} else {
    echo "Datele necesare nu sunt disponibile.";
}
?>
