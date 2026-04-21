
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

<header class="tm-header">
    <div class="header-container">
        <div class="logo">
            <a href="index.php">GAMER<span>ZONE</span></a>
        </div>
        <nav class="hero-nav">
            <ul class="hero-nav-ul">
                <li><a href="index.php">Domov</a></li>
                <li><a href="about.php">O nás</a></li>
                <li><a href="contact.php">Kontakt</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="hero-section">
    <div class="hero-content">
        <h1><?php echo isset($page_title) ? $page_title : 'GamerZone'; ?></h1>
    </div>
</div>