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
        $check_query = "SELECT * FROM signup WHERE Email = '$email' LIMIT 1";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message[] = "This email is already registered. Please use another.";
        } else {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up - Direct Recast</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style-signup2.css" />
</head>

<body>

    <div class="container">
        <div class="image-section"></div>
        <div class="singup-section">
            <h1 class="logo">
                <span class="direct">Direct</span><span class="recast">Recast</span>
            </h1>
            <h2>Signup</h2>
            <form method="post">
                <?php if (!empty($message)) : ?>
                    <?php foreach ($message as $msg): ?>
                        <div class="message-box">
                            <div class="error-icon">!</div>
                            <span><?php echo $msg; ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="repassword" placeholder="Re-enter Password" required />
                <button class="signup-button" type="submit" name="submit">SIGN UP</button>
            </form>
            <br/>
            <br/>
            <div class="singup-link">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>

</html>