<?php
include "configue.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the adoption record
    $sql = "DELETE FROM adopted WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute(['id' => $id]);
        header("Location: commande.php?msg=deleted");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: commande.php");
}
?>
