<?php
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
                    <h1 id="pantalla">Delegaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Delegaciones</li>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#crearDelegacion">Agregar
                                una nueva delegación</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaDelegaciones"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Delegación</th>
                                        <th>Delegado</th>
                                        <th>Telefono</th>
                                        <th style="width: 100px;">Imagen</th>
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
<!-- =============== Modal Nueva Delegación =============== -->
<!-- ====================================================== -->

<div class="modal fade" id="crearDelegacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_registro_delegacion" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Nueva Delegación</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalRegistroDelegacion">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-university"></span>
                        </div>
                        <input type="text" class="form-control" id="registroNombre" name="registroNombre"
                            placeholder="Escriba el nombre de la delegación" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-tie"></span>
                        </div>
                        <input type="text" class="form-control" id="registroDelegado" name="registroDelegado"
                            placeholder="Escriba el nombre del delegado" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend input-group-text">
                            <span class="fas fa-phone-alt"></span>
                        </div>
                        <input type="text" class="form-control" id="registroTelefono" name="registroTelefono"
                            placeholder="Ingrese el número de la delegación" required
                            data-inputmask='"mask": "9999-9999"' data-mask>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        <input type="email" class="form-control" name="registroCorreo"
                            placeholder="Ingresa el correo de la delegación" required>
                    </div>

                    <!-- Input para el link de la cuenta de facebook -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary"><i class="fab fa-facebook"></i></span>
                        </div>
                        <input type="text" class="form-control" id="facebookDlg" name="registroFacebook"
                            placeholder="Copie el link de la cuenta de Facebook">
                    </div>

                    <!-- Input para el link de la cuenta de instagram -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-danger"><i class="fab fa-instagram"></i></span>
                        </div>
                        <input type="text" class="form-control" id="instagramDlg" name="registroInstagram"
                            placeholder="Copie el link de la cuenta de Instagram">
                    </div>

                    <!-- Input para el link de la cuenta de twitter -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-info"><i class="fab fa-twitter"></i></span>
                        </div>
                        <input type="text" class="form-control" id="twitterDlg" name="registroTwitter"
                            placeholder="Copie el link de la cuenta de Twitter">
                    </div>

                    <div class="card rounded-lg card-secondary card-outline">
                        <div class="card-header pl-2 pl-sm-3">
                            <label>Escriba la dirección de la delegación:</label>
                        </div>

                        <div class="card-body">
                            <textarea id="registroDireccion" name="registroDireccion" class="form-control" rows="4"
                                style="width: 100%" required></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Adjunte una imagen de la delegación
                            <input type="file" class="form-control-file border" name="subirImagenDelegacion">
                            <input type="hidden" id="rutaImagen" name="rutaImagen"></input>
                        </div>
                        <p class="help-block small">Peso Max. 5MB | Formato: JPG o PNG</p>
                        <img class="previsualizarDelegacion img-fluid rounded-lg">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarRegistroDelegacion">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="registroDelegacion">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================== -->
<!-- =============== Modal Editar Delegación ============== -->
<!-- ====================================================== -->

<div class="modal fade" id="editarDelegacionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="modal_editar_delegacion" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar Delegación</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        id="btCerrarModalEditarDelegacion">&times;</button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="editarIdDelegacion">

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-university"></span>
                        </div>
                        <input type="text" class="form-control" id="editarNombre" name="editarNombre"
                            placeholder="Escriba el nombre de la delegación" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-tie"></span>
                        </div>
                        <input type="text" class="form-control" id="editarDelegado" name="editarDelegado"
                            placeholder="Escriba el nombre del delegado" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend input-group-text">
                            <span class="fas fa-phone-alt"></span>
                        </div>
                        <input type="text" class="form-control" id="editarTelefono" name="editarTelefono"
                            placeholder="Ingrese el número de la delegación" required
                            data-inputmask='"mask": "9999-9999"' data-mask>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        <input type="email" class="form-control" name="editarCorreo"
                            placeholder="Ingresa el correo de la delegación" required>
                    </div>

                    <!-- Input para el link de la cuenta de facebook -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary"><i class="fab fa-facebook"></i></span>
                        </div>
                        <input type="text" class="form-control" id="facebookDlgEditar" name="editarFacebook"
                            placeholder="Copie el link de la cuenta de Facebook">
                    </div>

                    <!-- Input para el link de la cuenta de instagram -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-danger"><i class="fab fa-instagram"></i></span>
                        </div>
                        <input type="text" class="form-control" id="instagramDlgEditar" name="editarInstagram"
                            placeholder="Copie el link de la cuenta de Instagram">
                    </div>

                    <!-- Input para el link de la cuenta de twitter -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-info"><i class="fab fa-twitter"></i></span>
                        </div>
                        <input type="text" class="form-control" id="twitterDlgEditar" name="editarTwitter"
                            placeholder="Copie el link de la cuenta de Twitter">
                    </div>

                    <div class="card rounded-lg card-secondary card-outline">
                        <div class="card-header pl-2 pl-sm-3">
                            <label>Escriba la dirección de la delegación:</label>
                        </div>

                        <div class="card-body">
                            <textarea id="editarDireccion" name="editarDireccion" class="form-control" rows="4"
                                style="width: 100%" required></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Adjunte una imagen de la delegación
                            <input type="file" class="form-control-file border" name="subirImagenEditarDelegacion">
                            <input type="hidden" id="rutaImagenNueva" name="rutaImagenNueva"></input>
                            <input type="hidden" name="imagenActual" id="imagenActual"></input>
                        </div>
                        <p class="help-block small">Peso Max. 5MB | Formato: JPG o PNG</p>
                        <img class="previsualizarDelegacionEditar img-fluid rounded-lg">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="btnCancelarEditarDelegacion">Cancelar</button>
                    </div>
                    <div>
                        <input type="hidden" name="tipo" value="editarDelegacion">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>