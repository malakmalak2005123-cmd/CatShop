<?php include 'navbar.php'; ?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Get in Touch</title>
  <link rel="stylesheet" href="contact.css">
 
</head>
<body>

<div class="container">
  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="success-message">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
        <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="1.5"/>
        <path d="M6 10l3 3 5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      Your message has been sent successfully!
    </div>
  <?php endif; ?>

  <h1>Get in Touch</h1>
  <p class="subtitle">We'd love to hear from you. Whether you have questions about our cats or want to make a reservation, we're here to help.</p>

  <div class="info-card">
    <div class="info-item">
      <span class="info-label">Phone</span>
      <span>+212 62 36 82 744</span>
    </div>
    <div class="info-item">
      <span class="info-label">Email</span>
      <span>malakmalak2005123@gmail.com</span>
    </div>
    <div class="info-item">
      <span class="info-label">Location</span>
      <span>Oujda, Morocco</span>
    </div>
  </div>

  <form method="POST" action="send-message.php">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" required>
    </div>

    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" required>
    </div>

    <div class="form-group">
      <label>Phone Number <span style="color: #8b7a8b; font-weight: 400;">(optional)</span></label>
      <input type="text" name="phone">
    </div>

    <div class="form-group">
      <label>Your Message</label>
      <textarea name="message" required></textarea>
    </div>

    <button type="submit">Send Message</button>
  </form>
</div>
<div class="footer">
    <p>&copy; 2025 CatShop. All rights reserved.</p>
</div>

</body>
</html>