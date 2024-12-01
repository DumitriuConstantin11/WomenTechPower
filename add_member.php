<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    try {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {

            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role=$_POST['optradio'];
            $db = new DBController();
            $query = "INSERT INTO members (first_name, last_name,user_name, email,password,role, profession, company, expertise, linkedin_profile, profile_pic)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";

            $params = [
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['user_name'],
                $_POST['email'],
                $hashedPassword,
                $role,
                $_POST['profession'],
                $_POST['company'],
                $_POST['expertise'],
                $_POST['linkedin_profile'],
                $target_file
            ];

            $db->updateDB($query, $params);

            echo "Înregistrare reușită!";
            header("Location: profile.php");
            exit();
        } else {
            throw new Exception("A apărut o problemă la încărcarea fișierului.");
        }
    } catch (Exception $e) {
        echo "Eroare: " . $e->getMessage();
    }
}
?>
    <div class="form-container text-white">
        <h2>Join Now!</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="user_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>What do you want to be?</label>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" name="optradio" class="form-check-input" id="radio1" value="Member" checked>Member
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" name="optradio" class="form-check-input" id="radio2" value="Mentor">Mentor
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Profession</label>
                <input type="text" name="profession" class="form-control">
            </div>

            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" class="form-control">
            </div>

            <div class="form-group">
                <label>Expertise</label>
                <textarea name="expertise" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>LinkedIn Profile</label>
                <input type="url" name="linkedin_profile" class="form-control">
            </div>

            <div class="form-group">
                <label>Profile Pic</label>
                <input type="file" name="profile_pic" class="form-control" accept="image/jpeg, image/png">
            </div>

            <button style="margin-bottom: 10px" type="submit" class="btn btn-primary" >Add Member</button>

            <p>Already have an account? <a href="login.php">Login</a> </p>
        </form>
    </div>
<?php
include_once "includes/footer.php";
?>