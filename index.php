<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}
require_once 'database/Products.php';

// mostrar categorías   
$sel = new Products;
$select = $sel->show_categories();

//mostrar productos
$products = $sel->show_products();

$message = '';
$messageOk = '';
if (isset($_POST['btn-save'])) {
    /* $product = new Products; */
    $message = $sel->validation_fields_products($_POST['product'], $_POST['price'], $_FILES['img-file']['type'], $_POST['categories']);

    if (empty($message)) {
        // load photo
        $dateTime = new DateTime();
        $dir = 'public/imgs/products/';
        if (!empty($_FILES['img-file']['name'])) {
            $name = $dir . $dateTime->getTimestamp() . '_' . basename($_FILES['img-file']['name']);
        } else {
            $name = NULL;
        }

        $img = move_uploaded_file($_FILES['img-file']['tmp_name'], $name);


        // insert products
        $insert = $sel->insert_product($_POST['categories'], $_SESSION['id_user'], $_POST['product'], $_POST['price'], $_POST['comment'], $name);

        if ($insert === true) {
            $messageOk = 'Producto ingresado.';
            header('Location: index.php');
            exit;
        } else {
            $message = 'Producto NO ingresado.';
        }
    }
}
?>
<?php require_once 'includes/head.inc.php'; ?>


</head>

<body class="bg-dark">
    <br><br>

    <div class="jumbotron">
        <?php require_once 'includes/nav.inc.php'; ?>

        <div class="row border border-success mt-3 p-3">
            <div class="col-sm-4">
                <form class="needs-validation" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Producto:</label>
                            <input type="text" class="form-control" name="product" placeholder="Producto" required>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Precio:</label>
                            <input type="text" class="form-control" name="price" placeholder="Precio" required>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom02">Categoría:</label>
                            <select class="form-select col-md-12" aria-label="Default select example" name="categories">
                                <option selected>Elige una categoría</option>
                                <?php
                                foreach ($select as $row) { ?>
                                    <option value="<?php echo $row['cod_cat'] ?>"><?php echo $row['desc_cat']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Foto del producto:</label>
                                <input class="form-control form-control-sm" type="file" name="img-file">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3 col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">¿Algún comentario?</label>
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                            <br>
                        </div>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-danger col-md-12" role="alert"><?php echo $message; ?></div>

                        <?php } ?>
                        <?php if (!empty($messageOk)) { ?>
                            <div class="alert alert-success col-md-12" role="alert"><?php echo $messageOk; ?></div>
                        <?php } ?>

                    </div>

                    <!-- button submit -->
                    <button class="btn btn-success" type="submit" name="btn-save"> <i class="far fa-save"></i> Guardar</button>

                </form>

            </div>
            <div class="col-sm-8">
                <table class="table table-striped table-inverse table-responsive table-dark table-bordered table-hover">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Código de producto</th>
                            <th>Nombre de producto</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Foto del producto</th>
                            <th>Observaciones</th>
                            <th>Ingresado por:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $product) {
                            $_SESSION['cod_prod'] = $product['cod_prod'];
                        ?>
                            <tr>
                                <td scope="row"><?php echo $product['cod_prod'] ?></td>
                                <td><?php echo $product['name_prod'] ?></td>
                                <td>$ <?php echo $product['Price'] ?></td>
                                <td><?php echo $product['desc_cat'] ?></td>
                                <td> <img src="<?php echo $product['photo_prod'] ?>" class="img-thumbnail bg-dark" alt="Sin foto de <?php echo $product['name_prod']; ?>" width="100" height="100" /></td>
                                <td><?php echo $product['obs_prod'] ?></td>
                                <td> <img src="public/imgs/users/<?php echo $product['photo_us']; ?>" class="img-thumbnail bg-dark" width="100" height="100" /> <?php echo $product['name_us'] ?></td>
                                <?php if ($_SESSION['id_user'] == 1) { ?>
                                    <!-- delete button -->
                                    <td><a id="" class="btn btn-danger" href="delete_product.php?ID_PRODUCT=<?php echo $product['cod_prod']; ?>&IMG=<?php echo $product['photo_prod']; ?>" onclick="if (confirm('¿Desea eliminar <?php echo $product['name_prod'] ?> ?')) {return true;} else {return false;}">Eliminar</a></td>
                                    <!-- update button -->
                                    <td><a id="" class="btn btn-info" href="update_product.php?ID_PRODUCT=<?php echo $product['cod_prod']; ?>" onclick="if (confirm('¿Desea modificar <?php echo $product['name_prod'] ?> ?')) {return true;} else {return false;}">Modificar</a></td>

                                <?php } ?>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
        <?php require_once 'includes/footer.inc.php'; ?>