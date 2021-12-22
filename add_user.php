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
    <br><br>
    <div class="jumbotron">
        <?php require_once 'includes/nav.inc.php'; ?>

        <div class="container">
            <br>
            <form>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name" class="col-md-6 col-form-label">Nombre:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="nick" class="col-md-6 col-form-label">Nick:</label>
                        <input type="text" class="form-control" name="nick" id="nick" placeholder="Ingrese el nickname">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="email" class="col-md-6 col-form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="ingrese el email">
                    </div>
                    <div class="col-md-6">
                        <label for="pass" class="col-md-6 col-form-label">Password:</label>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Ingrese la contraseña">
                    </div>
                </div>


                <div class="form-group row">
                    <input type="file" name="img-user" class="col-md-6 border">
                    <div class="offset-sm-12 col-md-6">
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>