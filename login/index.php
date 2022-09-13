<?php
    session_start();
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
        header('Location: login.php');
        exit;
    }
?>

<?php include 'connect.php';
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Bob's Refrigerators</title>
            <link rel="style.css">
        </head>
    <body>
        <h1> Welcome to Bob's Fridges!</h1>
        <a href="edit.php">Logout</a>

    </body>

    </html>