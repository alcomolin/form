<?php
try {
    /* Se crea la conexion a la base de datos */
    define('DB_TYPE', 'mysql');
    define('DB_HOST', '127.0.0.1');
    define('DB_PORT', '3306');
    define('DB_NAME', 'api_db');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_CHARSET', 'utf8mb4');
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
    $conexion = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
} catch (Exception $e) {
    print_r("catch conexion dashboard controller" . json_encode($e) . " datos de conexion: " . json_encode($conexion));
    $conexion = null;
    $options = null;
}
