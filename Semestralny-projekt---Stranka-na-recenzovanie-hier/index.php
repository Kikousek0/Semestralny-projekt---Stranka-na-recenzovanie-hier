<?php
$page_title = "Prehľad hier";
require('parts/header.php');

require_once 'classes/Game.php';
$gameManager = new Game();

$games = $gameManager->getAllGames();
if (empty($games)) {
    $gameManager->createGame("The Witcher 3: Wild Hunt", "RPG", 2015);
    $gameManager->createGame("Counter-Strike 2", "FPS", 2023);
    $gameManager->createGame("Cyberpunk 2077", "RPG", 2020);
    $games = $gameManager->getAllGames();
}
?>

    <main class="home-page">
        <div class="container">
            <div class="content-box">
                <h2>Zoznam herných titulov</h2>
                <p>Kliknutím na hru si môžete prečítať recenzie alebo pridať svoje vlastné hodnotenie.</p>

                <hr style="border: 0; border-top: 1px solid #444; margin: 20px 0;">

                <div class="games-list" style="text-align: left;">
                    <?php if (!empty($games)): ?>
                        <?php foreach ($games as $game): ?>
                            <div class="game-item" style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #4da6ff;">
                                <h3 style="margin-bottom: 5px; color: #fff;"><?php echo htmlspecialchars($game['title']); ?></h3>
                                <p style="margin: 0; font-size: 0.9rem; color: #aaa;">
                                    <span>🎮 Žáner: <strong><?php echo htmlspecialchars($game['genre']); ?></strong></span> |
                                    <span>📅 Rok vydania: <strong><?php echo htmlspecialchars($game['release_year']); ?></strong></span>
                                </p>

                                <div style="margin-top: 15px;">
                                    <a href="game-detail.php?id=<?php echo $game['id']; ?>&theme=<?php echo $theme; ?>" class="tm-btn tm-btn-primary" style="font-size: 0.8rem; padding: 5px 15px;">Zobraziť recenzie</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>V databáze sa nenachádzajú žiadne hry.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </main>
<?php
require('parts/footer.php');
?>