<?php
include "configue.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Annuler la réservation = Revenir au statut "En attente"
    // Cela rendra le produit visible à nouveau sur home.php (car le filtre exclut seulement 'Confirme')
    $sql = "UPDATE adopted SET status = 'En attente' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute([$id])){
        header("Location: commande.php?msg=cancelled");
    } else {
        header("Location: commande.php?msg=error");
    }
} else {
    header("Location: commande.php");
}
?>
