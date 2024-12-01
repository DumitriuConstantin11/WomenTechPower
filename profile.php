<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$database = new DBController();

$query = "SELECT * FROM members WHERE id = ?";
$params = [$_SESSION['user_id']];

$members = $database->getDBResult($query, $params);

if (empty($members)) {
    echo "Utilizatorul nu a fost găsit.";
    exit;
}

$member = $members[0];

$query="SELECT * FROM articles WHERE member_id = ?";
$params = [$_SESSION['user_id']];
$articles = $database->getDBResult($query, $params);

$query="SELECT * FROM events WHERE created_by = ?";
$params = [$_SESSION['user_id']];
$events = $database->getDBResult($query, $params);

function getUpcomingEvents($database, $userId) {
    $query = "
        SELECT e.* 
        FROM events e
        INNER JOIN event_registrations er ON e.id = er.event_id
        WHERE er.member_id = ? AND e.event_date > NOW()
    ";
    return $database->getDBResult($query, [$userId]);
}

function getUserEvents($database, $userId) {
    $query = "SELECT * FROM events WHERE created_by = ?";
    return $database->getDBResult($query, [$userId]);
}

$upcomingEvents = getUpcomingEvents($database, $_SESSION['user_id']);
$userEvents = getUserEvents($database, $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['total_chapters'], $_POST['program_name'])) {
        $totalChapters = $_POST['total_chapters'];
        $programName = $_POST['program_name'];

        try {
            $db = new DBController();
            $query = "INSERT INTO mentorship_programs (mentor_id, program_name, total_chapters) 
                      VALUES (?, ?, ?)";
            $params = [$_SESSION['user_id'], $programName, $totalChapters];
            $db->updateDB($query, $params);

            echo "Evenimentul a fost creat cu succes!";
            header("Location: profile.php");
            exit;
        } catch (Exception $e) {
            echo "Eroare: " . $e->getMessage();
        }
    }
}

$query="SELECT * FROM mentorship_enrollments WHERE member_id = ?";
$params = [$_SESSION['user_id']];
$programs = $database->getDBResult($query, $params);
$program = null;
if (!empty($programs)) {
    $program = $programs[0];
    $query="SELECT * FROM mentorship_programs WHERE id=?";
    $params = [$program['program_id']];
    $prog = $database->getDBResult($query, $params);
    $prog_name = $prog[0]['program_name'];
    $prog_chapters = $prog[0]['total_chapters'];
    $query="SELECT * FROM members WHERE id=?";
    $params = [$prog[0]['mentor_id']];
    $mentor_n = $database->getDBResult($query, $params);
    $mentor_name=$mentor_n[0]['first_name']." ".$mentor_n[0]['last_name'];
}

