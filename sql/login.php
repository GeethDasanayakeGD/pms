<?php
include '../db_conn.php';

$usernameOrEmail = $_REQUEST["username"];
$password = $_REQUEST["password"];
$remember = isset($_REQUEST["remember"]) ? true : false;

$check = 0;
if (strpos($usernameOrEmail, '@') !== false) {
    $sql = "SELECT `id`, username, email FROM `user` WHERE email='$usernameOrEmail' AND password='$password'";
} else {
    $sql = "SELECT `id`, username, email FROM `user` WHERE username='$usernameOrEmail' AND password='$password'";
}

$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
    exit;
}

while ($row = $result->fetch_assoc()) {
    $check = 1;
    $id = $row["id"]; 
    $username = $row["username"];
    if ($remember) {
        $token = bin2hex(random_bytes(32));
        setcookie("remember_token", $token, time() + (86400 * 7), "/"); // 7 days
        $updateTokenSql = "UPDATE `user` SET remember_token='$token' WHERE `id`=$id"; 
        $conn->query($updateTokenSql);
    }
}

if ($check == 1) {
    session_start();
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;

    header('Location: ../map/');
} else {
    echo "<script>";
    echo "alert('Invalid details. Please try again.');";
    echo "window.location.replace('../Login.php');";
    echo "</script>";
}

$conn->close();
?>
