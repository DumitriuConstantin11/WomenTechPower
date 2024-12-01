<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";

$database = new DBController();

if (isset($_GET['id'])) {
    $query = "SELECT * FROM articles WHERE id = ?";
    $params = [$_GET['id']];
    $article = $database->getDBResult($query, $params)[0];
} else {
    echo "Articolul nu a fost găsit.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $yt_link_raw = isset($_POST['yt_link']) ? $_POST['yt_link'] : null;
    $file_photo = $article['file_photo'];
    $file_video = $article['file_video'];

    function extractYouTubeID($url) {
        $parsedUrl = parse_url($url);
        $queryParams = [];

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            if (isset($queryParams['v'])) {
                return $queryParams['v'];
            }
        }

        if (isset($parsedUrl['host']) && $parsedUrl['host'] === 'youtu.be') {
            return trim($parsedUrl['path'], '/');
        }

        return null;
    }

    $yt_link = null;
    if ($yt_link_raw) {
        $yt_link = extractYouTubeID($yt_link_raw);
    }

    if (!empty($_FILES['file_photo']['name'])) {
        $target_dir = "articles_uploads/";
        $file_photo = $target_dir . basename($_FILES["file_photo"]["name"]);
        move_uploaded_file($_FILES["file_photo"]["tmp_name"], $file_photo);
    }

    if (!empty($_FILES['file_video']['name'])) {
        $target_dir = "articles_uploads/";
        $file_video = $target_dir . basename($_FILES["file_video"]["name"]);
        move_uploaded_file($_FILES["file_video"]["tmp_name"], $file_video);
    }

    try {
        $query = "UPDATE articles
                  SET title = ?, subject = ?, description = ?, file_photo = ?, file_video = ?, yt_link = ?
                  WHERE id = ?";
        $params = [$title, $subject, $description, $file_photo, $file_video, $yt_link, $_GET['id']];
        $database->updateDB($query, $params);

        header("Location: profile.php");
        exit();
    } catch (Exception $e) {
        echo "Eroare: " . $e->getMessage();
    }
}
?>
<script src="js/main.js"></script>
<div class="form-container text-white" style="border-radius: 12px">
    <h2>Edit your article!</h2>
    <hr>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label style="font-size: 20px">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        </div>
        <div class="form-group">
            <label style="font-size: 20px">Subject</label>
            <input type="text" name="subject" class="form-control" value="<?php echo htmlspecialchars($article['subject']); ?>">
        </div>
        <div class="form-group d-flex justify-content-between align-items-center mb-1">
            <label style="font-size: 20px" class="">Description</label>
            <div>
                <label for="file-photo-input" class="btn btn-light mr-2 p-1">📷</label>
                <input type="file" id="file-photo-input" name="file_photo" class="form-control" accept="image/jpeg, image/png" style="display: none;" onchange="showFileName('photo')">
                <label for="file-video-input" class="btn btn-light ml-2 p-1">📽️</label>
                <input type="file" id="file-video-input" name="file_video" class="form-control" accept="video/mp4" style="display: none;" onchange="showFileName('video')">
            </div>
        </div>
        <textarea name="description" class="form-control" required rows="10"><?php echo htmlspecialchars($article['description']); ?></textarea>

        <div class="form-group">
            <p id="file-photo-name">
                <?php if (!empty($article['file_photo'])): ?>
                    Current photo: <a href="<?php echo htmlspecialchars($article['file_photo']); ?>" target="_blank"><?php echo basename($article['file_photo']); ?></a>
                <?php endif; ?>
            </p>
            <p id="file-video-name">
                <?php if (!empty($article['file_video'])): ?>
                    Current video: <a href="<?php echo htmlspecialchars($article['file_video']); ?>" target="_blank"><?php echo basename($article['file_video']); ?></a>
                <?php endif; ?>
            </p>
        </div>

        <button style="margin-bottom: 10px" type="submit" class="btn btn-primary">Update Article</button>
    </form><br>
</div>

<?php
include_once "includes/footer.php";
?>
