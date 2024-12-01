<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";
$database = new DBController();

$search = isset($_GET['query']) ? $_GET['query'] : '';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

$limit = 4;

$offset = ($page - 1) * $limit;

$query = "SELECT * FROM articles ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$articles = $database->getDBResult($query);

$totalArticlesQuery = "SELECT COUNT(*) as total FROM articles";
$totalArticlesResult = $database->getDBResult($totalArticlesQuery);
$totalArticles = $totalArticlesResult[0]['total'];
$totalPages = ceil($totalArticles / $limit);


$membersQuery = "
    SELECT m.*, COUNT(a.id) AS article_count
    FROM members m
    LEFT JOIN articles a ON m.id = a.member_id
    WHERE m.role != 'Admin'
    GROUP BY m.id
    ORDER BY article_count DESC
    LIMIT 3
";

$membersToDisplay = $database->getDBResult($membersQuery);



$query = "SELECT * FROM members WHERE 1 AND role!='Admin'";
$params = [];




$query="SELECT * FROM events ORDER BY created_at DESC";
$events = $database->getDBResult($query);


$eventsPage = isset($_GET['events_page']) ? (int)$_GET['events_page'] : 1;
$eventsPage = max($eventsPage, 1); // Asigură-te că pagina este cel puțin 1

$eventsLimit = 4;

$eventsOffset = ($eventsPage - 1) * $eventsLimit;

$eventsQuery = "SELECT * FROM events ORDER BY created_at DESC LIMIT $eventsLimit OFFSET $eventsOffset";
$events = $database->getDBResult($eventsQuery);

$totalEventsQuery = "SELECT COUNT(*) as total FROM events";
$totalEventsResult = $database->getDBResult($totalEventsQuery);
$totalEvents = $totalEventsResult[0]['total'];
$totalEventPages = ceil($totalEvents / $eventsLimit);

?>
<link rel="stylesheet" href="css/rh_style.css">


<div class="jumbotron">
<h1 class="text-white">Resource Hub</h1><hr>
<h3 class="text-white">Explore through articles and resources, made for you by our community!  </h3>
</div>
<h3 class="text-white">Most active members:</h3>

<div class="row">
    <?php foreach ($membersToDisplay as $row): ?>
        <div class="col-md-4">
            <div class="card member-card">
                <a class="card-link" style="text-decoration: none; color: inherit;" href="m_profile.php?id=<?php echo $row['id']; ?>">
                    <div class="card-head m-t-5">
                        <h5 class="text-center text-white"><?php echo htmlspecialchars($row['role']); ?></h5>
                    </div>
                </a>
                <div class="card-body">
                    <a class="card-link" style="text-decoration: none; color: inherit;" href="m_profile.php?id=<?php echo $row['id']; ?>">
                        <h5 class="card-title text-center"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h5>
                        <img src="<?php echo htmlspecialchars($row['profile_pic']); ?>" class="rounded-circle card-img-top" alt="...">
                        <p class="card-text text-center">
                            <strong>Profession:</strong> <?php echo htmlspecialchars($row['profession']); ?><br>
                            <strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="page-content page-container">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class=" col-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm">
                            <div id="articles" class="card-block">
                                <h4 class="m-b-20 p-b-5 b-b-default f-w-600 d-flex justify-content-between bline">
                                    Check out the latest articles!
                                </h4>

                            </div>

                        </div>
                    </div>
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

            </div>

        </div>

    </div>
</div>

<div class="page-content page-container pt-3">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class=" col-12" id="events">
                <div class="card user-card-full ppp">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm">
                            <div id="articles" class="card-block">
                                <h4 class="m-b-20 p-b-5 b-b-default f-w-600 d-flex justify-content-between bline">
                                    Events
                                    <a href="add_event.php">Host your own event!</a>
                                </h4>

                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <?php foreach ($events as $event): ?>
                            <a style="text-decoration: none; color:inherit;" href="event.php?id=<?php echo $event['id']; ?>">
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
                    <div id="event-pagination-container" class="pagination d-flex justify-content-center pb-3">
                        <a href="?events_page=<?php echo max(1, $eventsPage - 1); ?>#events"
                           class="page-link <?php echo ($eventsPage == 1) ? 'disabled' : ''; ?>">Prev</a>

                        <?php if ($totalEventPages > 2): ?>

                            <a href="?events_page=1#events"
                               class="mr-2 page-link <?php echo ($eventsPage == 1) ? 'disabled' : ''; ?>">1</a>

                            <h4 class="pl-3 pr-3 pt-1"><?php echo $eventsPage; ?></h4>

                            <a href="?events_page=<?php echo $totalEventPages; ?>#events"
                               class="ml-2 page-link <?php echo ($eventsPage == $totalEventPages) ? 'disabled' : ''; ?>">
                                <?php echo $totalEventPages; ?>
                            </a>

                        <?php else: ?>
                            <span class="page-link active"><?php echo $eventsPage; ?></span>
                        <?php endif; ?>

                        <a href="?events_page=<?php echo min($totalEventPages, $eventsPage + 1); ?>#events"
                           class="page-link <?php echo ($eventsPage == $totalEventPages) ? 'disabled' : ''; ?>">Next</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>



<?php
include_once "includes/footer.php";
?>

