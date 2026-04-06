<?php
$show_confirmation = false;
$user_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = htmlspecialchars($_POST['name']);
    $user_email = htmlspecialchars($_POST['email']);
    $user_message = htmlspecialchars($_POST['message']);
    $show_confirmation = true;
}
require('parts/header.php');
?>

    <main class="contact-page">
        <div class="container">
            <h1>Kontakt</h1>

            <?php if ($show_confirmation): ?>
                <div style="background: #28a428; color: white; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                    <p>Ďakujeme, <strong><?php echo $user_name; ?></strong>! Vaša správa bola úspešne odoslaná.</p>
                </div>
            <?php endif; ?>

            <form method="POST" action="contact.php" class="contact-form">
                <div class="form-group">
                    <label>Meno:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Správa:</label>
                    <textarea name="message" class="form-control" required></textarea>
                </div>

                <button type="submit" class="tm-btn tm-btn-primary">Odoslať</button>
            </form>
        </div>
    </main>

<?php
require 'parts/footer.php';
?>