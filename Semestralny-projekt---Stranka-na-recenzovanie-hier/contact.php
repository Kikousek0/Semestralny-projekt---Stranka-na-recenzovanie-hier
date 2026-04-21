<?php
$page_title = "Napíšte nám";
require('parts/header.php');
?>
    <main class="contact-page">
        <div class="container">
            <div class="content-box">
                <h3>Napíšte nám</h3>
                <form id="contact" method="post" action="db/spracovanieFormulara.php">

                    <div class="form-group">
                        <input type="text" name="meno" id="meno" placeholder="Vaše meno" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Váš email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <textarea name="sprava" id="sprava" placeholder="Vaša správa" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group" style="text-align: left;">
                        <input type="checkbox" name="suhlas" id="suhlas" required>
                        <label for="suhlas"> Súhlasím so spracovaním osobných údajov.</label>
                    </div>

                    <input type="submit" name="odoslat" value="Odoslať" class="tm-btn tm-btn-primary">
                </form>
            </div>
        </div>
    </main>

<?php
require 'parts/footer.php';
?>