<?php
$page_title = "O projekte";
require('parts/header.php');
?>

    <main class="about-page">
        <div class="container">
            <div class="content-box" style="text-align: left;">
                <h2>ℹ️ O projekte GamerZone</h2>
                <p>Tento web vznikol ako semestrálna práca pre predmet <strong>Skriptovacie jazyky</strong>.</p>

                <h3 style="margin-top: 30px; color: #4da6ff;">🎯 Ciele projektu</h3>
                <p>Hlavným cieľom bolo vytvoriť plne dynamický portál s hernými recenziami postavený na moderných štandardoch backend vývoja bez použitia hotových frameworkov alebo CMS systémov.</p>

                <h3 style="margin-top: 30px; color: #4da6ff;">💻 Použité technológie</h3>
                <ul style="line-height: 1.8; padding-left: 20px;">
                    <li><strong>Backend:</strong> PHP 8.x (plné využitie OOP architektúry, dedičnosti a zapuzdrenia)</li>
                    <li><strong>Databáza:</strong> MySQL / MariaDB (spracovanie cez PDO vrstvu, pripravené príkazy)</li>
                    <li><strong>Zabezpečenie:</strong> Ochrana proti XSS (HTML escaping) a SQL Injection (Prepared Statements)</li>
                    <li><strong>Frontend:</strong> Čisté HTML5, CSS3 s podporou dynamického prepínania dizajnových tém cez <code>$_GET</code></li>
                </ul>

                <h3 style="margin-top: 30px; color: #4da6ff;">👤 Autor projektu</h3>
                <p>Študent kurzu Skriptovacie jazyky. Zdrojový kód je spravovaný a priebežne verziovaný pomocou systému Git a verejne dostupný v repozitári.</p>

                <div style="text-align: center; margin-top: 40px;">
                    <a href="index.php?theme=<?php echo $theme; ?>" class="tm-btn tm-btn-primary">Prejsť na prehľad hier</a>
                </div>
            </div>
        </div>
    </main>

<?php require('parts/footer.php'); ?>