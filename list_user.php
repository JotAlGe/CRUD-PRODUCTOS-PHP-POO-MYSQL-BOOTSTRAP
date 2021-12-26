<?php
session_start();
if (empty($_SESSION['name'])) {
    header("Location: logout.php");
    exit;
}

require_once 'database/User.php';
$user = new User;
$users = $user->get_users();
?>
<?php require_once 'includes/head.inc.php'; ?>

</head>

<body class="bg-dark">
    <br><br>
    <div class="jumbotron">
        <?php require_once 'includes/nav.inc.php'; ?>

        <!-- For demo purpose -->
        <div class="container py-5">
            <div class="row text-center text-secondary">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4">Usuarios</h1>
                    <p class="lead mb-0">Usuarios registrados.</p>
                    <p class="lead">Ir al <a href="/my-kiosc" class="text-dark">
                            <u>Inicio</u></a>
                    </p>
                </div>
            </div>
        </div><!-- End -->
        <!-- <pre>
            <?php
            print_r($users);
            ?>
    </pre> -->
        <div class="container">
            <div class="row text-center">
                <?php
                for ($i = 0; $i < count($users); $i++) {
                ?>
                    <!-- Team item -->

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="/my-kiosc/public/imgs/users/<?php echo $users[$i]['photo_us'] ?>" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0"><?php echo $users[$i]['nick_us'] ?></h5><span class="small text-uppercase text-muted"><?php echo $users[$i]['desc_lev'] ?></span>
                            <small class="text-muted"><?php echo $users[$i]['email'] ?></small>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a onclick="if(confirm('¿Desea eliminar el usuario <?php $users[$i]['nick_us']; ?>?')) {return true;} else {return false;}" href="delete_user.php?ID_USER=<?php echo $users[$i]['cod_us'] ?>&IMG=<?php echo $users[$i]['photo_us'] ?>" class="social-link"><i class="fas fa-trash-alt" style="color: red"></i></a></li>
                                <!-- <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li -->
                                <!-- <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li> -->
                            </ul>
                        </div>
                    </div><!-- End -->
                <?php
                }
                ?>

            </div>
        </div>
    </div>

</body>