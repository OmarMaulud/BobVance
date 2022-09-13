<?php
session_start();
require 'connect.php';
if (isset($_POST['login'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $sql = "SELECT id, username, password FROM gebruiker WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        die('Incorrect username / password combination!');
    } else {
        $validPassword = password_verify($passwordAttempt, $user['password']);
        if ($validPassword) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            header('Location: index.php');
            exit;
        } else {
            die('Incorrect username / password combination!');
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="login" value="Login">
        </form>
        <form action="register.php" method="get">
            <label for="register">Register here!</label>
            <input type="submit" id="register" name="register" value="Register"><br>
        </form>
    </body>
</html>