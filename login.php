<?php
session_start();

$message = '';
if (isset($_POST['login'])) {
    require_once 'database/select.php';
    $user = new Select;
    $user_logged = $user->data_user($_POST['email'], $_POST['pass']);

    if (!empty($user_logged)) {
        /* ADMIN: juanchismo10@gmail.com  password: 123 */
        /* USUARIO COMUN melisa@hotmali.com  password: 123 */
        $_SESSION['id_user'] = $user_logged['ID'];
        $_SESSION['id_lev']  = $user_logged['ID_LEV'];
        $_SESSION['name']    = $user_logged['NAME'];
        $_SESSION['nick']    = $user_logged['NICK'];
        $_SESSION['photo']   = $user_logged['PHOTO'];

        header('Location: index.php');
        exit;
    } else {
        $message = 'Datos incorrectos!';
    }
}
?>

<?php require_once 'includes/head.inc.php'; ?>
</head>

<body class="bg-dark">
    <br><br><br><br>
    <!-- <br><br><br><br> -->
    <div class="container p-3">
        <div class="row">
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4">
                <div class="card bg-secondary text-white">
                    <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
                    <div class="card-body">
                        <form method="POST">
                            <img class="card-img-top img-fluid" src="public/imgs/logo.png" alt="Card image cap">
                            <h4 class="card-title">Login </h4>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                                <label for="pass">Password:</label>
                                <input type="password" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="">
                                <!--     -->
                                <button type="submit" class="btn btn-success mt-3" name="login">Submit</button>
                                <p class="card-text text-warning"><strong><?php echo !empty($message) ? '<i class="fa fa-info-circle" aria-hidden="true"></i> ' . $message : ''; ?></strong></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">

            </div>
        </div>
        <?php
        require_once 'includes/footer.inc.php';
        ?>