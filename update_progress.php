<?php
session_start();
include_once "config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new DBController();
        $programId = $_POST['program_id'];
        $menteeId = isset($_POST['mentee_id']) ? $_POST['mentee_id'] : null;

        if (!empty($menteeId)) {
            $query = "UPDATE mentorship_enrollments 
                      SET completed_chapters = completed_chapters + 1 
                      WHERE program_id = ? AND member_id = ?";
            $params = [$programId, $menteeId];
        } else {
            $query = "UPDATE mentorship_enrollments 
                      SET completed_chapters = completed_chapters + 1 
                      WHERE program_id = ?";
            $params = [$programId];
        }

        $result = $db->updateDB($query, $params);

        if ($result) {
            $_SESSION['success'] = "Progress updated successfully.";
        } else {
            $_SESSION['error'] = "No changes were made.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "An error occurred: " . $e->getMessage();
    }

    header("Location: profile.php");
    exit;
}
?>
