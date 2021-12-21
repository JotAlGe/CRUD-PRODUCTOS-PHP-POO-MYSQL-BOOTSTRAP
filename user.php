<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}
require_once 'database/Products.php';
$product = new Products;
$products = $product->product_per_user($_SESSION['id_user']);
?>
<?php require_once 'includes/head.inc.php'; ?>

</head>

<body class="bg-dark">
    <br><br>
    <nav class="nav justify-content-center">
        <a class="nav-link text-light active" href="/my-kiosc/">
            <h4>Inicio</h4>
        </a>
        <a class="nav-link text-light" href="/my-kiosc/logout.php" onclick="if (confirm('¿Desea cerrar sesión ?')) {return true;} else {return false;}">
            <h4>Cerrar Sesión</h4>
        </a>
    </nav>

    <div class="container-fluid bg-1 text-center">
        <img src="public/imgs/users/<?php echo $_SESSION['photo']; ?>" alt="Bird" class="rounded-circle border p-2" width="200" height="200">
        <h3><?php echo $_SESSION['nick']; ?></h3>
        <p><?php echo $_SESSION['id_lev'] == 1 ? 'Administrador' : 'Usuario normal'; ?></p>
    </div>
    <div class="container-fluid bg-2 text-center">
        <h3>Los productos agregados por mí</h3>
        <div class="row">

            <?php
            for ($i = 0; $i < count($products); $i++) { ?>

                <div class="card-group bg-dark m-3 mx-auto" style="width:400px">
                    <div class="curtain">
                        <h4>$<?php echo $products[$i]['Price']; ?></h4>
                    </div>
                    <img class="card-img-top" src="<?php echo $products[$i]['photo_prod'] ?>" alt="Sin foto de <?php echo $products[$i]['name_prod']; ?>" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $products[$i]['name_prod']; ?></h4>
                        <p class="card-text"><?php echo $products[$i]['obs_prod'] ?></p>

                        <?php if ($_SESSION['id_user'] == 1) { ?>
                            <!-- delete button -->
                            <td><a id="" class="btn btn-danger" href="delete_product.php?ID_PRODUCT=<?php echo $products[$i]['cod_prod']; ?>&IMG=<?php echo $products[$i]['photo_prod']; ?>" onclick="if (confirm('¿Desea eliminar <?php echo $products[$i]['name_prod'] ?> ?')) {return true;} else {return false;}">Eliminar</a></td>
                            <!-- update button -->
                            <td><a id="" class="btn btn-info" href="update_product.php?ID_PRODUCT=<?php echo $products[$i]['cod_prod']; ?>" onclick="if (confirm('¿Desea modificar <?php echo $products[$i]['name_prod'] ?> ?')) {return true;} else {return false;}">Modificar</a></td>

                        <?php } ?>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>

</body>

</html>