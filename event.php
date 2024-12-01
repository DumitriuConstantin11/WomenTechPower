<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
    $database = new DBController();

    $query = "SELECT * FROM events WHERE id = ?";
    $event = $database->getDBResult($query, [$eventId]);

    if (!$event) {
        echo "<div class='container'><h2>Evenimentul nu a fost găsit!</h2></div>";
        include_once "includes/footer.php";
        exit;
    } else {
        $event = $event[0];
        $date = $event['event_date'];
        $formatted_date = date("d-m-Y", strtotime($date));
        $nameq="
            SELECT m.first_name, m.last_name 
            FROM members m
            INNER JOIN events e ON m.id = e.created_by
            WHERE e.id = ?;
        ";

        $params = [$eventId];
        $name_result = $database->getDBResult($nameq, $params);
    }
} else {
    echo "<div class='container'><h2>ID-ul evenimentului nu a fost specificat!</h2></div>";
    include_once "includes/footer.php";
    exit;
}




?>
<link rel="stylesheet" href="css/event_style.css">

<div class="evn-container">
    <div class="evn-head text-white">
        <h6 class="d-flex justify-content-center pt-3 ">
            - <?php echo htmlspecialchars($event['event_type']); ?> hosted by <?php echo htmlspecialchars($name_result[0]['first_name'])." ".htmlspecialchars($name_result[0]['last_name']) ?> -

        </h6>
        <h1 class="evn-title d-flex justify-content-center pt-1">
            <?php echo htmlspecialchars($event['title']); ?>

        </h1>
        <h5 class="d-flex justify-content-center ">
            📍<?php echo htmlspecialchars($event['location']); ?>
             🗓️<?php echo $formatted_date ?>
        </h5>

    </div>
    <br>
    <div class="evn-content">
        <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>

    </div>
    <br>
    <div class="going-to-btn d-flex justify-content-center">


        <?php
        $today = new DateTime();
        $eventDate = new DateTime($date);

        if ($eventDate > $today) {
            $nr_over_query = "SELECT COUNT(*) AS participant_count FROM event_registrations WHERE event_id = ?";
            $params = [$eventId];
            $nr_result = $database->getDBResult($nr_over_query, $params);
            $participant_count = $nr_result[0]['participant_count'];

            $gogoevent_query = "SELECT * FROM event_registrations WHERE event_id = ? AND member_id = ?";
            $params = [$eventId, $_SESSION['user_id']];
            $gogoresult = $database->getDBResult($gogoevent_query, $params);

            if (!empty($gogoresult)) {
                echo '<button class="btn btn-success btn-gogo">See you there!</button>';
            } elseif ($participant_count < $event['max_participants']) {
                echo '<a href="going_evn.php?id=' . $eventId . '" class="btn btn-danger btn-going">I am going!</a>';
            } else {
                echo '<button class="btn btn-secondary btn-nospots" disabled>No spots available</button>';
            }
        } else {
            echo "</div><h3 class='d-flex justify-content-center'>Sorry...This event is over.</h3>";
            echo "<p class='d-flex justify-content-center'>- Browse for other events in our Resource Hub -</p>";

            $review_check_query = "SELECT * FROM event_registrations WHERE event_id = ? AND member_id = ?";
            $params = [$eventId, $_SESSION['user_id']];
            $review_result = $database->getDBResult($review_check_query, $params);

            if (!empty($review_result)) {
                echo "<br><br><h3 class='d-flex justify-content-center'>You've been there, right? Tell us about it!</h3>";
                echo '<form action="submit_review.php" method="post" class="review-form d-flex justify-content-center">';
                echo '<input type="hidden" name="event_id" value="' . $eventId . '">';
                echo '<input type="hidden" name="member_id" value="' . $_SESSION['user_id'] . '">';
                echo '<textarea name="review" placeholder="Leave your review here..." required  rows="3" cols="55"></textarea>';
                echo '<button type="submit" class="btn btn-dark">Submit Review</button>';
                echo '</form>';
            }


        }
        ?>
    </div>


</div>


<?php
include_once "includes/footer.php";
?>
