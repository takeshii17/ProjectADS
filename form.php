<?php
// PHP code to handle form submission (optional, if you need to process the form data)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? ''; // Using null coalescing operator to avoid undefined index errors
    $password = $_POST['password'] ?? '';
    $rememberMe = isset($_POST['remember-me']) ? true : false;

    // You can add validation here (e.g., checking if credentials are correct)
    // For now, we'll just echo the values.
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";
    echo "Remember Me: " . ($rememberMe ? 'Yes' : 'No') . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="static/css/design.css">
</head>
<body>
    <form class="container" method="POST" action="">
        <h1 class="login-title">Log In</h1>

        <section class="input-box">
            <input type="text" name="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </section>

        <section class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </section>

        <section class="remember-forgot-box">
            <div class="remember-me">
                <input type="checkbox" name="remember-me" id="remember-me">
                <label for="remember-me">
                    <h5>Remember Me</h5>
                </label>
            </div>
            <a class="forgot-password" href="#">
                <h5>Forgot Password?</h5>
            </a>
        </section>

        <button class="login-button" type="submit">
            Login
        </button>

        <h5 class="dont-have-an-account?">
            Don't have an account?
            <a href="#"><b>Register</b></a>
        </h5>
    </form>
</body>
</html>
