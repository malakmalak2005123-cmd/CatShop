<?php
include "configue.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Livré = Supprimer le produit (ce qui le retirera de home.php)
    $sql = "DELETE FROM produits WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute([$id])){
        header("Location: commande.php?msg=delivered");
    } else {
        header("Location: commande.php?msg=error");
    }
} else {
    header("Location: commande.php");
}
?>
