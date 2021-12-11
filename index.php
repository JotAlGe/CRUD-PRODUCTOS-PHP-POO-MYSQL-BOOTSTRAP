<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}
require_once 'database/Products.php';

$message = '';
if (isset($_POST['btn-save'])) {
    $product = new Products;
    $message = $product->validation_fields_products($_POST['product'], $_POST['price'], $_FILES['img-file']['type'], $_POST['comment']);

    /* if (empty($message)) {
        
    } */
}
?>
<?php require_once 'includes/head.inc.php'; ?>


</head>

<body class="">
    <br><br><br><br>
    <div class="jumbotron">
        <?php require_once 'includes/nav.inc.php'; ?>


        <div class="row border border-success mt-3 p-3">
            <div class="col-sm-6">
                <form class="needs-validation" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Producto:</label>
                            <input type="text" class="form-control" name="product" placeholder="Producto" value="">

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Precio:</label>
                            <input type="text" class="form-control" name="price" placeholder="Precio" value="">

                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Foto del producto:</label>
                                <input class="form-control form-control-sm" type="file" name="img-file">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3 col-md-8">
                            <label for="exampleFormControlTextarea1" class="form-label">¿Algún comentario?</label>
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                            <br>
                        </div>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-danger col-md-8" role="alert"><?php echo $message; ?></div>

                        <?php } ?>
                    </div>

                    <!-- button submit -->
                    <button class="btn btn-success" type="submit" name="btn-save"> <i class="far fa-save"></i> Guardar</button>

                </form>

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <?php require_once 'includes/footer.inc.php'; ?>