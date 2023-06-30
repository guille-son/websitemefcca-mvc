<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
        <img src="vistas/img/icono.png" alt="Mefcca Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">MEFCCA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar backend">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul id="ulBotonesMenu" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo $ruta; ?>" class="nav-link" target="_blank">
                        <i class="fas fa-globe nav-icon"></i>
                        <p>Ver Sitio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="inicio" class="nav-link" pantalla="Analiticas">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <?php if(($usuarioIngreso['rol'] == 'Administrador') || ($usuarioIngreso['rol'] == 'Super Administrador')): ?>
                    <li class="nav-item">
                        <a href="banner" class="nav-link" pantalla="Banner">
                            <i class="far fa-images nav-icon"></i>
                            <p>Banner</p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="noticias" class="nav-link" pantalla="Noticias">
                        <i class="fas fa-newspaper nav-icon"></i>
                        <p>Noticias</p>
                    </a>
                </li>
                <?php if($usuarioIngreso['rol'] == 'Super Administrador'): ?>
                    <li class="nav-item">
                        <a href="estructura" class="nav-link" pantalla="Estructura">
                            <i class="fas fa-building nav-icon"></i>
                            <p>Estructura</p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="document" class="nav-link" pantalla="Documentos">
                        <i class="fas fa-file-alt nav-icon"></i>
                        <p>Documentos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="videos" class="nav-link" pantalla="Videos">
                        <i class="fab fa-youtube nav-icon"></i>
                        <p>Videos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="radio" class="nav-link" pantalla="Programas Radiales">
                        <i class="fas fa-microphone-alt nav-icon"></i>
                        <p>Programas de Radio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="transmisiones" class="nav-link" pantalla="Transmisiones">
                        <i class="fab fa-facebook nav-icon"></i>
                        <p>Transmisiones</p>
                    </a>
                </li>
                <?php if($usuarioIngreso['rol'] == 'Super Administrador'): ?>
                    <li class="nav-item">
                        <a href="delegaciones" class="nav-link" pantalla="Delegaciones">
                        <i class="fas fa-globe-americas nav-icon"></i>
                            <p>Delegaciones</p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($usuarioIngreso['rol'] == 'Super Administrador'): ?>
                    <li class="nav-item">
                        <a href="usuarios" class="nav-link" pantalla="Usuarios">
                        <i class="fas fa-users nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>