<?php
$page_title = "Upraviť recenziu";
require('parts/header.php');

require_once 'classes/Review.php';
$reviewManager = new Review();

$message = "";

if (!isset($_GET['id'])) {
    header("Location: admin.php?theme=" . $theme);
    exit();
}

$id = intval($_GET['id']);
$review = $reviewManager->getReviewById($id);

if (!$review) {
    die("Recenzia nebola nájdená.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upravit_recenziu'])) {
    $author = trim($_POST['author']);
    $text = trim($_POST['text']);
    $rating = intval($_POST['rating']);

    if (!empty($author) && !empty($text) && $rating >= 1 && $rating <= 5) {
        if ($reviewManager->updateReview($id, $author, $text, $rating)) {
            $message = "<p style='color: #4da6ff; font-weight: bold;'>Recenzia úspešne upravená!</p>";
            $review = $reviewManager->getReviewById($id);
        }
    }
}
?>

<main class="edit-page">
    <div class="container">
        <div class="content-box">
            <h2>✏️ Upraviť recenziu od: <?php echo htmlspecialchars($review['author']); ?></h2>
            <?php echo $message; ?>

            <form method="POST" action="edit-review.php?id=<?php echo $id; ?>&theme=<?php echo $theme; ?>" style="text-align: left; max-width: 500px; margin: 20px auto 0 auto;">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Autor:</label>
                    <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($review['author']); ?>" required>
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Hodnotenie:</label>
                    <select name="rating" class="form-control" style="background:#333; color:#fff; padding:10px; width:100%;">
                        <?php for($i=5; $i>=1; $i--): ?>
                            <option value="<?php echo $i; ?>" <?php echo $review['rating'] == $i ? 'selected' : ''; ?>><?php echo str_repeat('⭐', $i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label>Text recenzie:</label>
                    <textarea name="text" class="form-control" rows="5" required><?php echo htmlspecialchars($review['text']); ?></textarea>
                </div>
                <div style="text-align: center;">
                    <button type="submit" name="upravit_recenziu" class="tm-btn tm-btn-primary">Uložiť zmeny</button>
                    <a href="admin.php?theme=<?php echo $theme; ?>" class="tm-btn" style="background: #444; margin-left: 10px;">Späť</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require('parts/footer.php'); ?>
