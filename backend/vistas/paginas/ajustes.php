<div class="content-wrapper" style="min-height: 1058.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Ajustes de Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center"><?php echo $usuarioIngreso["nombre"]. " " . $usuarioIngreso["apellido"];?></h3>

                            <p class="text-muted text-center"><?php echo $usuarioIngreso["rol"];?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Noticias Publicadas</b> <a class="float-right"><?php echo $noticiasPublicadas["cantidad"];?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Videos Publicados</b> <a class="float-right"><?php echo $videosPublicados["cantidad"];?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Documentos Subidos</b> <a class="float-right"><?php echo $documentosSubidos["cantidad"];?></a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="">Ajustes</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <form method="post" id="modal_ajuste_usuario" class="form-horizontal">
                                <input type="hidden" name="idAjusteUsuario" value="<?php echo $_SESSION["idBackend"];?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append input-group-text">
                                                <label class="mb-0">Nombre:</label>
                                            </div>
                                            <input type="text" class="form-control" value="<?php echo $usuarioIngreso["nombre"]. " " . $usuarioIngreso["apellido"];?>" readonly>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append input-group-text">
                                                <label class="mb-0">E-mail:</label>
                                            </div>
                                            <input type="text" class="form-control" value="<?php echo $usuarioIngreso["correo"];?>" readonly>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>

                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Cambie su contraseña</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append input-group-text">
                                                        <span class="fas fa-user-lock"></span>
                                                    </div>
                                                    <input type="password" id="password" class="form-control" name="ajustarPassword" placeholder="Ingresa la nueva contraseña" required>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3 has-success">
                                                    <div class="input-group-append input-group-text">
                                                        <span class="fas fa-user-check"></span>
                                                    </div>
                                                    <input type="password" id="confirmar_password" class="form-control" name="ajustarConfirmarPassword" placeholder="Confirma la nueva contraseña" required>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <div class="input-group">
                                            <span class="resultado_password alert ocultar" role="alert"></span>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="tipo" value="ajusteUsuario">
                                        <button type="submit" class="btn btn-danger">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>