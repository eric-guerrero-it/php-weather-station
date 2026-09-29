<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>🌤️ Estació Meteorològica</title>
    <link rel="stylesheet" href="estils/style.css">
</head>
<body>

<!-- BANNER INSTITUT -->
<header class="banner-institut">
    <div class="banner-overlay">
        <div class="banner-text">
            <h2>Institut Sa Palomera</h2>
            <p>Projecte RA5/RA6 · Estació Meteorològica Arduino</p>
        </div>
    </div>
</header>

<?php require_once "menu.php"; ?>

<h1 class="titol">🌤️ Estació Meteorològica Arduino</h1>

<section>
    <h2>👋 Benvingut</h2>
    <p>
        Aquesta aplicació web mostra les dades enregistrades per la nostra estació meteorològica Arduino.
        Podràs consultar la <strong>temperatura</strong> 🌡️, <strong>humitat</strong> 💧, 
        <strong>pressió atmosfèrica</strong> ⛰️, <strong>velocitat del vent</strong> 💨 i la 
        <strong>posició UTM</strong> 📍.
    </p>

    <p>
        També trobaràs estadístiques completes del dia actual, del mes en curs i informació detallada dels components.
    </p>

    <p>Utilitza el menú superior per navegar entre les diferents seccions del projecte.</p>
</section>

<?php require_once "footer.php"; ?>

</body>
</html>
