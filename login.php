<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = new DBController();
        $query = "SELECT id, password, first_name,role FROM members WHERE user_name = ?";
        $user = $db->getDBResult($query, [$username]);
        if ($user && password_verify($password, $user[0]['password'])) {
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['first_name'] = $user[0]['first_name'];
            $_SESSION['role'] = $user[0]['role'];
            $_SESSION['member_id'] = $_SESSION['user_id'];
            header("Location: profile.php");
            exit;
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Please enter username and password";
    }
}
?>

<div class="form-container" style="border-radius: 2px; margin-top: 100px">
    <h2 class="text-white">Hey! Welcome back!</h2>
    <form class="text-white" method="post">
        <div class="form-group">
            <label for="usr">User Name:</label>
            <input type="text" class="form-control" id="usr" name="username" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="password" required>
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
        <p style="display: inline">Don't have an account? <a class="btn-info p-1" href="add_member.php" style="border-radius: 2px">Register now!</a></p>
    </form>
</div>

