<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date= $_POST['event_date'];
    $location = $_POST['location'];
    $event_type = $_POST['optradio'];
    $max_participants= $_POST['max_participants'];
    $member_id = $_SESSION['member_id'];



    try {
        $db = new DBController();
        $query = "INSERT INTO events (title, description, event_date, location, event_type, max_participants, created_by) 
                  VALUES (?,? , ?, ?, ?, ?, ?)";
        $params = [$title, $description, $event_date, $location, $event_type, $max_participants, $member_id];
        $db->updateDB($query, $params);

        echo "Evenimentul a fost creat cu succes!";
        header("Location: profile.php");
        exit;
    } catch (Exception $e) {
        echo "Eroare: " . $e->getMessage();
    }
}
?>

    <script src="js/main.js"></script>
    <div class="form-container text-white" style="border-radius: 12px">
        <h2>Host an event!</h2>
        <hr>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label style="font-size: 20px">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group d-flex justify-content-between align-items-center mb-1">
                <label style="font-size: 20px" class="">Description</label>
            </div>
            <textarea name="description" class="form-control mb-2" required rows="10"></textarea>

            <div class="form-group">
                <label style="font-size: 20px">Event Date</label>
                <input type="date" name="event_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label style="font-size: 20px">Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <div class="form-group">
                <label style="font-size: 20px">Event type</label>
                <br>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" name="optradio" class="form-check-input" id="radio1" value="workshop">Workshop
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" name="optradio" class="form-check-input" id="radio2" value="mentoring">Mentoring
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio3">
                        <input type="radio" name="optradio" class="form-check-input" id="radio3" value="networking">Networking
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio4">
                        <input type="radio" name="optradio" class="form-check-input" id="radio4" value="conference">Conference
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label style="font-size: 20px">Maximum number of participants </label>
                <input type="number" name="max_participants" class="form-control" min="1" max="100" step="1" placeholder="Select a number" required>
            </div>

            <button style="margin-bottom: 10px" type="submit" class="btn btn-primary" >Publish</button>

        </form><br>
    </div>



<?php
include_once "includes/footer.php";
?>