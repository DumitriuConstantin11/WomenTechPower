<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women Tech Power</title>
    <link rel="icon" type="image/x-icon" href="media/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/event_style.css">
    <link rel="stylesheet" href="css/article_style.css">
    <link rel="stylesheet" href="css/rh_style.css">
    <link rel="stylesheet" href="css/profile_style.css">

    <script src="js/main.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <img src="media/logo.png" height="65px" width="65px">
        <a class="navbar-brand" href="index.php"> Women Tech Power</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" datatarget="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="members.php">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resource_hub.php">Resource hub</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Resource hub</a>
                </li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a
                            class="nav-link dropdown-toggle"
                            href="<?php echo isset($_SESSION['user_id']) ? '#' : 'add_member.php'; ?>"
                            id="navbardrop"

                    >
                        <?php if (isset($_SESSION['user_id'])): ?>
                            Hello, <?php echo htmlspecialchars($_SESSION['first_name']); ?>
                        <?php else: ?>
                            Create Account
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="dropdown-item" href="profile.php" id="profile-link">Profile</a>
                            <a class="dropdown-item" href="logout.php" id="logout-link">Logout</a>
                        <?php else: ?>
                            <a class="dropdown-item" href="login.php" id="login-link">Login</a>
                        <?php endif; ?>
                    </div>
                </li>

            </ul>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownToggle = document.getElementById('navbardrop');
            var dropdownMenu = dropdownToggle.nextElementSibling;

            dropdownToggle.addEventListener('mouseenter', function() {
                dropdownMenu.classList.add('show');
            });

            dropdownToggle.addEventListener('mouseleave', function() {
                if (!dropdownMenu.matches(':hover')) {
                    dropdownMenu.classList.remove('show');
                }
            });

            dropdownMenu.addEventListener('mouseenter', function() {
                dropdownMenu.classList.add('show');
            });

            dropdownMenu.addEventListener('mouseleave', function() {
                dropdownMenu.classList.remove('show');
            });
        });

        const isLoggedIn= <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>


</nav>


<div class="container mt-4">
