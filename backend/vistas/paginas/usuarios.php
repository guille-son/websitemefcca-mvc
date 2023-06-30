<?php
    $roles = ControladorRoles::ctrMostrarRoles();

    if($usuarioIngreso['rol'] != 'Super Administrador') {
        echo "<script>
            window.location = 'inicio';
        </script>";

        return;
    }
?>

<div class="content-wrapper" style="min-height: 1148.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pantalla">Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearUsuario">Crear
                                nuevo usuario</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Nombre y Apellido</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Id_Rol</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- ====================================================== -->
<!-- ================= Modal Crear Usuario ================ -->
<!-- ====================================================== -->

<div class="modal fade" id="crearUsuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_usuario">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Crear Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalRegistroUsuario">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-id-badge"></span>
                        </div>
                        <input type="text" class="form-control" name="registroNombre" placeholder="Ingresa el nombre"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="far fa-id-badge"></span>
                        </div>
                        <input type="text" class="form-control" name="registroApellido"
                            placeholder="Ingresa el apellido" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" class="form-control" name="registroUsuario" placeholder="Ingresa el usuario"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        <input type="email" class="form-control" name="registroCorreo" placeholder="Ingresa el correo"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-lock"></span>
                        </div>
                        <input type="password" id="password" class="form-control" name="registroPassword"
                            placeholder="Ingresa la contraseña" required>
                    </div>
                    <div class="input-group mb-3 has-success">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-check"></span>
                        </div>
                        <input type="password" id="confirmar_password" class="form-control" name="registroConfirmarPassword"
                            placeholder="Confirmar la contraseña" required>
                    </div>
                    <div class="input-group">
                        <span class="resultado_password alert ocultar" role="alert"></span>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-shield"></span>
                        </div>
                        <select class="form-control" name="registroRol" required>
                            <option value="default" selected="selected">Seleccione un Rol para el usuario</option>
                            <?php foreach ($roles as $key => $valueRoles) : ?>
                            <option value="<?php echo $valueRoles['id']; ?>"><?php echo $valueRoles['descripcion']; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarRegistroUsuario">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroUsuario">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================== -->
<!-- ================= Modal Editar Usuario =============== -->
<!-- ====================================================== -->

<div class="modal fade" id="editarUsuarioModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_usuario">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Usuario</h4>
                    <button type="button" id="btCerrarModalEditarUsuario" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="editarIdUsuario">
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-id-badge"></span>
                        </div>
                        <input type="text" class="form-control" name="editarNombre" value required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="far fa-id-badge"></span>
                        </div>
                        <input type="text" class="form-control" name="editarApellido" value required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" class="form-control" name="editarUsuario" value required readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        <input type="email" class="form-control" name="editarCorreo" value required readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-lock"></span>
                        </div>
                        <input type="password" id="password_editar" class="form-control" name="editarPassword" 
                        placeholder="Cambie su contraseña">
                        <input type="hidden" name="passwordActual" value="">
                    </div>
                    <div class="input-group mb-3 has-success">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-check"></span>
                        </div>
                        <input type="password" id="confirmar_password_editar" class="form-control" name="editarConfirmarPassword"
                        placeholder="Confirmar la contraseña">
                    </div>
                    <div class="input-group">
                        <span class="resultado_password alert ocultar" role="alert"></span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-shield"></span>
                        </div>
                        <select id="select-editar-rol" class="form-control" name="editarRol" required>
                        </select>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" id="btnCancelarEditarUsuario" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarUsuario">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>