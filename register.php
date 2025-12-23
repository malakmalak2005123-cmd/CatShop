<!-- <?php
// include "configue.php";

// if(isset($_POST["submit"])){
//     $username = $_POST["username"];
//     $email = $_POST["email"];
//     $password = $_POST["password"];

//     // تشفير كلمة السر
//     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//     // INSERT فال table user
//     $sql ="INSERT INTO users (username, email, password)
//            VALUES('$username', '$email' ,'$hashedPassword')";

//     if(mysqli_query($connexion,$sql)){
//         echo "<p style='color:green;text-align:center;'>Register successful!</p>";
//     } else {
//         echo "<p style='color:red;text-align:center;'>Error!</p>";
//     }
// }
?>



<div class="container">
    <h2>Register</h2>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit">Register</button>
        <p style="text-align:center; margin-top:10px;">
        Already have an account? 
        <a href="log.php" style="color:#4A90E2; text-decoration:none;">Login here</a>
    </p>
    </form>
</div>
<div class="footer">
    <p>&copy; 2025 CatShop. All rights reserved.</p>
</div>


<style>body {
    margin: 0;
    padding: 0;
    background: #f0f2f5;
    font-family: Arial, sans-serif;
}

.container {
    width: 350px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    margin: 80px auto;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 7px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 15px;
}

button {
    width: 100%;
    padding: 10px;
    background: #4A90E2;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: #357ABD;
}
    background: #357ABD;
}
/* Footer */
.footer p {
  text-align: center;
  padding: 50px;
  background-color: #ffffffff;
  color: #6c757d;
  font-size: 0.9rem;
  font-weight: 500;
}
</style> -->
