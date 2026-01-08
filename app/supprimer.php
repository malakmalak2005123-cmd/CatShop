<?php
include "configue.php"; // $pdo défini ici

$id = $_GET['id'];

// Prepared statement pour sécuriser la suppression
$sql = "DELETE FROM produits WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: admin.php");
exit();
?>
