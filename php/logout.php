<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

if (isset($_SESSION['role'])) {
    unset($_SESSION['role']);
}

if (isset($_SESSION['panier'])) {
    unset($_SESSION['panier']);
}

header("Location: ../login.php");
exit;
?>