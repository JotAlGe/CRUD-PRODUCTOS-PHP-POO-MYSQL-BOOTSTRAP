<?php
session_start();

if (empty($_SESSION['name'])) {
    header('Location: logout.php');
    exit;
}
require_once 'database/User.php';

$message = '';
$messageOk = '';
if (isset($_POST['btn-add'])) {
    // load photo
    $dateTime = new DateTime();

    // rename image
    if (!empty($_FILES['img-user']['name'])) {
        $name = $dateTime->getTimestamp() . '_' . basename($_FILES['img-user']['name']);
    } else {
        $name = NULL;
    }
    $user = new User();
    $user->set_user($_SESSION['id_user'], 2, $_POST['name'], $_POST['nick'], $_POST['email'], $_POST['pass'], $_POST['pass2'], $name);
    $message = $user->validation_fields_user();


    if (empty($message)) {


        $inserted = $user->insert_user();
        if ($inserted === true) {
            $messageOk = 'Se registró el usuario ' . $_POST['name'] . '.';
            move_uploaded_file($_FILES['img-user']['tmp_name'], 'public/imgs/users/' . $name);
        } else {
            $message = 'No se pudo registrar el usuario' . $_POST['name'] . '.';
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

        <div class="container">
            <br>
            <form method="POST" enctype="multipart/form-data">
                <?php if (!empty($message)) { ?>
                    <div class="alert alert-danger col-md-12" role="alert"><?php echo $message; ?></div>

                <?php } ?>
                <?php if (!empty($messageOk)) { ?>
                    <div class="alert alert-success col-md-12" role="alert"><?php echo $messageOk; ?></div>
                <?php } ?>

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
                    <div class="col-md-3">
                        <label for="pass" class="col-md-6 col-form-label">Contraseña:</label>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Ingrese la contraseña">
                    </div>
                    <div class="col-md-3">
                        <label for="pass2" class="col-md-12 col-form-label">Repetir contraseña:</label>
                        <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Ingrese la contraseña">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="img-user" class="col-md-12 col-form-label">Imagen de usuario:</label>
                    <input type="file" name="img-user" class="col-md-6 border">
                    <div class="offset-sm-12 col-md-6">
                        <button type="submit" class="btn btn-success" name="btn-add">Agregar</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>