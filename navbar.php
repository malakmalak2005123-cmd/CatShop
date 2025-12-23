<!-- navbar.php -->
<nav class="navbar">
  <div class="logo">🐾 CatShop</div>
  <ul class="menu">
    <li><a href="home.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="contact.php">Contact</a></li>
    
    <li><a href="?openCart=1">Cart</a></li>
  </ul>
</nav>

















<style>
/* Navbar sticky & style Soft & Cute */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background: #FFF9F3; /* Soft & Cute background */
  padding: 14px 28px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  border-bottom-left-radius: 18px;
  border-bottom-right-radius: 18px;
  z-index: 9999;
}

.logo {
  font-size: 1.4rem;
  font-weight: bold;
  color: #3D3D3D;
  margin-left: 10px; /* Petit espacement entre l'icône et le logo */
}

.menu {
  display: flex;
  gap: 20px;
  list-style: none;
}

.menu a {
  color: #3D3D3D;
  text-decoration: none;
  padding: 6px 12px;
  border-radius: 10px;
  transition: 0.2s;
}

.menu a:hover {
  background: #b6e6f9ff;
}

.cart-icon {
  position: relative;
  font-size: 26px;
}

.cart-icon a {
  text-decoration: none;
  color: #3D3D3D;
  padding: 6px 12px;
  border-radius: 10px;
  transition: 0.2s;
}

.cart-icon a:hover {
  background: #b6e6f9ff;
}

.cart-count {
  position: absolute;
  top: -8px;
  right: -8px;
  background: #ff6b6b;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 0.8rem;
  font-weight: bold;
}

body {
  margin: 0;
  padding-top: 70px; 
}


@media screen and (max-width: 768px) {
  .navbar {
    flex-direction: column;
    gap: 10px;
    padding: 10px 20px;
  }
  .menu {
    flex-direction: column;
    gap: 10px;
    width: 100%;
  }
  .menu a {
    text-align: center;
  }
  .cart-icon {
    font-size: 24px;
    margin-bottom: 10px;
  }
  .logo {
    margin-left: 0;
  }
}

.cart-sidebar {
  position: fixed;
  top: 0;
  left: -350px; /* Correction: doit être left pour glisser depuis la gauche */
  width: 300px;
  height: 100%;
  background: white;
  box-shadow: 5px 0 20px rgba(0,0,0,0.15); /* Correction: ombre vers la droite */
  padding: 20px;
  transition: left 0.4s ease; /* Correction: transition sur left */
  z-index: 999;
}

.cart-sidebar.open {
  left: 0; /* Correction: open vers left: 0 */
}
</style>












