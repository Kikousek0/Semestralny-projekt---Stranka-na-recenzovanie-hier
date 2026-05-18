<?php
$page_title = "Administrácia hier";
require('parts/header.php');

require_once 'classes/Game.php';
$gameManager = new Game();

$message = "";

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_to_delete = intval($_GET['id']);
    if ($gameManager->deleteGame($id_to_delete)) {
        $message = "<p style='color: #4da6ff; font-weight: bold;'>Hra bola úspešne zmazaná!</p>";
    } else {
        $message = "<p style='color: #ff4d4d; font-weight: bold;'>Chyba pri mazaní hry.</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pridat_hru'])) {
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $release_year = intval($_POST['release_year']);

    if (!empty($title) && !empty($genre) && $release_year > 0) {
        $success = $gameManager->createGame($title, $genre, $release_year);
        if ($success) {
            $message = "<p style='color: #4da6ff; font-weight: bold;'>Hra bola úspešne pridaná!</p>";
        } else {
            $message = "<p style='color: #ff4d4d; font-weight: bold;'>Chyba pri ukladaní hry.</p>";
        }
    } else {
        $message = "<p style='color: #ffaa00; font-weight: bold;'>Prosím, vyplňte všetky polia správne.</p>";
    }
}

$games = $gameManager->getAllGames();
?>

    <main class="admin-page">
        <div class="container">
            <div class="content-box">
                <h2>⚙️ Administrácia - Pridať novú hru</h2>
                <?php echo $message; ?>

                <form method="POST" action="admin.php?theme=<?php echo $theme; ?>" style="text-align: left; max-width: 500px; margin: 0 auto 40px auto;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Názov hry:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Žáner:</label>
                        <input type="text" name="genre" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label>Rok vydania:</label>
                        <input type="number" name="release_year" class="form-control" min="1950" max="<?php echo date('Y') + 5; ?>" required>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" name="pridat_hru" class="tm-btn tm-btn-primary">Pridať hru</button>
                    </div>
                </form>

                <hr style="border: 0; border-top: 1px solid #444; margin: 40px 0;">

                <h2>📋 Zoznam spravovaných hier</h2>
                <div style="overflow-x: auto; text-align: left;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                        <thead>
                        <tr style="border-bottom: 2px solid #444;">
                            <th style="padding: 10px;">Názov</th>
                            <th style="padding: 10px;">Žáner</th>
                            <th style="padding: 10px;">Rok</th>
                            <th style="padding: 10px; text-align: center;">Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($games)): ?>
                            <?php foreach($games as $game): ?>
                                <tr style="border-bottom: 1px solid #333;">
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($game['title']); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($game['genre']); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($game['release_year']); ?></td>
                                    <td style="padding: 10px; text-align: center;">
                                        <a href="edit-game.php?id=<?php echo $game['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn" style="background: #ffaa00; font-size: 0.8rem; padding: 3px 10px; margin-right: 5px; color: #000;">Upraviť</a>

                                        <a href="admin.php?action=delete&id=<?php echo $game['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn" style="background: #ff4d4d; font-size: 0.8rem; padding: 3px 10px;" onclick="return confirm('Naozaj chcete zmazať túto hru a všetky jej recenzie?');">Zmazať</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="padding: 10px; text-align: center;">Žiadne hry v databáze.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

<?php require('parts/footer.php'); ?>