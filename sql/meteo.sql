-- -----------------------------------------------------
-- PROJECTE RA5/RA6 - ESTACIÓ METEOROLÒGICA
-- Base de dades: meteo
-- -----------------------------------------------------

-- 1. Crear BDD si no existeix
CREATE DATABASE IF NOT EXISTS meteo
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE meteo;

-- 2. Eliminar taules si existeixen (ordre correcte)
DROP TABLE IF EXISTS registre;
DROP TABLE IF EXISTS posicio;

-- 3. Crear taula POSICIO (primer)
CREATE TABLE posicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utmx VARCHAR(20) NOT NULL,
    utmy VARCHAR(20) NOT NULL,
    actual BOOLEAN DEFAULT 1
);

-- 4. Inserir posició de l'estació (una sola fila)
INSERT INTO posicio (utmx, utmy, actual)
VALUES ('432100', '4689100', 1);

-- 5. Crear taula REGISTRE (després)
CREATE TABLE registre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_hora DATETIME NOT NULL,
    temperatura FLOAT,
    humitat FLOAT,
    pressio FLOAT,
    vent FLOAT,
    posicio_id INT,
    FOREIGN KEY (posicio_id) REFERENCES posicio(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

-- 6. Inserir registres de prova
INSERT INTO registre (data_hora, temperatura, humitat, pressio, vent, posicio_id)
VALUES
('2025-01-01 10:00:00', 21.5, 55, 1012, 5.2, 1),
('2025-01-01 14:32:00', 22.1, 53, 1011, 7.1, 1),
('2025-01-02 09:15:00', 25.5, 60, 1015, 4.9, 1),
('2025-01-02 16:20:00', 19.8, 58, 1013, 3.1, 1),
('2025-01-03 18:00:00', 18.9, 70, 1009, 2.8, 1),
(NOW(), 22.5, 57, 1012, 3.9, 1),
(NOW(), 20.8, 61, 1014, 5.1, 1);
