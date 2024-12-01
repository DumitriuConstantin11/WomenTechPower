<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $database = new DBController();

    $query = "SELECT * FROM articles WHERE id = ?";
    $article = $database->getDBResult($query, [$articleId]);

    if (!$article) {
        echo "<div class='container'><h2>Articolul nu a fost găsit!</h2></div>";
        include_once "includes/footer.php";
        exit;
    } else {
        $article = $article[0];
        $query = "SELECT * FROM members WHERE id = ?";
        $params=[$article['member_id']];
        $member = $database->getDBResult($query, $params);
        $memberName = $member[0]['first_name']." ".$member[0]['last_name'];
    }
} else {
    echo "<div class='container'><h2>ID-ul articolului nu a fost specificat!</h2></div>";
    include_once "includes/footer.php";
    exit;
}




?>
<link rel="stylesheet" href="css/article_style.css">

<div class="article-container">
    <div class="article-head text-white">
        <div class="art-title d-flex justify-content-center pt-3">
            <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            <h5 class="pl-3 pt-4"> by <?php echo htmlspecialchars($memberName); ?></h5>
        </div>

        <br>
        <div class="d-flex justify-content-between">
            <?php if (!empty($article['subject'])): ?>
                <h4 class="art-subject "><?php echo htmlspecialchars($article['subject'])?></h4>

            <?php endif; ?>
        <p class="text-muted art-date <?php echo empty($article['subject']) ? 'ml-auto' : ''; ?>  pb-1">
            Posted on: <?php echo htmlspecialchars($article['created_at']); ?>
        </p>
        </div>
    </div>

    <div class="art-content">
        <p><?php echo nl2br(htmlspecialchars($article['description'])); ?></p>

        <?php if (!empty($article['file_photo'])): ?>
            <div class="art-image">
                <img src="<?php echo htmlspecialchars($article['file_photo']); ?>" alt="Article Image" class="img-fluid">
            </div>
        <?php endif; ?>

        <?php if (!empty($article['file_video'])): ?>
            <div class="art-video">
                <video controls width="100%">
                    <source src="<?php echo htmlspecialchars($article['file_video']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        <?php endif; ?>

        <?php if (!empty($article['yt_link'])): ?>
            <div class="art-youtube">
                <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($article['yt_link']); ?>"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
        <?php endif; ?>

    </div>

    <?php if (isset($_SESSION['member_id']) && $_SESSION['member_id'] == $article['member_id']): ?>
        <div class="pt-3 d-flex justify-content-center text-muted " style="text-decoration: none">
            <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="sett_btn m-1 text-muted" data-toggle="tooltip" data-placement="bottom" title="Edit">🖋️ </a>
            <a href="delete_article.php?id=<?php echo $article['id'] ?>" class="sett_btn m-1 text-muted" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure?')">🗑️</a>
        </div>
    <?php endif; ?>

</div>





<?php
include_once "includes/footer.php";
?>
