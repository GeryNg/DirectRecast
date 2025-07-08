<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if (!empty($name) && !empty($email) && !empty($password) && $password === $repassword && !is_numeric($name)) {

        // Check if email already exists
        $check_query = "SELECT * FROM signup WHERE Email = '$email' LIMIT 1";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message[] = "This email is already registered. Please use another.";
        } else {
            // Insert user (without repassword)
            $query = "INSERT INTO signup (Name, Email, Password) VALUES ('$name', '$email', '$password')";
            mysqli_query($con, $query);
            header("Location: login.php");
            exit();
        }

    } else {
        $message[] = "Please enter valid information and make sure passwords match!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - Direct Recast</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/Style-signup.css?v=2" />
</head>
<body>

<div class="main-content">
  <div class="signup-box">
    <img src="../images/Logo.jpeg" alt="Direct Recast Logo" class="logo" />
    <h1>Welcome to <span><strong>Direct</strong> <span class="highlight">Recast</span></span></h1>
    <div class="subtitle">The Nature of Sales Forecasting</div>

    <!-- ✅ Error Message Box Here -->
    <?php if (!empty($message)) : ?>
      <?php foreach ($message as $msg): ?>
        <div class="message-box">
          <div class="error-icon">!</div>
          <span><?php echo $msg; ?></span>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="post">
      <input type="text" name="name" placeholder="Name" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="password" name="repassword" placeholder="Re-enter Password" required />
      <button class="signup-button" type="submit" name="submit">SIGN UP</button>
    </form>

    <div class="login-link">Already have an account? <a href="login.php" class="link-blue">Log In</a></div>
  </div>
</div>

<div class="footer-container">
  <div class="footer-bar footer-blue"></div>
  <div class="footer-bar footer-red"></div>
</div>
</body>
</html>
