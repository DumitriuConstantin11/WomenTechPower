<?php
include_once "config/database.php";
session_start();
$database = new DBController();

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    $query = "SELECT * FROM articles WHERE id = ? AND member_id = ?";
    $params = [$articleId, $_SESSION['user_id']];
    $article = $database->getDBResult($query, $params);

    if (!empty($article)) {
        $query = "DELETE FROM articles WHERE id = ?";
        $params = [$articleId];
        $delete = $database->updateDB($query, $params);

        header("Location: profile.php");
        exit();
    } else {
        echo "Nu ai permisiunea să ștergi acest articol.";
        exit();
    }
}
?>
