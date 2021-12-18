<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}

require_once 'database/Products.php';
$product = new Products();
$products = $product->show_form_update($_GET['ID_PRODUCT']);
$select = $product->show_categories();

$message = '';
$messageOk = '';
if (isset($_POST['btn-save'])) {
    $message = $product->validation_fields_products($_POST['product'], $_POST['price'], $products[0]['photo_prod'], $_POST['categories']);

    if (empty($message)) {

        $update = $product->update_product($_GET['ID_PRODUCT'], $_POST['product'], $_POST['price'], $_POST['comment'], $_POST['categories']);

        if ($update === true) {
            $messageOk = 'Producto Actualizado.';
            header('Location: index.php');
            exit;
        } else {
            $message = 'Producto NO actualizado.';
        }
    }
}

require_once 'includes/head.inc.php';

?>

<body class="bg-dark">
    <br><br>
    <div class="jumbotron">
        <?php require_once 'includes/nav.inc.php'; ?>

        <br><br>
        <div class="container">

            <form class="needs-validation" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Producto:</label>
                        <input type="text" class="form-control" name="product" placeholder="Producto" required value="<?php echo $products[0]['name_prod']; ?>">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Precio:</label>
                        <input type="text" class="form-control" name="price" placeholder="Precio" required value="<?php echo $products[0]['Price']; ?>">

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

                </div>
                <div class="form-row">
                    <div class="mb-3 col-md-12">
                        <label for="exampleFormControlTextarea1" class="form-label">¿Modificar comentario?</label>
                        <textarea class="form-control" name="comment" rows="3"><?php echo $products[0]['obs_prod']; ?></textarea>
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
                <button class="btn btn-success" type="submit" name="btn-save"> <i class="far fa-save"></i> Actualizar</button>
                <a onclick="if (confirm('¿Desea cancelar la edición?')) {return true;} else {return false;}" class="btn btn-danger" href="/my-kiosc" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</body>