<?php require('parts/header.php'); ?>

    <main class="contact-page">
        <div class="container">
            <h1>Kontakt</h1>

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