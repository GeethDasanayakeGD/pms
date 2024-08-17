<?php
session_start();

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

session_destroy();

if (isset($_COOKIE["remember_token"])) {
    setcookie("remember_token", '', time() - 3600, '/');
}

header('Location: ../');
exit();
?>
