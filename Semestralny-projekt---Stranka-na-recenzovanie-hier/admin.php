<?php
$page_title = "Administrácia hier a recenzií";
require('parts/header.php');

require_once 'classes/Game.php';
require_once 'classes/Review.php';

$gameManager = new Game();
$reviewManager = new Review();

$message = "";

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_to_delete = intval($_GET['id']);
    if ($gameManager->deleteGame($id_to_delete)) {
        $message = "<p style='color: #4da6ff; font-weight: bold;'>Hra bola úspešne zmazaná!</p>";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete_review' && isset($_GET['review_id'])) {
    $review_id = intval($_GET['review_id']);
    if ($reviewManager->deleteReview($review_id)) {
        $message = "<p style='color: #4da6ff; font-weight: bold;'>Recenzia bola úspešne odstránená!</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pridat_hru'])) {
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $release_year = intval($_POST['release_year']);
    if (!empty($title) && !empty($genre) && $release_year > 0) {
        if ($gameManager->createGame($title, $genre, $release_year)) {
            $message = "<p style='color: #4da6ff; font-weight: bold;'>Hra bola úspešne pridaná!</p>";
        }
    }
}

$games = $gameManager->getAllGames();
$reviews = $reviewManager->getAllReviews();
?>

    <main class="admin-page">
        <div class="container">
            <div class="content-box">
                <h2>⚙️ Riadiaci panel administrátora</h2>
                <?php echo $message; ?>

                <h3 style="margin-top: 20px;">Pridať novú hru</h3>
                <form method="POST" action="admin.php?theme=<?php echo $theme; ?>" style="text-align: left; max-width: 500px; margin: 0 auto 30px auto;">
                    <div class="form-group" style="margin-bottom: 15px;"><label>Názov:</label><input type="text" name="title" class="form-control" required></div>
                    <div class="form-group" style="margin-bottom: 15px;"><label>Žáner:</label><input type="text" name="genre" class="form-control" required></div>
                    <div class="form-group" style="margin-bottom: 20px;"><label>Rok:</label><input type="number" name="release_year" class="form-control" required></div>
                    <div style="text-align: center;"><button type="submit" name="pridat_hru" class="tm-btn tm-btn-primary">Pridať hru</button></div>
                </form>

                <hr style="border: 0; border-top: 1px solid #444; margin: 40px 0;">

                <h3>📋 Správa hier</h3>
                <div style="overflow-x: auto; text-align: left;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px;">
                        <thead><tr style="border-bottom: 2px solid #444;"><th style="padding:10px;">Názov</th><th style="padding:10px;">Žáner</th><th style="padding:10px;">Akcie</th></tr></thead>
                        <tbody>
                        <?php foreach($games as $game): ?>
                            <tr style="border-bottom: 1px solid #333;">
                                <td style="padding:10px;"><?php echo htmlspecialchars($game['title']); ?></td>
                                <td style="padding:10px;"><?php echo htmlspecialchars($game['genre']); ?></td>
                                <td style="padding:10px; text-align: center;">
                                    <a href="edit-game.php?id=<?php echo $game['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn" style="background:#ffaa00; font-size:0.8rem; padding:3px 10px; color:#000;">Upraviť</a>
                                    <a href="admin.php?action=delete&id=<?php echo $game['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn" style="background:#ff4d4d; font-size:0.8rem; padding:3px 10px;" onclick="return confirm('Zmazať hru?');">Zmazať</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <hr style="border: 0; border-top: 1px solid #444; margin: 40px 0;">

                <h3>💬 Správa používateľských recenzií</h3>
                <div style="overflow-x: auto; text-align: left;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                        <tr style="border-bottom: 2px solid #444;">
                            <th style="padding:10px;">Hra</th>
                            <th style="padding:10px;">Autor</th>
                            <th style="padding:10px;">Hodnotenie</th>
                            <th style="padding:10px;">Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($reviews)): ?>
                            <?php foreach($reviews as $rev): ?>
                                <tr style="border-bottom: 1px solid #333;">
                                    <td style="padding:10px; font-weight:bold; color:#4da6ff;"><?php echo htmlspecialchars($rev['game_title']); ?></td>
                                    <td style="padding:10px;"><?php echo htmlspecialchars($rev['author']); ?></td>
                                    <td style="padding:10px; color:#ffaa00;"><?php echo str_repeat('⭐', $rev['rating']); ?></td>
                                    <td style="padding:10px; text-align: center;">
                                        <a href="edit-review.php?id=<?php echo $rev['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn" style="background:#ffaa00; font-size:0.8rem; padding:3px 10px; color:#000;">Upraviť</a>
                                        <a href="admin.php?action=delete_review&review_id=<?php echo $rev['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn" style="background:#ff4d4d; font-size:0.8rem; padding:3px 10px;" onclick="return confirm('Naozaj zmazať túto recenziu?');">Zmazať</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="padding:10px; text-align:center;">Žiadne recenzie na správu.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

<?php require('parts/footer.php'); ?>