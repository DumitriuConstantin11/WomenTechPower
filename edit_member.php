<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";

$database = new DBController();
if (isset($_GET['id'])) {
    $query = "SELECT * FROM members WHERE id = ?";
    $params = [$_GET['id']];
    $member = $database->getDBResult($query, $params)[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $profile_pic = $member['profile_pic'];

    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $target_file;
        } else {
            echo "A apărut o problemă la încărcarea imaginii.";
        }
    }

    $hashedPassword = $member['password'];
    if (!empty($_POST['password'])) {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $query = "UPDATE members
              SET first_name = ?, last_name = ?, email = ?, password = ?, role = ?, profession = ?,
                  company = ?, expertise = ?, linkedin_profile = ?, profile_pic = ?
              WHERE id = ?";
    $params = [
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $hashedPassword,
        $_POST['role'],
        $_POST['profession'],
        $_POST['company'],
        $_POST['expertise'],
        $_POST['linkedin_profile'],
        $profile_pic,
        $_GET['id']
    ];

    $database->updateDB($query, $params);

    header("Location: members.php");
    exit();
}

$query = "SELECT * FROM members WHERE id = ?";
$params = [$_GET['id']];
$member = $database->getDBResult($query, $params)[0];
?>

<div class="form-container text-white">
    <h2>Edit Member</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($member['first_name']); ?>" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($member['last_name']); ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($member['email']); ?>" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep the current password">
        </div>
        <div class="form-group">
            <label>What do you want to be?</label>
            <div class="form-check-inline">
                <input type="radio" name="role" class="form-check-input" value="Member" <?php echo ($member['role'] === 'Member') ? 'checked' : ''; ?> required>
                <label class="form-check-label">Member</label>
            </div>
            <div class="form-check-inline">
                <input type="radio" name="role" class="form-check-input" value="Mentor" <?php echo ($member['role'] === 'Mentor') ? 'checked' : ''; ?>>
                <label class="form-check-label">Mentor</label>
            </div>
        </div>
        <div class="form-group">
            <label>Profession</label>
            <input type="text" name="profession" class="form-control" value="<?php echo htmlspecialchars($member['profession']); ?>">
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text" name="company" class="form-control" value="<?php echo htmlspecialchars($member['company']); ?>">
        </div>
        <div class="form-group">
            <label>Expertise</label>
            <textarea name="expertise" class="form-control"><?php echo htmlspecialchars($member['expertise']); ?></textarea>
        </div>
        <div class="form-group">
            <label>LinkedIn Profile</label>
            <input type="url" name="linkedin_profile" class="form-control" value="<?php echo htmlspecialchars($member['linkedin_profile']); ?>">
        </div>
        <div class="form-group">
            <label>Profile Pic</label>
            <input type="file" name="profile_pic" class="form-control" accept="image/jpeg, image/png">
            <?php if (!empty($member['profile_pic'])): ?>
                <img src="<?php echo htmlspecialchars($member['profile_pic']); ?>" alt="Profile Pic" style="width: 100px; height: auto; margin-top: 10px;">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update Member</button>
    </form>
</div>

<?php include_once "includes/footer.php"; ?>
