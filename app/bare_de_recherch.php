<?php 
include "configue.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      
    <form action="" method="GET">
        <input type="text" name="q" value="<?php if(isset($_GET['q'])) ?>" placeholder="Tapez votre recherche...">
        <button type="submit">Rechercher</button>
    </form>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      
    <form action="" method="GET">
        <input type="text" name="q" value="<?php if(isset($_GET['q'])){echo $_GET['q'];} ?>" placeholder="Tapez votre recherche...">
        <button type="submit">Rechercher</button>
    </form>
    
</body>
</html>