<nav class="main-header navbar navbar-expand border-bottom navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link">Bienvenido <?php echo $usuarioIngreso["nombre"]. " " . $usuarioIngreso["apellido"]?></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="ajustes">
                <i class="fas fa-user-cog"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="salir">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>