        <?php require('parts/header.php'); ?>
		<main class="contact-page">
            <h1>Kontakt</h1>
            <form method="POST" action="contact.php" class="contact-form">
                <label>Meno:</label>
                <input type="text" name="name" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Správa:</label>
                <textarea name="message" required></textarea>

                <button type="submit">Odoslať</button>
            </form>
		</main>

        <?php require 'parts/footer.php' ?>
