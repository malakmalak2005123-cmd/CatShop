<?php
include "configue.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Confirmer = Juste changer le statut, NE PAS SUPPLIMER
    $sql = "UPDATE adopted SET status = 'Confirme' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute([$id])){
        header("Location: commande.php?msg=confirmed_status");
    } else {
        header("Location: commande.php?msg=error");
    }
} else {
    header("Location: commande.php");
}
?>
