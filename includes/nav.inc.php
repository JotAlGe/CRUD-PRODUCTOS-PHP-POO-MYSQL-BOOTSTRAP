<h1 class="display-2"><strong>Mi Kiosco</strong></h1>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img class="img-responsive" src="/my-kiosc/public/imgs/users/<?php echo $_SESSION['photo'] ?>" width="50" height="50" alt="">
        <?php echo $_SESSION['nick']; ?>
    </a>
    <a class="nav-link" href="#">Productos <span class="sr-only">(current)</span></a>
    <a class="nav-link text-dark" href="/my-kiosc/logout.php">Cerrar Sesión</a>
</nav>