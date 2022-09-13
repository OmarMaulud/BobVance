<?php
session_start();
require 'connect.php';
if (isset($_POST['register'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $sql = "SELECT COUNT(username) AS num FROM gebruiker WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['num'] > 0) {
        die('That username already exists!');
    }
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    $sql = "INSERT INTO gebruiker (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $result = $stmt->execute();
    if ($result) {
        echo 'Thank you for registering with our website.';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="register" value="Register"></button>
        </form>
        <form action="login.php" method="get">
            <label for="login-page">Back to login page</label>
            <input type="submit" id="login-page" name="login-page" value="Back to Login"><br>
        </form>
    </body>
</html>