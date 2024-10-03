<?php
// db.php
$host = getenv('MYSQLHOST');  // Your Railway-provided host
$db   = getenv('MYSQLDATABASE');  // Your database name
$user = getenv('MYSQLUSER');  // Your username
$pass = getenv('MYSQLPASSWORD');  // Your password
$charset = 'utf8mb4';

//mysql://root:gaqeYowLuDXHMzPZmSEaLCedUhAwlXSV@junction.proxy.rlwy.net:11128/railway

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
     throw new PDOException($e->getMessage(), (int)$e->getCode());
}
