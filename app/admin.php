<?php
include "configue.php";

/* Récupération produits avec PDO */
$sql = "SELECT * FROM produits";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Product Management</title>
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="navbar.css">

</head>

<body>

<div class="container">

<h1>👑 Admin Area – Cat Management</h1>
<p class="subtitle">Manage your products easily</p>

<div class="top-actions">
    <a href="ajouter.php" class="btn-add">➕ Add a product</a>
    <a href="commande.php" class="btn-orders">📦 View orders</a>
</div>

<div class="table-responsive">
<table>
<thead>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Image</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

<?php foreach($result as $row): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['prix'] ?> DH</td>
    <td>
        <img src="image/<?= $row['image'] ?>" width="80" height="80">
    </td>

    <td class="actions">
        <a href="modifier.php?id=<?= $row['id'] ?>">✏ Edit</a>
        <span class="separator">|</span>
        <a href="supprimer.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Do you really want to delete this product?')">
           🗑 Delete
        </a>
    </td>
</tr>

<?php endforeach; ?>

</tbody>
</table>
</div>

</div>

<br>

<div class="logout-container">
    <a href="home.php" class="btn-logout">
        🚪 Log out
    </a>
</div>

</body>
</html>
