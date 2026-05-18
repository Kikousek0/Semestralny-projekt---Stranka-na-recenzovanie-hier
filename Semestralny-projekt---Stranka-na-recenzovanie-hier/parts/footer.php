<footer class="tm-footer" style="background-color: <?php echo isset($theme) && $theme === 'light' ? '#e0e0e0' : '#111'; ?>; color: <?php echo isset($theme) && $theme === 'light' ? '#333' : '#aaa'; ?>;">
    <div class="container footer-container">
        <div class="footer-info">
            <h3>GAMER<span>ZONE</span></h3>
            <p>Projekt pre predmet Skriptovacie jazyky.</p>
        </div>

        <div class="footer-links">
            <h4>Rýchle odkazy</h4>
            <ul>
                <li><a href="index.php?theme=<?php echo $theme ?? 'dark'; ?>">Prehľad hier</a></li>
                <li><a href="admin.php?theme=<?php echo $theme ?? 'dark'; ?>">Administrácia</a></li>
                <li><a href="contact.php?theme=<?php echo $theme ?? 'dark'; ?>">Kontakt</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom" style="border-top: 1px solid <?php echo isset($theme) && $theme === 'light' ? '#ccc' : '#222'; ?>;">
        <p>&copy; <?php echo date('Y'); ?> GamerZone. Všetky práva vyhradené. Vyrobené v čistom PHP (OOP).</p>
    </div>
</footer>

</body>
</html>