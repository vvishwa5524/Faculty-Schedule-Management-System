<?php
session_start();
require 'connections.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE Email = :email");
    $stmt->execute(['email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "Email is already registered. Please use another email.";
        exit;
    }

    // Hash the password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO admin (Name, Email, password) VALUES (:name, :email, :password)");
    
    if ($stmt->execute(['name' => $name, 'email' => $email, 'password' => $password])) {
        $_SESSION['user_id'] = $pdo->lastInsertId(); // Store user ID in session
        $_SESSION['email'] = $email; // Store email in session
        header("Location: index.php"); // Redirect to dashboard after successful registration
        exit;
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iofrm</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme8.css">
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="index.php">
                <div class="logo">
                    <img class="logo-size" src="images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Get more things done with Loggin platform.</h3>
                    <p>Access to the most powerfull tool in the entire design and web industry.</p>
                    <img src="images/graphic4.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="index.php">
                                <div class="logo">
                                    <img class="logo-size" src="images/logo-light.svg" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="page-links">
                            <a href="index.php">Login</a><a href="register.php" class="active">Register</a>
                        </div>
                        <form action="#" method="POST">
                            <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                            <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>
                        <div class="other-links">
                            <span>Or register with</span><a href="#">Facebook</a><a href="#">Google</a><a href="#">Linkedin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>