<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}
require_once 'database/User.php';
$user = new User;

if ($user->delete_user($_GET['ID_USER'])) {
    $user->delete_img($_GET['IMG']);
    header('Location: list_user.php');
    exit;
}
