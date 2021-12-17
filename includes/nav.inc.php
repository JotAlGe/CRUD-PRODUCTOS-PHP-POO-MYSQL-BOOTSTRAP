<h1 class="display-2"><strong> <a href="http://localhost/my-kiosc" class="text-secondary">Mi Kiosco</a></strong></h1>


<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img class="img-responsive" src="/my-kiosc/public/imgs/users/<?php echo $_SESSION['photo'] ?>" width="50" height="50" alt="">
        <?php echo $_SESSION['nick']; ?> <?php echo $_SESSION['id_lev'] == 1 ? '(Administrador)' : ''; ?>
    </a>
    <a class="nav-link" href="#">Productos <span class="sr-only">(current)</span></a>
    <a class="nav-link text-dark" href="/my-kiosc/logout.php" onclick="if (confirm('¿Desea cerrar sesión ?')) {return true;} else {return false;}">Cerrar Sesión</a>
</nav>