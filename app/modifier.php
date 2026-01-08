<?php
include "configue.php"; // $pdo défini ici

// 1) Récupérer l'ID depuis l'URL
$id = $_GET['id'];

// 2) Récupérer les infos actuelles du produit
$sql = "SELECT * FROM produits WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();

if (!$row) {
    die("Produit introuvable !");
}

// 3) Si le formulaire est soumis → UPDATE
if ($_POST) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $prix = $_POST['prix'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $image = $_POST['image'];
    $description_courte = $_POST['description_courte'];
    $caracteristiques = $_POST['caracteristiques'];

    $update = "UPDATE produits 
               SET name = :name,
                   Type = :type,
                   prix = :prix,
                   age = :age,
                   sexe = :sex,
                   image = :image,
                   description_courte = :description_courte,
                   caracteristiques = :caracteristiques
               WHERE id = :id";

    $stmt = $pdo->prepare($update);
    $stmt->execute([
        'name' => $name,
        'type' => $type,
        'prix' => $prix,
        'age' => $age,
        'sex' => $sex,
        'image' => $image,
        'description_courte' => $description_courte,
        'caracteristiques' => $caracteristiques,
        'id' => $id
    ]);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Produit</title>
    <style>
        /* --- Reset basique --- */
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #d0e6f7, #ffffff);
            padding: 50px 20px;
        }

        h2 {
            text-align: center;
            background: linear-gradient(90deg, #6fb1fc, #84abe2ff);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 28px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2b3a67;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 12px;
            border: 2px solid #cde4ff;
            font-size: 15px;
            background: #f0f7ff;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3a8dff;
            box-shadow: 0 0 10px rgba(58, 141, 255, 0.3);
            background: #ffffff;
        }

        textarea { resize: vertical; min-height: 100px; }

        button {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(90deg, #6fb1fc, #3a8dff);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(58, 141, 255, 0.3);
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(58, 141, 255, 0.4);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 0 6px 12px rgba(58, 141, 255, 0.3);
        }

        /* Responsive */
        @media (max-width: 650px) {
            form { padding: 30px 20px; }
            h2 { font-size: 24px; }
        }

    </style>
</head>
<body>

<h2>✏ Modifier le produit</h2>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">

    <label>Type :</label>
    <input type="text" name="type" value="<?php echo htmlspecialchars($row['Type']); ?>">

    <label>Prix :</label>
    <input type="text" name="prix" value="<?php echo htmlspecialchars($row['prix']); ?>">

    <label>Âge :</label>
    <input type="text" name="age" value="<?php echo htmlspecialchars($row['age']); ?>">

    <label>Sexe :</label>
    <select name="sex">
        <option value="Male"   <?php if($row['sexe']=='Male') echo "selected"; ?>>Male</option>
        <option value="Female" <?php if($row['sexe']=='Female') echo "selected"; ?>>Female</option>
    </select>

    <label>Image (nom fichier) :</label>
    <input type="text" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">

    <label>Description courte :</label>
    <textarea name="description_courte"><?php echo htmlspecialchars($row['description_courte']); ?></textarea>

    <label>Caractéristiques :</label>
    <textarea name="caracteristiques"><?php echo htmlspecialchars($row['caracteristiques']); ?></textarea>

    <button type="submit">Modifier</button>

</form>

</body>
</html>
