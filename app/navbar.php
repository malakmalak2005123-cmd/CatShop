<!-- navbar.php -->
<link rel="stylesheet" href="navbar.css">

<nav class="navbar">
  <div class="logo">🐾 CatShop</div>
  
  <button class="hamburger" id="hamburger-btn" aria-label="Toggle menu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <ul class="menu" id="nav-menu">
    <li><a href="home.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="?openCart=1">Cart</a></li>
  </ul>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.getElementById('hamburger-btn');
    const menu = document.getElementById('nav-menu');

    if (hamburger && menu) {
      hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        menu.classList.toggle('active');
      });

      // Close menu when clicking a link
      menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          hamburger.classList.remove('active');
          menu.classList.remove('active');
        });
      });
    }
  });
</script>
