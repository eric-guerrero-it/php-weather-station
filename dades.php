<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>🌡️ Dades Meteorològiques</title>
    <link rel="stylesheet" href="estils/style.css">
</head>
<body>

<?php require_once "menu.php"; ?>
<?php require_once "includes/funcions.php"; ?>

<h1 class="titol">🌡️ Dades Meteorològiques</h1>

<!-- POSICIÓ UTM -->
<section>
    <h2>📍 Posició UTM de l'estació</h2>

    <?php $pos = obtenirPosicio(); ?>

    <p><strong>UTMx:</strong> <?= $pos['utmx'] ?></p>
    <p><strong>UTMy:</strong> <?= $pos['utmy'] ?></p>

    <p>Coordenades expressades en sistema UTM (Universal Transversal de Mercator).</p>
</section>


<!-- DARRERES MESURES -->
<section>
    <h2>⏱️ Darreres mesures registrades</h2>

    <form method="POST">
        <button type="submit" name="accio" value="temp">🌡️ Darrera Temperatura</button>
        <button type="submit" name="accio" value="humitat">💧 Darrera Humitat</button>
        <button type="submit" name="accio" value="pressio">⛰️ Darrera Pressió</button>
        <button type="submit" name="accio" value="vent">💨 Darrera Velocitat del Vent</button>
    </form>

    <div class="info">
    <?php
        if (isset($_POST['accio'])) {

            if ($_POST['accio'] == "temp") {
                $d = obtenirDarrera("temperatura");
                echo "<strong>🌡️ Temperatura:</strong> {$d['temperatura']} °C<br>";
                echo "<strong>📅 Data:</strong> {$d['data_hora']}";
            }

            if ($_POST['accio'] == "humitat") {
                $d = obtenirDarrera("humitat");
                echo "<strong>💧 Humitat:</strong> {$d['humitat']} % HR<br>";
                echo "<strong>📅 Data:</strong> {$d['data_hora']}";
            }

            if ($_POST['accio'] == "pressio") {
                $d = obtenirDarrera("pressio");
                echo "<strong>⛰️ Pressió:</strong> {$d['pressio']} hPa<br>";
                echo "<strong>📅 Data:</strong> {$d['data_hora']}";
            }

            if ($_POST['accio'] == "vent") {
                $d = obtenirDarrera("vent");
                echo "<strong>💨 Velocitat:</strong> {$d['vent']} km/h<br>";
                echo "<strong>📅 Data:</strong> {$d['data_hora']}";
            }
        }
    ?>
    </div>
</section>


<!-- INFORMACIÓ EXTRA -->
<section>
    <h2>ℹ️ Informació addicional del dia</h2>

    <?php
    $total = $pdo->query("SELECT COUNT(*) AS total FROM registre WHERE DATE(data_hora) = CURDATE()")->fetch()['total'];
    $ultima = obtenirDarrera("temperatura")['data_hora'];

    $tempsDia = temperaturesDia();
    $difTemp = $tempsDia['max'] - $tempsDia['min'];

    $humExtra = $pdo->query("SELECT MAX(humitat) AS hum_max, MIN(humitat) AS hum_min 
                              FROM registre WHERE DATE(data_hora) = CURDATE()")->fetch();

    $ventExtra = $pdo->query("SELECT MAX(vent) AS vent_max 
                              FROM registre WHERE DATE(data_hora) = CURDATE()")->fetch();

    if ($humExtra['hum_max'] > 70)       { $estat = "Humit"; $emoji = "💧"; }
    elseif ($ventExtra['vent_max'] > 25) { $estat = "Ventós"; $emoji = "💨"; }
    elseif ($difTemp > 10)               { $estat = "Variable"; $emoji = "🌤️"; }
    else                                 { $estat = "Estable"; $emoji = "✔️"; }
    ?>

    <p><strong>📊 Total de registres d'avui:</strong> <?= $total ?></p>
    <p><strong>🕒 Última actualització:</strong> <?= $ultima ?></p>
    <p><strong>🌡️ Diferència màx - mín:</strong> <?= $difTemp ?> °C</p>
    <p><strong>💧 Humitat màxima:</strong> <?= $humExtra['hum_max'] ?> %</p>
    <p><strong>💧 Humitat mínima:</strong> <?= $humExtra['hum_min'] ?> %</p>
    <p><strong>💨 Vent màxim:</strong> <?= $ventExtra['vent_max'] ?> km/h</p>
    <p><strong>📌 Estat del dia:</strong> <?= $emoji ?> <?= $estat ?></p>
</section>


<!-- CARDS -->
<section>
    <h2>📊 Resum meteorològic del dia</h2>

    <?php 
    $humDia = humitatMitjanaDia();
    $humMitjana = round($humDia['mitjana'], 1);
    $ventDia = ventMitjaDia();
    $ventMitjana = round($ventDia['mitjana'], 1);
    $tempsMes = temperaturesMes();
    ?>

    <div class="cards-grid">

        <article class="card">
            <div class="card-title">🌡️ Temperatura màxima (avui)</div>
            <div class="card-value"><?= $tempsDia['max'] ?> °C</div>
            <div class="card-extra">Mínima: <?= $tempsDia['min'] ?> °C</div>
        </article>

        <article class="card">
            <div class="card-title">💧 Humitat mitjana (avui)</div>
            <div class="card-value"><?= $humMitjana ?> %</div>
        </article>

        <article class="card">
            <div class="card-title">💨 Vent mitjà (avui)</div>
            <div class="card-value"><?= $ventMitjana ?> km/h</div>
        </article>

        <article class="card">
            <div class="card-title">📅 Temperatura del mes</div>
            <div class="card-value"><?= $tempsMes['max'] ?> °C</div>
            <div class="card-extra">Mínima: <?= $tempsMes['min'] ?> °C</div>
        </article>

    </div>
</section>

<?php require_once "footer.php"; ?>

</body>
</html>
