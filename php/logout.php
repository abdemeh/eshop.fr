<?php
session_start();

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

if (isset($_SESSION['user_role'])) {
    unset($_SESSION['user_role']);
}

if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_role'])) {
    setcookie('user_id', '', time() - 3600, "/");
    setcookie('user_role', '', time() - 3600, "/");
}

header("Location: ../login.php");
exit;
?>