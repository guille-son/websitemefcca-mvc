<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo $ruta; ?>"><b>Admin </b>MEFCCA</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicio de Sesión</p>

                <form method="post" id="login_usuario">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="ingresoUsuario">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="ingresoPassword">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input type="hidden" name="tipo" value="login">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</body>