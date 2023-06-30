<?php
if ($usuarioIngreso['rol'] != 'Super Administrador') {
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
                    <h1 id="pantalla">Estructura</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Estructura</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- Tabla estructura -->
                <div class="col-12 col-xl-5">

                    <div class="card card-primary card-outline">

                        <div class="card-header pl-2 pl-sm-3">

                            <a href="estructura" class="btn btn-primary btn-sm">Crear nueva
                                estructura</a>

                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tablaEstructura" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th style="width:120px">Categoria</th>
                                        <th>Titulo</th>
                                        <th style="width:100px">Acciones</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <?php

                if (isset($_GET["idEstructura"])) {

                    $estructura = ControladorEstructura::ctrMostrarEstructura("id", $_GET["idEstructura"]);
                } else {

                    $estructura = null;
                }

                ?>

                <!-- Editor de estructura -->
                <div class="col-12 col-xl-7">

                    <div class="card card-primary card-outline">

                        <div class="card-header">

                            <h5 class="card-title">Estructura</h5>

                            <div class="preload"></div>

                            <div class="card-tools">

                                <button type="button" class="btn btn-info btn-sm guardarEstructura">
                                    <i class="fas fa-save"></i>
                                </button>

                                <?php

                                if ($estructura != null) {

                                    echo '

                                                <button type="button" class="btn btn-danger btn-sm eliminarEstructura" id-estructura="' . $estructura["id"] . '" ruta-imagen="' . $estructura["imagen"] . '">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            
                                            ';
                                }

                                ?>

                            </div>

                        </div>

                        <div class="card-body">

                            <input type="hidden" class="idEstructura" value="<?php echo $estructura["id"]; ?>">

                            <div class="form-group">

                                <label>Elije la Categoriad:</label>

                                <?php

                                if ($estructura != null) {

                                    echo '<select class="form-control select2 select2-hidden-accessible seleccionarCatalogo" style="width: 100%" readonly aria-hidden="true">
                                            
                                                <option value="' . $estructura["id_catalogo"] . ',' . $estructura["catalogo"] . '">' . $estructura["catalogo"] . '</option>
                                            
                                            </select>';
                                } else {

                                    echo '<select class="form-control select2 select2-hidden-accessible seleccionarCatalogo" style="width: 100%" aria-hidden="true">

                                                <option value="default">Seleccione</option>';

                                    $catalogo = ControladorCatalogo::ctrMostrarCatalogoPorCodigo("ESTR");

                                    foreach ($catalogo as $key => $valueCatalogo) {
                                        echo '<option value="' . $valueCatalogo["id"] . ',' . $valueCatalogo["catalogo"] . '">' . $valueCatalogo["catalogo"] . '</option>';
                                    }

                                    echo '</select>';
                                }

                                ?>

                            </div>

                            <div class="form-group">

                                <label>Escriba el titulo de la estructura:</label>

                                <?php

                                if ($estructura != null) {

                                    echo '<input type="text" class="form-control seleccionarTitulo" value="' . $estructura["titulo"] . '">';
                                } else {

                                    echo '<input type="text" class="form-control seleccionarTitulo" required>';
                                }

                                ?>

                            </div>

                            <div class="form-group my-2">

                                <?php

                                if ($estructura != null) {

                                    echo '
                                            
                                                <div class="btn btn-default btn-file mb-2">

                                                    <i class="fas fa-paperclip"></i> Adjunte una imagen

                                                    <input type="file" class="form-control-file border" name="subirImgEstructura" required>

                                                    <input type="hidden" id="imagenNueva"></input>

                                                    <input type="hidden" name="imagenActual" id="imagenActual" value="' . $estructura["imagen"] . '"></input>
                                                    
                                                    <input type="hidden" class="extensionImagen"></input>

                                                </div>

                                                <img class="previsualizarImgEstructura img-fluid rounded-lg" src="' . $rutaServidor . $estructura["imagen"] . '">

                                            
                                            ';
                                } else {

                                    echo '
                                            
                                                <div class="btn btn-default btn-file mb-2">

                                                    <i class="fas fa-paperclip"></i> Adjunte la imagen

                                                    <input type="file" class="form-control-file border" name="subirImgEstructura" required>

                                                    <input type="hidden" id="rutaImagen"></input>

                                                    <input type="hidden" class="extensionImagen"></input>

                                                </div>

                                                <img class="previsualizarImgEstructura img-fluid rounded-lg">
                                            
                                            ';
                                }

                                ?>

                                <p class="help-block small">Peso Max. 5MB | Formato: JPG o PNG</p>

                            </div>

                            <!-- Editor para la descripcion de la Estructura -->

                            <div class="card rounded-lg card-secondary card-outline">

                                <div class="card-header pl-2 pl-sm-3">

                                    <label>Escriba la descripción de la estructura:</label>

                                </div>

                                <div class="card-body">

                                    <?php

                                    if ($estructura != null) {

                                        echo '<textarea id="descripcionEstructura" name="descripcionEstructura" style="width: 100%">' . $estructura["descripcion"] . '</textarea>';
                                    } else {

                                        echo '<textarea id="descripcionEstructura" name="descripcionEstructura" style="width: 100%"></textarea>';
                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                        <!-- footer-card -->

                        <div class="card-footer">

                            <div class="card-tools float-right">

                                <?php

                                if ($estructura != null) {

                                    echo '<input type="hidden" class="tipo" value="editarEstructura">';
                                } else {

                                    echo '<input type="hidden" class="tipo" value="registroEstructura">';
                                }

                                ?>

                                <button type="button" class="btn btn-info btn-sm guardarEstructura">
                                    <i class="fas fa-save"></i>
                                </button>

                                <?php

                                if ($estructura != null) {

                                    echo '

                                                <button type="button" class="btn btn-danger btn-sm eliminarEstructura" id-estructura="' . $estructura["id"] . '" ruta-imagen="' . $estructura["imagen"] . '">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            
                                            ';
                                }

                                ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- /.content -->
</div>