$query="SELECT * FROM mentorship_programs WHERE mentor_id=?";
$params = [$_SESSION['user_id']];
$programs = $database->getDBResult($query, $params);
if (!empty($programs)) {
    $program = $programs[0];
    $query="SELECT * FROM mentorship_enrollments WHERE program_id=?";
    $params = [$program['id']];
    $prog = $database->getDBResult($query, $params);
    $query="SELECT * FROM mentorship_programs WHERE mentor_id=?";
    $params = [$_SESSION['user_id']];
    $prog_chapt = $database->getDBResult($query, $params);
    $prog_chapters = $prog_chapt[0]['total_chapters'];
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$limit = 4;

$offset = ($page - 1) * $limit;

$query = "SELECT * FROM articles WHERE member_id = ? ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$params = [$_SESSION['user_id']];
$articles = $database->getDBResult($query, $params);

$totalArticlesQuery = "SELECT COUNT(*) as total FROM articles WHERE member_id = ?";
$totalArticlesResult = $database->getDBResult($totalArticlesQuery, [$_SESSION['user_id']]);

$totalArticles = $totalArticlesResult[0]['total'];
$totalPages = ceil($totalArticles / $limit);


?>

<link rel="stylesheet" href="css/profile_style.css">

<div class="page-content page-container" id="page-content">
    <div class="padding pt-10">
        <div class="row container d-flex justify-content-center">
            <div class="col-6 col-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                    <img src="<?php echo htmlspecialchars($member['profile_pic'])?>" class="card-img-top" alt="User-Profile-Image">
                                </div>
                                <h3 class="f-w-600 fl_name"><?php echo htmlspecialchars($member['first_name'] . ' ' . $member['last_name']); ?></h3>
                                <i class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="f-w-600 mr-2 d-flex justify-content-end">

                                    <a href="edit_member.php?id=<?php echo $_SESSION['user_id']; ?>" class="text-muted">✏️</a>
                                </h6>
                                <div class="row pt-3">
                                    <div class="col-sm-6 mmb_info d-flex flex-column align-items-center">
                                        <p class="m-b-10 f-w-600 mmb_p">Profession</p>
                                        <h6 class="text-muted f-w-400 mmb_h"><?php echo htmlspecialchars($member['profession']); ?></h6>
                                    </div>
                                    <div class="col-sm-6 mmb_info d-flex flex-column align-items-center">
                                        <p class="m-b-10 f-w-600 mmb_p">Expertise</p>
                                        <h6 class="text-muted f-w-400 mmb_h"><?php echo htmlspecialchars($member['expertise']); ?></h6>
                                    </div>

                                    <div class="col-sm-6 mmb_info d-flex flex-column align-items-center">
                                        <p class="m-b-10 f-w-600 mmb_p">Email</p>
                                        <h6 class="text-muted f-w-400 mmb_h"><?php echo htmlspecialchars($member['email']); ?></h6>
                                    </div>
                                    <div class="col-sm-6 mmb_info d-flex flex-column align-items-center">
                                        <p class="m-b-10 f-w-600 mmb_p">Company</p>
                                        <h6 class="text-muted f-w-400 mmb_h"><?php echo htmlspecialchars($member['company']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-12">
                <div class="card user-card-full" id="mentorship-container">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm">
                            <div class="card-block">
                                <?php if ($_SESSION['role'] == 'Mentor'): ?>
                                    <?php if (!$program): ?>
                                        <h4 class="m-b-10 f-w-600 d-flex justify-content-between">
                                            Want to make a bigger impact on others?
                                            <a href="#" id="toggle-mentorship">Start a mentorship program! </a>
                                        </h4>
                                        <div id="mentorship-form" style="display: none;">
                                            <p>Start spreading your knowledge and help others grow!</p>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <input type="text" name="program_name" placeholder="Name of the program" required class="form-control mb-2">
                                                <input type="number" name="total_chapters" placeholder="Number of Chapters" required class="form-control mb-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <h4>Mentorship progress</h4>
                                        <h6>See the progress of your mentees</h6>
                                        <form method="POST" action="">
                                            <div class="form-group">
                                                <select class="form-control" name="mentee_id" onchange="this.form.submit()">
                                                    <option value="" disabled selected>Select your mentee</option>
                                                    <?php
                                                    if ($prog) {
                                                        foreach ($prog as $mentees) {
                                                            $menteeId = $mentees['member_id'];
                                                            $programId = $mentees['program_id'];
                                                            $query = "SELECT first_name, last_name FROM members WHERE id = ?";
                                                            $params = [$menteeId];
                                                            $mentee = $database->getDBResult($query, $params);
                                                            $menteeName = $mentee[0]['first_name'] . " " . $mentee[0]['last_name'];
                                                            echo "<option value='$menteeId'" . ((isset($_POST['mentee_id']) && $_POST['mentee_id'] == $menteeId) ? ' selected' : '') . ">$menteeName</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </form>

                                        <?php
                                        if (isset($_POST['mentee_id']) && !empty($_POST['mentee_id'])) {
                                            $query = "SELECT completed_chapters FROM mentorship_enrollments WHERE program_id = ? AND member_id = ?";
                                            $params = [$programId, $menteeId];
                                            $result = $database->getDBResult($query, $params);

                                            if (!empty($result)) {
                                                $completedChapters = $result[0]['completed_chapters'];
                                                $progressPercent = ($completedChapters / $prog_chapters) * 100;
                                                echo '<h3>' . $progressPercent . '</h3>';
                                                echo '<div class="progress mt-3">';
                                                echo '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="' . $progressPercent . '" aria-valuemin="0" aria-valuemax="10" style="width: ' . $progressPercent . '%;">' . $progressPercent . ' %</div>';
                                                echo '</div>';

                                                echo '<form method="POST" action="update_progress.php" class="d-flex justify-content-left mt-3">';
                                                echo '<input type="hidden" name="mentee_id" value="' . $menteeId . '">';
                                                echo '<input type="hidden" name="program_id" value="' . $programId . '">';
                                                echo '<button type="submit" class="btn btn-primary">Update Progress to this mentee</button>';
                                                echo '<button type="submit" class="btn btn-primary">Update All</button>';
                                                echo '</form>';
                                            } else {
                                                echo '<p class="text-danger mt-3">No progress found for the selected mentee.</p>';
                                            }
                                        } else {
                                            echo '<form method="POST" action="update_progress.php" class="d-flex justify-content-left mt-3">';
                                            echo '<input type="hidden" name="program_id" value="' . $programId . '"> ';
                                            echo '<button type="submit" class="btn btn-primary">Update All</button>';
                                        }
                                        ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($program): ?>

                                        <h4><?php echo $prog_name ?></h4>
                                        <h6 class="pb-2">by <a href="m_profile.php?id=<?php echo $prog[0]['mentor_id'] ?>"> <?php echo $mentor_name ?> </a></h6>

                                        <div class="progress ">
                                            <div class=" progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $program['completed_chapters'] ?>" aria-valuemin="0" aria-valuemax="<?php echo $prog_chapters ?>" style="width: <?php echo $program['completed_chapters']*10 ?>%"><?php echo $program['completed_chapters']*10 ?>%</div>
                                        </div>
                                    <?php else: ?>
                                    <h4>Need some guiding? Search for a mentor in the <a href="members.php" style="text-decoration: none"> Members </a>tab</h4>
                                    <?php endif; ?>
                                <?php endif; ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class=" col-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm" id="articles">
                            <div class="card-block">
                                <?php if(!empty($articles)): ?>
                                <h4 class="m-b-20 p-b-5 b-b-default f-w-600 d-flex justify-content-between">
                                    Your resources
                                    <a href="add_article.php" >Publish an article</a>

                                </h4>
                                <?php else : ?>
                                <h4 class="m-b-10 f-w-600 d-flex justify-content-between">
                                    It's a little empty here...
                                    <a href="add_article.php" >Publish an article</a>

                                </h4>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                    <?php if(!empty($articles)): ?>
                    <div>
                    <div id="articles-container" class="article-list">
                        <?php foreach ($articles as $article): ?>
                            <a href="article.php?id=<?php echo $article['id']; ?>" style="text-decoration: none; color:inherit;">
                                <div class="col-12">
                                    <div class="card-articles">
                                        <h2 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h2>
                                        <p class="fifty-chars article-descr">
                                            <?php echo htmlspecialchars(substr($article['description'], 0, 140)); ?>...
                                        </p>
                                        <p class="article-date text-muted"><?php echo $article['created_at']; ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div id="pagination-container" class="pagination d-flex justify-content-center pb-3">
                        <a href="?page=<?php echo max(1, $page - 1); ?>#articles" class="page-link <?php echo ($page == 1) ? 'disabled' : ''; ?>">Prev</a>

                        <?php if ($totalPages > 2): ?>

                            <a href="?page=1#articles" class="mr-2 page-link <?php echo ($page == 1) ? 'disabled' : ''; ?>">1</a>

                            <h4 class="pl-3 pr-3 pt-1"><?php echo $page; ?></h4>
                            <a href="?page=<?php echo $totalPages; ?>#articles" class="ml-2 page-link <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>"><?php echo $totalPages; ?></a>
                        <?php else: ?>
                            <span class="page-link active"><?php echo $page; ?></span>
                        <?php endif; ?>

                        <a href="?page=<?php echo min($totalPages, $page + 1); ?>#articles" class="page-link <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">Next</a>
                    </div>
                    </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>
</div>

<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class=" col-12">
                <div class="card user-card-full">
                    <div class="container card user-card-full">

                        <div class="d-flex justify-content-between align-items-center pt-2 evn-head b-b-default">
                            <h4 class="d-flex justify-content-between mb-0">
                                <span id="upcoming-events" class="evn-tab active-tab">Upcoming events</span>
                                <span id="your-events" class="evn-tab">Your events</span>
                            </h4>
                            <h4>
                            <a href="add_event.php" class="card-block">Host your own event!</a>
                            </h4>
                        </div>
                        <?php if(!empty($upcomingEvents)): ?>
                        <div id="upcoming-container" class="event-list">
                            <?php foreach ($upcomingEvents as $event): ?>
                                <a href="event.php?id=<?php echo $event['id']; ?>" style="text-decoration: none; color:inherit;">
                                    <div class="col-12">
                                        <div class="card-articles">
                                            <h2 class="article-title"><?php echo htmlspecialchars($event['title']); ?></h2>
                                            <p class="fifty-chars article-descr">
                                                <?php echo htmlspecialchars(substr($event['description'], 0, 140)); ?>...
                                            </p>
                                            <p class="article-date text-muted"><?php echo $event['created_at']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <div id="upcoming-container" class="event-list">

                                <div class=" py-5 d-flex justify-content-center align-items-center">
                                    <h3 class="text-muted">You have no events coming soon</h3>
                                </div>

                        </div>
                        <?php endif; ?>

                        <?php if(!empty($userEvents)): ?>
                        <div id="your-container" class="event-list" style="display: none;">
                            <?php foreach ($userEvents as $event): ?>
                                <a href="event.php?id=<?php echo $event['id']; ?>" style="text-decoration: none; color:inherit;">
                                    <div class="col-12">
                                        <div class="card-articles">
                                            <h2 class="article-title"><?php echo htmlspecialchars($event['title']); ?></h2>
                                            <p class="fifty-chars article-descr">
                                                <?php echo htmlspecialchars(substr($event['description'], 0, 140)); ?>...
                                            </p>
                                            <p class="article-date text-muted"><?php echo $event['created_at']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <div id="your-container" class="event-list" style="display: none;">
                            <div class=" py-5 d-flex justify-content-center align-items-center">
                                <h3 class="text-muted">You have not created an event yet</h3>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>


                </div>

            </div>

        </div>

    </div>
</div>

<script src="js/main.js"></script>
<script>
    function toggleUpdateButton() {
        const select = document.getElementById("menteeSelect");
        const updateButton = document.getElementById("updateButton");
        updateButton.style.display = select.value ? "inline-block" : "none";
    }
</script>


<?php
include_once "includes/footer.php";
?>
