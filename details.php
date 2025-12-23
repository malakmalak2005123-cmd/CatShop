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
    header("Location: details.php?id=" . $_GET['id'] . "&openCart=1");
    exit();
}

include "configue.php";

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM produits WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

$row = $stmt->fetch();

if(!$row){
    header("Location: home.php");
    exit();
}

// Check if product is confirmed
$stmtStatus = $pdo->prepare("SELECT status FROM adopted WHERE cat_id = ? AND status = 'Confirme' LIMIT 1");
$stmtStatus->execute([$id]);
$isConfirmed = $stmtStatus->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['name']; ?> - Détails du produit</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="details.css">
  
  
</head>
<body>
  <!-- Floating Cart Icon -->
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
      <!-- Header -->
      <div class="cart-header">
          <h3>
              <i class="fas fa-shopping-bag"></i>
              My Cart
          </h3>
          <button class="close-cart-btn" onclick="toggleCart()">
              <i class="fas fa-times"></i>
          </button>
      </div>

      <!-- Body -->
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

      <!-- Footer -->
      <?php if (!empty($_SESSION['cart'])) { ?>
          <div class="cart-footer">
              <button class="confirm-btn" onclick="window.location.href='adopter.php'">
                  <i class="fas fa-check-circle"></i>
                  Confirm Adoption 
              </button>
          </div>
      <?php } ?>
  </div>

  <div class="breadcrumb">
    <a href="home.php">Home</a> / <?php echo $row['name']; ?>
  </div>

  <div class="product-container">
    <div class="product-wrapper">
      <!-- Image Section -->
      <div class="image-section">
        <img src="image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="main-image">
        <span class="image-badge">Available</span>
      </div>

      <!-- Information Section -->
      <div class="info-section">
        <div>
          <h1 class="product-title"><?php echo $row['name']; ?></h1>
          <span class="product-type"><?php echo $row['Type']; ?></span>

          <div class="price-section">
            <div class="price-label">Adoption Price</div>
            <div class="price-value"><?php echo $row['prix']; ?> DH</div>
          </div>

          <div class="specs-grid">
            <div class="spec-item">
              <div class="spec-label">Age</div>
              <div class="spec-value"><?php echo $row['age']; ?></div>
            </div>
            <div class="spec-item">
              <div class="spec-label">Sex</div>
              <div class="spec-value"><?php echo $row['sexe']; ?></div>
            </div>
          </div>

          <div class="description-section">
            <h2 class="section-title">Description</h2>
            <p class="description-text"><?php echo $row['description_courte']; ?></p>
          </div>

          <div class="description-section">
            <h2 class="section-title">Characteristics</h2>
            <p class="description-text"><?php echo $row['caracteristiques']; ?></p>
          </div>
        </div>

        <div class="action-buttons">
          <?php if($isConfirmed): ?>
              <button disabled class="btn-adopter" style="background: #ccc; cursor: not-allowed; box-shadow: none;">
                <i class="fas fa-lock"></i>
                Already Reserved
              </button>
              
               <button disabled class="btn-cart" style="background: #eee; color: #999; border-color: #ddd; cursor: not-allowed;">
                  <i class="fas fa-shopping-cart"></i>
                  Unavailable
              </button>
          
          <?php else: ?>
              <a href="adopter.php?id=<?php echo $row['id']; ?>" class="btn-adopter">
                <i class="fas fa-heart"></i>
                Adopt Now
              </a>
              
              <form method="post" action="" style="flex: 1;">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                  <input type="hidden" name="prix" value="<?php echo $row['prix']; ?>">
                  <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                  <button type="submit" name="addCart" class="btn-cart">
                      <i class="fas fa-shopping-cart"></i>
                      Add to Cart
                  </button>
              </form>
          <?php endif; ?>
          
          <a href="contact.php" class="btn-contact">
            <i class="fas fa-envelope"></i>
            Contact Us
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>&copy; 2025 CatShop. All rights reserved.</p>
</div>
<script>
    // Toggle Cart
    function toggleCart() {
        const sidebar = document.getElementById('cartSidebar');
        const overlay = document.getElementById('cartOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }

    // Remove Item
    function removeItem(index) {
        window.location.href = '?id=<?php echo $id; ?>&remove=' + index;
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