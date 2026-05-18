<?php
$page_title = "Upraviť hru";
require('parts/header.php');

require_once 'classes/Game.php';
$gameManager = new Game();

$message = "";

if (!isset($_GET['id'])) {
    header("Location: admin.php?theme=" . $theme);
    exit();
}

$id = intval($_GET['id']);
$game = $gameManager->getGameById($id);

if (!$game) {
    die("Hra sa nenašla.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upravit_hru'])) {
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $release_year = intval($_POST['release_year']);

    if (!empty($title) && !empty($genre) && $release_year > 0) {
        if ($gameManager->updateGame($id, $title, $genre, $release_year)) {
            $message = "<p style='color: #4da6ff; font-weight: bold;'>Hra bola úspešne upravená!</p>";
            $game = $gameManager->getGameById($id);
        } else {
            $message = "<p style='color: #ff4d4d; font-weight: bold;'>Chyba pri úprave hry.</p>";
        }
    } else {
        $message = "<p style='color: #ffaa00; font-weight: bold;'>Vyplňte polia správne.</p>";
    }
}
?>

    <main class="edit-page">
        <div class="container">
            <div class="content-box">
                <h2>✏️ Upraviť hru: <?php echo htmlspecialchars($game['title']); ?></h2>
                <?php echo $message; ?>

                <form method="POST" action="edit-game.php?id=<?php echo $id; ?>&theme=<?php echo $theme; ?>" style="text-align: left; max-width: 500px; margin: 20px auto 0 auto;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Názov hry:</label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($game['title']); ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Žáner:</label>
                        <input type="text" name="genre" class="form-control" value="<?php echo htmlspecialchars($game['genre']); ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label>Rok vydania:</label>
                        <input type="number" name="release_year" class="form-control" min="1950" max="<?php echo date('Y') + 5; ?>" value="<?php echo htmlspecialchars($game['release_year']); ?>" required>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" name="upravit_hru" class="tm-btn tm-btn-primary">Uložiť zmeny</button>
                        <a href="admin.php?theme=<?php echo $theme; ?>" class="tm-btn" style="background: #444; margin-left: 10px;">Späť do administrácie</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php require('parts/footer.php'); ?>