<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM signup WHERE Email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['Password'] === $password) {
                $_SESSION['user_name'] = $user_data['Name'];
                header("Location: Home.php");
                exit();
            }
        }

        $message = "Incorrect Email or Password. Please try again.";
    } else {
        $message = "Please fill in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/Style-login.css" />
</head>
<body>


<div class="main-content">
  <div class="login-box">
    <img src="../images/Logo.jpeg" alt="Direct Recast Logo" class="logo" />
    <h1>Welcome to <span><strong>Direct</strong> <span class="highlight">Recast</span></span></h1>
    <div class="subtitle">The Nature of Sales Forecasting</div>

    <form action="" method="post">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />

      <?php if (!empty($message)): ?>
        <div class="login-error">
          <span class="error-icon">❗</span>
          <?php echo $message; ?>
        </div>
      <?php endif; ?>

      <button class="login-button" type="submit">LOG IN</button>
    </form>

    <div class="signup">
      Don’t have an account? <a href="signup.php" class="link-blue">Sign Up</a>
    </div>
  </div>
</div>

<div class="footer-container">
  <div class="footer-bar footer-blue"></div>
  <div class="footer-bar footer-red"></div>
</div>
</body>
</html>
