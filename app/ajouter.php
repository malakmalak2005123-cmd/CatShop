<?php 
include "configue.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =======================
    // UPLOAD IMAGE
    // =======================
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $targetDir = "image/";
        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        
        if ($check !== false) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            $image = $fileName;
        }
    }

    // =======================
    // DATA
    // =======================
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $description_courte = $_POST['description_courte'];
    $caracteristiques = $_POST['caracteristiques'];
    $prix = $_POST['prix'];
    $type = $_POST['type'];

    // =======================
    // INSERT PDO
    // =======================
    $sql = "INSERT INTO produits 
        (name, image, age, sexe, description_courte, caracteristiques, prix, type)
        VALUES 
        (:name, :image, :age, :sex, :description_courte, :caracteristiques, :prix, :type)
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":name" => $name,
        ":image" => $image,
        ":age" => $age,
        ":sex" => $sex,
        ":description_courte" => $description_courte,
        ":caracteristiques" => $caracteristiques,
        ":prix" => $prix,
        ":type" => $type
    ]);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Produit</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#5f6f9cff,#b2ebf2);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.container{
    background:white;
    padding:40px;
    max-width:600px;
    width:100%;
    border-radius:20px;
    box-shadow:0 20px 60px rgba(0,0,0,0.3);
}
h2{
    text-align:center;
    margin-bottom:25px;
    color:#667eea;
}
form{
    display:flex;
    flex-direction:column;
    gap:15px;
}
label{
    font-weight:600;
}
input,select,textarea{
    width:100%;
    padding:10px;
    border-radius:8px;
    border:2px solid #ddd;
}
textarea{
    resize:vertical;
}
.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}
button{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:#fff;
    border:none;
    padding:14px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}
button:hover{
    opacity:0.9;
}
@media (max-width:600px){
    .form-row{
        grid-template-columns:1fr;
    }
}
</style>
</head>
<body>

<div class="container">
    <h2>➕ Ajouter un produit</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Nom</label>
        <input type="text" name="name" required>

        <div class="form-row">
            <div>
                <label>Type</label>
                <input type="text" name="type" required>
            </div>
            <div>
                <label>Prix</label>
                <input type="text" name="prix" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label>Âge</label>
                <input type="text" name="age" required>
            </div>
            <div>
                <label>Sexe</label>
                <select name="sex" required>
                    <option value="">Choisir</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        <label>Image</label>
        <input type="file" name="image" accept="image/*">

        <label>Description courte</label>
        <textarea name="description_courte" required></textarea>

        <label>Caractéristiques</label>
        <textarea name="caracteristiques" required></textarea>

        <button type="submit">Ajouter</button>

    </form>
</div>


</body>
</html>
