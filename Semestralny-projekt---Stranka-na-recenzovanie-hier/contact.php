<?php
$page_title = "Napíšte nám";
require('parts/header.php');
?>
    <main class="contact-page">
        <div class="container">
            <div class="content-box">
                <h2>Neváhajte</h2>
                <p>Máte otázky? Použite náš formulár nižšie.</p>

                <h1 style="margin-top: 30px;">Kontakt</h1>

                <form method="POST" action="contact.php" class="contact-form" style="text-align: left;">
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
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" class="tm-btn tm-btn-primary">Odoslať</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php
require 'parts/footer.php';
?>