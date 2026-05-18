<?php
$page_title = "Administrácia hier";
require('parts/header.php');

require_once 'classes/Game.php';
$gameManager = new Game();

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pridat_hru'])) {
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $release_year = intval($_POST['release_year']);

    if (!empty($title) && !empty($genre) && $release_year > 0) {
        $success = $gameManager->createGame($title, $genre, $release_year);
        if ($success) {
            $message = "<p style='color: #4da6ff; font-weight: bold;'>Hra bola úspešne pridaná do databázy!</p>";
        } else {
            $message = "<p style='color: #ff4d4d; font-weight: bold;'>Chyba pri ukladaní hry.</p>";
        }
    } else {
        $message = "<p style='color: #ffaa00; font-weight: bold;'>Prosím, vyplňte všetky polia správne.</p>";
    }
}
?>

    <main class="admin-page">
        <div class="container">
            <div class="content-box">
                <h2>⚙️ Administrácia - Pridať novú hru</h2>
                <p>Tento panel slúži na rozširovanie hernej knižnice.</p>

                <hr style="border: 0; border-top: 1px solid #444; margin: 20px 0;">

                <?php echo $message; ?>

                <form method="POST" action="admin.php?theme=<?php echo $theme; ?>" style="text-align: left; max-width: 500px; margin: 0 auto;">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Názov hry:</label>
                        <input type="text" name="title" class="form-control" placeholder="Napr. Grand Theft Auto VI" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">Žáner:</label>
                        <input type="text" name="genre" class="form-control" placeholder="Napr. Akčná / Otvorený svet" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 5px;">Rok vydania:</label>
                        <input type="number" name="release_year" class="form-control" min="1950" max="<?php echo date('Y') + 5; ?>" placeholder="Napr. 2025" required>
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" name="pridat_hru" class="tm-btn tm-btn-primary">Pridať hru</button>
                        <a href="index.php?theme=<?php echo $theme; ?>" class="tm-btn" style="background: #444; margin-left: 10px;">Späť na prehľad</a>
                    </div>
                </form>

            </div>
        </div>
    </main>
<?php
require('parts/footer.php');
?>