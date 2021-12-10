<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}
?>

<?php require_once 'includes/head.inc.php'; ?>


</head>

<body class="bg-dark">
    <br><br><br><br>
    <div class="jumbotron">
        <?php require_once 'includes/nav.inc.php'; ?>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-lg mt-3" data-toggle="modal" data-target="#modelId">
            Agregar producto
        </button>


        <!------------------------ Modal -------------------------->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Producto:</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="Producto" value="" required>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Precio:</label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="Precio" value="" required>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label for="formFileSm" class="form-label">Foto del producto:</label>
                                        <input class="form-control form-control-sm" id="formFileSm" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="mb-3 col-md-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">¿Algún comentario?</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- button submit -->
                            <button class="btn btn-success" type="submit">Agregar producto</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </form>
                        <!-- ===================================================================================== -->
                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Loop over them and prevent submission
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                        form.addEventListener('submit', function(event) {
                                            if (form.checkValidity() === false) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }
                                            form.classList.add('was-validated');
                                        }, false);
                                    });
                                }, false);
                            })();
                        </script>
                    </div>

                </div>
            </div>
        </div>


        <?php require_once 'includes/footer.inc.php'; ?>