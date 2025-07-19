<?php
include 'db.php';
include 'encrypt.php';

session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $decrypted_password = decrypt($user["password"], $key);

        if ($password === $decrypted_password) {
            $_SESSION["user"] = $user;
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Incorrect password.";
        }
    } else {
        $msg = "No user found.";
    }

    $stmt->close();
}
?>

<form method="POST">
    <h2>Login</h2>
    <p style="color:red"><?= $msg ?></p>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>
<a href="signup.php">Don't have an account? Signup</a>
