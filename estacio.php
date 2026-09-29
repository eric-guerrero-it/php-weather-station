<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>🌦️ Informació de l'Estació</title>
    <link rel="stylesheet" href="estils/style.css">
</head>
<body>

<?php require_once "menu.php"; ?>
<?php require_once "includes/funcions.php"; ?>

<h1 class="titol">🌦️ Informació de l'Estació Meteorològica</h1>

<section>
    <h2>ℹ️ Descripció del projecte</h2>
    <p>
        Aquesta estació meteorològica mesura en temps real:
        <br>🌡️ Temperatura
        <br>💧 Humitat
        <br>⛰️ Pressió atmosfèrica
        <br>💨 Velocitat del vent
        <br><br>
        Les dades s'enregistren automàticament a la base de dades <strong>meteo</strong>
        i posteriorment es mostren en aquest panell web desenvolupat en PHP.
    </p>
</section>

<section>
    <h2>📍 Localització de l’estació</h2>

    <?php $pos = obtenirPosicio(); ?>

    <p><strong>UTMx:</strong> <?= $pos['utmx'] ?></p>
    <p><strong>UTMy:</strong> <?= $pos['utmy'] ?></p>

    <p>Les coordenades estan expressades en sistema UTM (Universal Transversal de Mercator).</p>
</section>

<section>
    <h2>🔧 Components utilitzats</h2>
    <ul>
        <li>🔌 Arduino UNO / ESP32</li>
        <li>🌡️ Sensor DHT22 (temperatura i humitat)</li>
        <li>⛰️ Sensor BME280 / BMP280 (pressió atmosfèrica)</li>
        <li>💨 Anemòmetre (velocitat del vent)</li>
        <li>💾 Connexió sèrie o mòdul SD</li>
    </ul>
</section>

<section>
    <h2>🖼️ Imatges del projecte</h2>

    <div class="galeria">
        <figure>
            <img src="imatges/arduino.jpg" alt="Arduino">
            <figcaption>Arduino / ESP32</figcaption>
        </figure>

        <figure>
            <img src="imatges/sensors.jpg" alt="Sensors">
            <figcaption>Sensors</figcaption>
        </figure>

        <figure>
            <img src="imatges/estacio.jpg" alt="Estació meteorològica">
            <figcaption>Estació muntada</figcaption>
        </figure>
    </div>
</section>

<?php require_once "footer.php"; ?>

</body>
</html>
