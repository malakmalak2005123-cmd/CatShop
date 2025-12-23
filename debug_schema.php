<?php
include "configue.php";
$table = 'adopted';
$stmt = $pdo->prepare("SHOW INDEX FROM $table");
$stmt->execute();
$indexes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($indexes);
echo "</pre>";
?>
