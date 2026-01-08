<?php
// Use Railway environment variables
$host = $_ENV['MYSQLHOST'];       // hostname from Railway
$port = $_ENV['MYSQLPORT'];       // port number
$db   = $_ENV['MYSQLDATABASE'];   // database name
$user = $_ENV['MYSQLUSER'];       // username
$pass = $_ENV['MYSQLPASSWORD'];   // password

echo 'host: '.$host;
echo 'port: '.$port;
echo 'db: '.$db;
echo 'user: '.$user;
echo 'pass: '.$pass;

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
