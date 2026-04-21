
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Gamerzone</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
</head>
<body>

<?php
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'dark';
$body_class = ($theme === 'light') ? 'light-mode' : 'dark-mode';
?>

<header class="tm-header" style="background-color: <?php echo $theme === 'dark' ? 'rgba(17,17,17,0.95)' : 'rgba(240,240,240,0.95)'; ?>">
    <div class="header-container">
        <div class="logo">
            <a href="index.php?theme=<?php echo $theme; ?>" style="color: <?php echo $theme === 'dark' ? '#4da6ff' : '#0056b3'; ?> !important;">
                GAMER<span>ZONE</span>
            </a>
        </div>

        <nav class="hero-nav">
            <ul class="hero-nav-ul">
                <li><a href="index.php?theme=<?php echo $theme; ?>">Domov</a></li>
                <li><a href="about.php?theme=<?php echo $theme; ?>">O nás</a></li>
                <li><a href="contact.php?theme=<?php echo $theme; ?>">Kontakt</a></li>

                <li>
                    <a href="?theme=<?php echo $theme === 'dark' ? 'light' : 'dark'; ?>" class="tm-btn-theme">
                        <?php echo $theme === 'dark' ? '☀️ Svetlý mód' : '🌙 Tmavý mód'; ?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div class="hero-section">
    <div class="hero-content">
        <h1><?php echo isset($page_title) ? $page_title : 'GamerZone'; ?></h1>
    </div>
</div>