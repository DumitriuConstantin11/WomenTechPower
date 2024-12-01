<?php
include_once "config/database.php";
session_start();

$database = new DBController();
if (isset($_GET['id'])) {
    $memberId = $_GET['id'];


    $query = "DELETE FROM members WHERE id = ?";
    $params=[$memberId];
    $delete = $database->updateDB($query, $params);
}
header("Location: members.php");
exit();
?>