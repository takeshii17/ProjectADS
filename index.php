<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "admin") {
        $query = "SELECT * FROM admin WHERE username = ?";
    } else {
        $query = "SELECT * FROM students WHERE email = ?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user[$role == "admin" ? 'admin_id' : 'student_id'];
            $_SESSION['role'] = $role;
            header("Location: " . ($role == "admin" ? "admin_dashboard.php" : "student_dashboard.php"));
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <h2>Login</h2>
        <label>Username/Email:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Role:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select><br>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</body>
</html>
