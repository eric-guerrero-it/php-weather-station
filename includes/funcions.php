<?php
// ============================================================
//   CONNEXIÓ PDO — Base de dades METEO
// ============================================================

$host = "localhost";
$db   = "meteo";
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Error de connexió: " . $e->getMessage());
}


// ============================================================
//   FUNCIÓ: obtenirPosicio() — Llegeix de la taula POSICIO
// ============================================================

function obtenirPosicio() {
    global $pdo;

    $sql = "SELECT utmx, utmy 
            FROM posicio 
            WHERE actual = 1
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    $resultat = $stmt->fetch();

    // Si no hi ha posició → retorna valors buits (no errors)
    return $resultat ?: ["utmx" => "—", "utmy" => "—"];
}


// ============================================================
//   FUNCIÓ: obtenirDarrera($columna)
// ============================================================

function obtenirDarrera($columna) {
    global $pdo;

    $columnesValides = ["temperatura", "humitat", "pressio", "vent"];
    if (!in_array($columna, $columnesValides)) {
        return null;
    }

    $sql = "SELECT $columna, data_hora
            FROM registre
            ORDER BY data_hora DESC
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch();
}


// ============================================================
//   FUNCIÓ: temperaturesDia()
// ============================================================

function temperaturesDia() {
    global $pdo;

    $sql = "SELECT MAX(temperatura) AS max, MIN(temperatura) AS min
            FROM registre
            WHERE DATE(data_hora) = CURDATE()";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch();
}


// ============================================================
//   FUNCIÓ: humitatMitjanaDia()
// ============================================================

function humitatMitjanaDia() {
    global $pdo;

    $sql = "SELECT AVG(humitat) AS mitjana
            FROM registre
            WHERE DATE(data_hora) = CURDATE()";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch();
}


// ============================================================
//   FUNCIÓ: ventMitjaDia()
// ============================================================

function ventMitjaDia() {
    global $pdo;

    $sql = "SELECT AVG(vent) AS mitjana
            FROM registre
            WHERE DATE(data_hora) = CURDATE()";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch();
}


// ============================================================
//   FUNCIÓ: temperaturesMes()
// ============================================================

function temperaturesMes() {
    global $pdo;

    $sql = "SELECT MAX(temperatura) AS max, MIN(temperatura) AS min
            FROM registre
            WHERE MONTH(data_hora) = MONTH(CURDATE())
              AND YEAR(data_hora) = YEAR(CURDATE())";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch();
}
?>
