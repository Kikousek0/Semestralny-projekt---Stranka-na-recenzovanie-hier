<?php
require('parts/header.php');

require_once 'classes/Game.php';
require_once 'classes/Review.php';

$gameManager = new Game();
$reviewManager = new Review();

if (!isset($_GET['id'])) {
    header("Location: index.php?theme=" . $theme);
    exit();
}

$game_id = intval($_GET['id']);
$game = $gameManager->getGameById($game_id);

if (!$game) {
    die("Hra nebola nájdená.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pridat_recenziu'])) {
    $author = trim($_POST['author']);
    $text = trim($_POST['text']);
    $rating = intval($_POST['rating']);

    if (!empty($author) && !empty($text) && $rating >= 1 && $rating <= 5) {
        if ($reviewManager->createReview($game_id, $author, $text, $rating)) {
            $message = "<p style='color: #4da6ff; font-weight: bold;'>Recenzia bola úspešne pridaná!</p>";
        } else {
            $message = "<p style='color: #ff4d4d; font-weight: bold;'>Chyba pri pridávaní recenzie.</p>";
        }
    } else {
        $message = "<p style='color: #ffaa00; font-weight: bold;'>Vyplňte všetky polia správne a zvoľte hodnotenie 1 až 5.</p>";
    }
}

$reviews = $reviewManager->getReviewsByGameId($game_id);
?>

    <main class="detail-page">
        <div class="container">
            <div class="content-box" style="margin-bottom: 30px;">
                <a href="index.php?theme=<?php echo $theme; ?>" style="font-size: 0.9rem; color: #4da6ff; text-decoration: none;">&larr; Späť na prehľad hier</a>
                <h2 style="margin-top: 15px;"><?php echo htmlspecialchars($game['title']); ?></h2>
                <p>Žáner: <strong><?php echo htmlspecialchars($game['genre']); ?></strong> | Rok vydania: <strong><?php echo htmlspecialchars($game['release_year']); ?></strong></p>
            </div>

            <div class="content-box" style="margin-bottom: 30px;">
                <h3>✍️ Pridať vlastné hodnotenie</h3>
                <?php echo $message; ?>

                <form method="POST" action="game-detail.php?id=<?php echo $game_id; ?>&theme=<?php echo $theme; ?>" style="text-align: left; margin-top: 15px;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Vaša prezývka / Meno:</label>
                        <input type="text" name="author" class="form-control" required placeholder="Napr. PlayerOne">
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Hodnotenie (1 - najhoršie, 5 - najlepšie):</label>
                        <select name="rating" class="form-control" style="background: #333; color: #fff; border: 1px solid #555; padding: 10px; border-radius: 5px; width: 100%;" required>
                            <option value="5">⭐⭐⭐⭐⭐ (5/5) - Dokonalá hra</option>
                            <option value="4">⭐⭐⭐⭐ (4/5) - Veľmi dobrá</option>
                            <option value="3">⭐⭐⭐ (3/5) - Priemerná hra</option>
                            <option value="2">⭐⭐ (2/5) - Slabá hra</option>
                            <option value="1">⭐ (1/5) - Odpad / Nebavilo ma</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label>Vaša recenzia:</label>
                        <textarea name="text" class="form-control" rows="5" placeholder="Napíšte, čo sa vám na hre páčilo alebo nepáčilo..." required></textarea>
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" name="pridat_recenziu" class="tm-btn tm-btn-primary">Odoslať recenziu</button>
                    </div>
                </form>
            </div>

            <div class="content-box">
                <h3>💬 Používateľské recenzie (<?php echo count($reviews); ?>)</h3>
                <hr style="border: 0; border-top: 1px solid #444; margin: 15px 0;">

                <div class="reviews-list" style="text-align: left;">
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="review-item" style="background: rgba(0,0,0,0.15); padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 3px solid #ffaa00;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9rem; color: #aaa;">
                                    <strong>👤 <?php echo htmlspecialchars($review['author']); ?></strong>
                                    <span>📅 <?php echo date('d.m.Y H:i', strtotime($review['created_at'])); ?></span>
                                </div>
                                <div style="color: #ffaa00; margin-bottom: 8px; font-size: 1.1rem;">
                                    <?php echo str_repeat('⭐', $review['rating']); ?>
                                </div>
                                <p style="margin: 0; line-height: 1.5; color: #eee;"><?php echo nl2br(htmlspecialchars($review['text'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; color: #888; margin-top: 20px;">K tejto hre zatiaľ nikto nenapísal recenziu. Buďte prvý!</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>

<?php require('parts/footer.php'); ?>