<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}

require_once 'database/Products.php';
$product = new Products();

if ($product->delete_product($_GET['ID_PRODUCT'])) {
    #delete image from server
    $product->delete_img($_GET['IMG']);
    // redirecting
    header('Location: index.php');
    exit;
} else {
    $_SESSION['Mensaje'] .= 'No se pudo borrar el producto. <br /> ';
    $_SESSION['Estilo'] = 'warning';
}
