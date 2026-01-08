<?php
session_start();



// Gestion de l'ajout au panier
if (isset($_POST['addCart'])) {
    $id = $_POST['id'];
    $exists = false;
    
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            if ($item['id'] == $id) {
                $exists = true;
                break;
            }
        }
    }

    if (!$exists) {
        $_SESSION['cart'][] = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'prix' => (float) $_POST['prix'],
            'image' => $_POST['image']
        ];
    }
}

// Gestion de la suppression d'un article du panier
if (isset($_GET['remove'])) {
    $index = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Réindexer le tableau
    }
    // Rediriger pour éviter la resoumission
    header("Location: ?openCart=1");
    exit();
}

include "configue.php"; // Assurez-vous que configue.php contient la connexion PDO

try {
    // Select all products and check if they are confirmed
    // We use a subquery or LEFT JOIN to check status
    $sql = "
    SELECT p.*, 
           (SELECT status FROM adopted WHERE cat_id = p.id AND status = 'Confirme' LIMIT 1) as adoption_status
    FROM produits p
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
    exit();
}
?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Our Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="home.css">
</head>
<body>

<!-- Icône panier flottante -->
<div class="cart-icon-container">
    <button class="cart-icon-btn" onclick="toggleCart()">
        <i class="fas fa-shopping-cart"></i>
        <?php if (!empty($_SESSION['cart'])) { ?>
            <span class="cart-badge"><?php echo count($_SESSION['cart']); ?></span>
        <?php } ?>
    </button>
</div>

<!-- Overlay -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>

<!-- Cart Sidebar -->
<div class="cart-sidebar" id="cartSidebar">
    <!-- En-tête -->
    <div class="cart-header">
        <h3>
            <i class="fas fa-shopping-bag"></i>
            My Cart
        </h3>
        <button class="close-cart-btn" onclick="toggleCart()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Corps -->
    <div class="cart-body">
        <?php if (empty($_SESSION['cart'])) { ?>
            <div class="cart-empty">
                <i class="fas fa-shopping-cart"></i>
                <p>Your cart is empty</p>
            </div>
        <?php } else { ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $index => $item) { ?>
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="image/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </div>
                        <div class="cart-item-details">
                            <div class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                            <div class="cart-item-price"><?php echo htmlspecialchars($item['prix']); ?> DH</div>
                        </div>
                        <button class="remove-btn" onclick="removeItem(<?php echo $index; ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <!-- Pied -->
    <?php if (!empty($_SESSION['cart'])) { ?>
        <div class="cart-footer">
            <button class="confirm-btn" onclick="window.location.href='adopter.php'">
                <i class="fas fa-check-circle"></i>
                Confirm Adoption
            </button>
        </div>
    <?php } ?>
</div>

<!-- Section Adoption en haut -->
<div class="adoption-container">
    <!-- Section gauche - Image -->
    <div class="image-section">
        <div class="image-frame">
            <img src="image/first.jpg" alt="Pet to adopt" class="pet-main-image active">
            <img src="image/image1.png" alt="Pet to adopt" class="pet-main-image">
            <img src="image/image3.png" alt="Pet to adopt" class="pet-main-image">
            
            <!-- Décorations coeurs -->
            <div class="heart-decoration heart-1">❤️</div>
            <div class="heart-decoration heart-2">❤️</div>
            <div class="heart-decoration heart-3">❤️</div>
        </div>
    </div>

    <!-- Section droite - Contenu -->
    <div class="content-section">
        <!-- Logo -->
        <div class="logo-badge">
            🐾 
        </div>

        <!-- En-tête -->
        <p class="header-text">Be a friend to an animal</p>
        <h1 class="main-title">Adopt a Pet</h1>
        
        <p class="description-text">
            Give a loving home to an animal and make a new four-legged friend today! Every adoption changes a life and brings happiness.
        </p>

        <!-- Bouton d'adoption -->
        <a href="#products" class="adoption-button">Adopt your companion</a>
    </div>
</div>

<!-- Section Produits -->
<div id="products">
    <div class="section-header">
        <h1>Our Friends for Adoption</h1>
        <p>Find the perfect companion for you</p>
    </div>

    <div class="cards-container">
        <?php if (count($result) > 0) { ?>
            <?php foreach ($result as $row): 
          $isConfirmed = ($row['adoption_status'] === 'Confirme');
          $cardClass = $isConfirmed ? 'card grayscale' : 'card';
      ?>
      <article class="<?= $cardClass ?>">
        <div class="card-image">
          <img src="image/<?php echo htmlspecialchars($row['image']); ?>" alt="Photo of <?php echo htmlspecialchars($row['name']); ?>" loading="lazy" />
        </div>
        <div class="card-body">
          <h3><?php echo htmlspecialchars($row['name']); ?></h3>
          <p class="card-type"><?php echo htmlspecialchars($row['Type']); ?></p>
          <p class="card-price"><?php echo htmlspecialchars($row['prix']); ?></p>
          
          <div class="card-button">
            <!-- Formulaire pour ajouter au panier -->
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                <input type="hidden" name="prix" value="<?php echo htmlspecialchars($row['prix']); ?>">
                <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                <?php if($isConfirmed): ?>
                    <button type="button" disabled style="background:#999;">Already Reserved</button>
                <?php else: ?>
                    <button type="submit" name="addCart">
                    <i class="fas fa-shopping-cart"></i> Cart
                    </button>
                <?php endif; ?>
            </form>

            <!-- Lien pour voir les détails -->
            <?php if($isConfirmed): ?>
                 <a href="#" style="pointer-events:none;">
                    <button type="button" disabled style="background:#999;">Unavailable</button>
                 </a>
            <?php else: ?>
                <a href="details.php?id=<?php echo $row['id']; ?>">
                <button type="button">Details</button>
                </a>
            <?php endif; ?>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
        <?php } else { ?>
            <p style="text-align:center; width:100%;">No companions available at the moment.</p>
        <?php } ?>
    </div>
</div>

<div class="footer">
    <p>&copy; 2025 CatShop. All rights reserved.</p>
</div>

<script>
    // Simple Image Slider
    // slider.js
const images = document.querySelectorAll('.pet-main-image');
let currentImageIndex = 0;

function changeImage() {
    images[currentImageIndex].classList.remove('active');
    currentImageIndex = (currentImageIndex + 1) % images.length;
    images[currentImageIndex].classList.add('active');
}

setInterval(changeImage, 3000);

    

    // Toggle Cart
    function toggleCart() {
        const sidebar = document.getElementById('cartSidebar');
        const overlay = document.getElementById('cartOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }

    // Remove Item
    function removeItem(index) {
        window.location.href = '?remove=' + index;
    }

    // Auto-open cart if openCart parameter is present
    <?php if (isset($_GET['openCart']) || isset($_POST['addCart'])) { ?>
        setTimeout(function() {
            toggleCart();
        }, 100);
    <?php } ?>
</script>
</body>
</html>