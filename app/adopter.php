<?php
session_start();
include "configue.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lazy migration to drop UNIQUE constraints if they exist
    // This ensures we can insert multiple orders for the same CIN/Email
    try {
        $pdo->query("DROP INDEX cin ON adopted");
    } catch (Exception $e) {}
    try {
        $pdo->query("DROP INDEX email ON adopted");
    } catch (Exception $e) {}
    try {
        $pdo->query("DROP INDEX phone ON adopted");
    } catch (Exception $e) {}

    $fullname = trim($_POST['fullname']);
    $cin      = trim($_POST['cin']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $address  = trim($_POST['address']);
    $cat_id   = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : null;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
        // Validation removed to allow multiples
        if (false) {
        } else {
            // session_start() is now at top of file, ensuring session access
             $stmt = $pdo->prepare(
                "INSERT INTO adopted (fullname, cin, email, phone, address, cat_id)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );

            $success = false;

            // Scenario 1: Prescribed ID
            if ($cat_id) {
                $stmt->execute([$fullname, $cin, $email, $phone, $address, $cat_id]);
                $success = true;
            } 
            // Scenario 2: Cart Adoption
            elseif (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                     // Insert each item from cart
                     // Note: We might want to check for duplicates again here or just handle the error/continue
                     // For simplicity, we assume the user intends to adopt all.
                     try {
                         $stmt->execute([$fullname, $cin, $email, $phone, $address, $item['id']]);
                         $success = true;
                     } catch (PDOException $e) {
                         // Ignore duplicate entry errors if user retries or just proceed
                     }
                }
                // Clear cart after successful adoption request
                if ($success) {
                    unset($_SESSION['cart']);
                }
            } else {
                 $error = "No product selected for adoption.";
            }

            if ($success) {
                 $success = "✅ Your request has been successfully submitted.";
            }
        }
    }
}
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Adoption Form</title>
<link rel="stylesheet" href="adopter.css">
</head>
<body>

<div class="form-box">
    <h1>Adoption Form</h1>

    <?php if (isset($success)) : ?>
        <p class="success"><?= $success ?></p>
        <a href="home.php" style="display:block; text-align:center; margin-top:15px; text-decoration:none; color:#adb5bd; font-weight:bold;">← Return to Home</a>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <?php if($id): ?>
            <input type="hidden" name="cat_id" value="<?= $id ?>">
        <?php endif; ?>
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="text" name="cin" placeholder="CIN" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="phone" placeholder="Phone Number" required>
        <input type="text" name="address" placeholder="Address" required>

        <button type="submit">Submit Request</button>
    </form>
</div>



</body>
</html>
