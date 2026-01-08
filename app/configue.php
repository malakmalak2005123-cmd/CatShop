<?php
phpinfo();
// Use Railway environment variables
$host =$ip = getenv('MYSQLHOST', true) ?: getenv('MYSQLHOST');
$port = getenv('MYSQLPORT', true) ?: getenv('MYSQLPORT');       // port number
$db   = getenv('MYSQL_DATABASE', true) ?: getenv('MYSQL_DATABASE');   // database name
$user = getenv('MYSQLUSER', true) ?: getenv('MYSQLUSER');       // username
$pass = getenv('MYSQLPASSWORD', true) ?: getenv('MYSQLPASSWORD');   // password

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
