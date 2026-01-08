<?php include 'navbar.php'; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>About Us — Cat Shop</title>
  <link rel="stylesheet" href="about.css">
</head>
<body>
  <div class="container">
    <article class="card" aria-labelledby="about-title">
      <div>
        <header>
          <h1 id="about-title">About Us</h1>
          <p class="lead">
            Welcome to our cat shop! We are a passionate team dedicated to raising and selling healthy, well-cared-for cats. Our mission is to provide families with friendly, clean, and well-socialized cats that can easily adapt to their new homes.
          </p>
        </header>

        <section aria-labelledby="before-selling">
          <h2 id="before-selling">Before Selling</h2>
          <p>
            Before selling any cat, we make sure it receives:
          </p>
          <ul class="benefits" aria-label="What we provide">
            <li>Proper and balanced nutrition</li>
            <li>A clean and safe environment</li>
            <li>Regular health check-ups</li>
            <li>Socialization and human interaction</li>
          </ul>
        </section>

        <section aria-labelledby="our-commitment">
          <h2 id="our-commitment">Our Commitment</h2>
          <p>
            We take great pride in offering high-quality breeds and excellent customer service. Your trust matters to us, and we work hard to ensure you adopt a happy, healthy cat.
          </p>
          <p>Thank you for visiting our website, and feel free to contact us for any questions or additional information!</p>

          <footer class="note" role="contentinfo">
            <small>Tip: Always give your new cat a few days to explore their new home room by room. Patience and love are the keys to a happy adoption!</small>
          </footer>
        </section>
      </div>

      <aside class="contact" aria-label="Contact and shop info">
        <img class="shop-image" src="image/image.png" alt="Photo of cats in our care" />
        <h3>Contact Us</h3>
        <p>Phone: <strong>+212 623682744</strong><br/>Email: <strong>malakmalak2005123@gmail.com</strong></p>
        <a class="btn" href="contact.php">Contact / Inquiry</a>
      </aside>
    </article>
  </div>
  <div class="footer">
    <p>&copy; 2025 CatShop. Tous droits réservés.</p>
  </div>
</body>
</html>