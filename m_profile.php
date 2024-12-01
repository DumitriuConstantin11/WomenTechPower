<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Profil invalid.";
    exit;
}

$memberId = $_GET['id'];

$database = new DBController();

$query = "SELECT * FROM members WHERE id = ?";
$params = [$memberId];

$members = $database->getDBResult($query, $params);

if (empty($members)) {
    echo "Utilizatorul nu a fost găsit.";
    exit;
}

$member = $members[0];



$query="SELECT * FROM articles WHERE member_id = ?";
$params = [$memberId];
$articles = $database->getDBResult($query, $params);

$query="SELECT * FROM events WHERE created_by = ?";
$params = [$memberId];
$events = $database->getDBResult($query, $params);



function getUserEvents($database, $userId) {
    $query = "SELECT * FROM events WHERE created_by = ?";
    return $database->getDBResult($query, [$userId]);
}

$userEvents = getUserEvents($database, $memberId);

$query = "SELECT * FROM mentorship_programs WHERE mentor_id = ?";
$params = [$memberId];
$mentorshipPrograms = $database->getDBResult($query, $params);
if(!empty($mentorshipPrograms)){


$mentorProgramId=$mentorshipPrograms[0]['id'];



$query="SELECT * FROM mentorship_enrollments WHERE member_id = ? AND program_id = ?";
$params = [$_SESSION['user_id'], $mentorProgramId];
$mentorshipEnrollments = $database->getDBResult($query, $params);
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$limit = 4;

$offset = ($page - 1) * $limit;

$query = "SELECT * FROM articles WHERE member_id = ? ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$params = [$memberId];
$articles = $database->getDBResult($query, $params);

$totalArticlesQuery = "SELECT COUNT(*) as total FROM articles WHERE member_id = ?";
$totalArticlesResult = $database->getDBResult($totalArticlesQuery, [$memberId]);

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
<?php
if ($member['role']=='Mentor' && !empty($mentorshipPrograms)) :
?>
<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class=" col-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm">
                            <div class="card-block">
                                <?php if(empty($mentorshipEnrollments)) : ?>
                                <h5 class="m-b-10 f-w-600 d-flex justify-content-between">
                                    Interested in a mentorship?
                                </h5>
                                <h2><?php echo $mentorshipPrograms[0]['program_name'] ?> with <?php echo $mentorshipPrograms[0]['total_chapters'] ?> chapters</h2>
                                <?php if($_SESSION['role'] != 'Mentor') : ?>
                                    <a href="add_enrollment.php?id=<?php echo $mentorProgramId ?>" >Enroll right now!</a>
                                <?php else: ?>
                                    <a href="#" >Enroll right now!</a>
                                <?php endif; ?>

                                <?php else : ?>
                                <h4><?php echo $mentorshipPrograms[0]['program_name'] ?></h4>
                                <h6 class="pb-2">by <?php echo $member['first_name'] ?> <?php echo $member['last_name'] ?></h6>

                                <div class="progress ">
                                    <div class=" progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $mentorshipEnrollments[0]['completed_chapters'] ?>" aria-valuemin="0" aria-valuemax="<?php echo $mentorProgramId['total_chapters'] ?>" style="width: <?php echo $mentorshipEnrollments[0]['completed_chapters']*10 ?>%"><?php echo $mentorshipEnrollments[0]['completed_chapters']*10 ?>%</div>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>
</div>
<?php endif; ?>
<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class=" col-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm" id="articles">
                            <div class="card-block">
                                <h4 class="m-b-20 p-b-5 b-b-default f-w-600 d-flex justify-content-between">
                                    Resources made for you
                                </h4>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($articles)) : ?>
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
                        <a href="?id=<?php echo $memberId; ?>&page=<?php echo max(1, $page - 1); ?>#articles" class="page-link <?php echo ($page == 1) ? 'disabled' : ''; ?>">Prev</a>

                        <?php if ($totalPages > 2): ?>
                            <a href="?id=<?php echo $memberId; ?>&page=1#articles" class="mr-2 page-link <?php echo ($page == 1) ? 'disabled' : ''; ?>">1</a>

                            <h4 class="pl-3 pr-3 pt-1"><?php echo $page; ?></h4>

                            <a href="?id=<?php echo $memberId; ?>&page=<?php echo $totalPages; ?>#articles" class="ml-2 page-link <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>"><?php echo $totalPages; ?></a>
                        <?php else: ?>
                            <span class="page-link active"><?php echo $page; ?></span>
                        <?php endif; ?>

                        <a href="?id=<?php echo $memberId; ?>&page=<?php echo min($totalPages, $page + 1); ?>#articles" class="page-link <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">Next</a>
                    </div>
                    <?php else: ?>
                    <div id="articles-container" class="article-list">
                        <div class=" py-5 d-flex justify-content-center align-items-center">
                            <h3 class="text-muted">No resources posted</h3>
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
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm">
                            <div class="card-block d-flex justify-content-between m-b-20 p-b-5 b-b-default f-w-600">
                                <h4 >Events</h4>
                            </div>

                        </div>
                    </div>
                    <?php if(!empty($events)): ?>
                    <div id="events-container" class="container">
                        <?php
                                            foreach ($events as $event) {
                                                $shortDescription = substr($event['description'], 0, 140);
                                                echo "
                                                       <a  style='text-decoration: none; color:inherit;' href='event.php?id=" . $event['id'] . "'>
                                                       <div class='col-12'>
                                                        <div class='card-articles'>
                                                        <h2 class='article-title'>" . htmlspecialchars($event['title']) . "</h2>
                                                        <p class='fifty-chars article-descr'>" . htmlspecialchars($shortDescription) . "...</p>
                                                        <p class='article-date text-muted'>".$event['created_at']."</p>
                                                        </div>
                                                      </div></a>";
                                            }
                                            ?>
                    </div>
                    <?php else: ?>
                    <div id="events-container" class="container">
                        <div class=" py-5 d-flex justify-content-center align-items-center">
                            <h3 class="text-muted">No events created</h3>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>
</div>





<?php
include_once "includes/footer.php";
?>
