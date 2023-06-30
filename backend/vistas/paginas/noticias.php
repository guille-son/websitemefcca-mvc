<div class="content-wrapper" style="min-height: 1148.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="pantalla">Noticias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Noticias</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- Listado de noticias -->
                <div class="col-12 col-xl-5">

                    <div class="card card-primary card-outline">

                        <div class="card-header pl-2 pl-sm-3">

                            <a href="noticias" id="crearNuevaNoticia" class="btn btn-primary btn-sm">Crear nueva noticia</a>

                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tablaNoticias" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th style="width:120px">Estructura</th>
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

                    if(isset($_GET["idNoticia"])){

                        $noticia = ControladorNoticias::ctrMostrarNoticias($_GET["idNoticia"]);

                    } else {

                        $noticia = null;

                    }

                ?>

                <!-- Editor de noticias -->
                <div class="col-12 col-xl-7">

                    <div class="card card-primary card-outline">

                        <div class="card-header">

                            <h5 class="card-title">Noticia</h5>

                            <div class="preload"></div>

                            <div class="card-tools">

                                <button type="button" class="btn btn-info btn-sm guardarNoticia">
                                    <i class="fas fa-save"></i>
                                </button>

                                <?php

                                    if($noticia != null) {

                                        $rutasGaleria = json_decode($noticia["galeria"], true);

                                        echo '

                                            <button type="button" class="btn btn-danger btn-sm eliminarNoticia" id-noticia="'.$noticia["id"].'" galeria-noticia="'.implode(",", $rutasGaleria).'" ruta-imagen-principal="'.$noticia["imagen_destacada"].'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        
                                        ';

                                    }

                                ?>

                            </div>

                        </div>

                        <div class="card-body">

                            <input type="hidden" class="idNoticia" value="<?php echo $noticia["id"]; ?>">

                            <div class="form-group">

                                <label>Elije la Estructura:</label>

                                <?php

                                    if($noticia != null){

                                        echo '<select class="form-control select2 select2-hidden-accessible seleccionarEstructura" style="width: 100%" readonly>
                                        
                                            <option value="'.$noticia["id_estructura"].'">'.$noticia["estructura"].'</option>
                                        
                                        </select>';

                                    } else {

                                        echo '<select class="form-control select2 select2-hidden-accessible seleccionarEstructura" style="width: 100%">

                                            <option value="default">Seleccione</option>';

                                            $estructura = ControladorEstructura::ctrMostrarEstructura(null, null);

                                            foreach ($estructura as $key => $valueEstructura) {
                                                echo '<option value="'.$valueEstructura["id"].'">'.$valueEstructura["titulo"].'</option>';
                                            }

                                        echo '</select>';

                                    }

                                ?>

                            </div>

                            <div class="form-group">

                                <label>Escriba el titulo de la noticia:</label>

                                <?php

                                    if($noticia != null) {

                                        echo '<input type="text" class="form-control seleccionarTitulo" value="'.$noticia["titulo"].'">';

                                    } else {

                                        echo '<input type="text" class="form-control seleccionarTitulo" required>';

                                    }

                                ?>

                            </div>

                            <div class="form-group my-2">

                                <?php

                                    if($noticia != null){

                                        echo '
                                        
                                            <div class="btn btn-default btn-file mb-2">

                                                <i class="fas fa-paperclip"></i> Adjunte la imagen principal
            
                                                <input type="file" class="form-control-file border" name="subirImgNoticia" required>

                                                <input type="hidden" id="imagenNueva"></input>

                                                <input type="hidden" class="extensionImagen"></input>

                                                <input type="hidden" name="imagenDestacadaActual" id="imagenDestacadaActual" value="'.$noticia["imagen_destacada"].'"></input>
            
                                            </div>
            
                                            <img class="previsualizarImgNoticia img-fluid rounded-lg" src="'.$rutaServidor.$noticia["imagen_destacada"].'">

                                        
                                        ';

                                    } else {

                                        echo '
                                        
                                            <div class="btn btn-default btn-file mb-2">

                                                <i class="fas fa-paperclip"></i> Adjunte la imagen principal
            
                                                <input type="file" class="form-control-file border" name="subirImgNoticia" required>

                                                <input type="hidden" id="rutaImagenDestacada"></input>

                                                <input type="hidden" class="extensionImagen"></input>
            
                                            </div>
            
                                            <img class="previsualizarImgNoticia img-fluid rounded-lg">
                                        
                                        ';

                                    }

                                ?>

                                <p class="help-block small">Peso Max. 5MB | Formato: JPG o PNG</p>

                            </div>

                            <!-- Input para el link de la publicacion de facebook -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary"><i class="fab fa-facebook"></i></span>
                                </div>

                                <?php

                                    if($noticia != null){

                                        echo '<input type="text" class="form-control seleccionarLinkFace" value="'.$noticia["facebook"].'">';


                                    } else {

                                        echo '<input type="text" class="form-control seleccionarLinkFace" placeholder="Copie el link de Facebook">';

                                    }

                                ?>

                            </div>

                            <!-- Input para el link de la publicacion de instagram -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger"><i class="fab fa-instagram"></i></span>
                                </div>

                                <?php

                                    if($noticia != null){

                                        echo '<input type="text" class="form-control seleccionarLinkInsta" value="'.$noticia["instagram"].'">';


                                    } else {

                                        echo '<input type="text" class="form-control seleccionarLinkInsta" placeholder="Copie el link de Instagram">';

                                    }

                                ?>

                            </div>

                            <!-- Input para el link de la publicacion de twitter -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info"><i class="fab fa-twitter"></i></span>
                                </div>

                                <?php

                                    if($noticia != null){

                                        echo '<input type="text" class="form-control seleccionarLinkTwi" value="'.$noticia["twitter"].'">';


                                    } else {

                                        echo '<input type="text" class="form-control seleccionarLinkTwi" placeholder="Copie el link de Twitter">';

                                    }

                                ?>

                            </div>

                            <!-- Editor para la descripcion de la noticia -->

                            <div class="card rounded-lg card-secondary card-outline">

                                <div class="card-header pl-2 pl-sm-3">

                                    <label>Escriba la descripción de la noticia:</label>

                                </div>

                                <div class="card-body">

                                    <?php

                                        if($noticia != null){

                                            echo '<textarea id="descripcionNoticia" name="descripcionNoticia" style="width: 100%">'.$noticia["descripcion"].'</textarea>';


                                        } else {

                                            echo '<textarea id="descripcionNoticia" name="descripcionNoticia" style="width: 100%"></textarea>';

                                        }

                                    ?>

                                </div>

                            </div>

                            <!-- Descripcion corta de la noticia -->

                            <div class="card rounded-lg card-secondary card-outline">

                                <div class="card-header pl-2 pl-sm-3">

                                    <label>Escriba una descripción corta para la noticia:</label>

                                </div>

                                <div class="card-body">

                                    <?php

                                        if($noticia != null){

                                            echo '<textarea id="descripcionCortaNoticia" name="descripcionCortaNoticia" class="form-control" rows="4" style="width: 100%">'.$noticia["descrip_corta"].'</textarea>';


                                        } else {

                                            echo '<textarea id="descripcionCortaNoticia" name="descripcionCortaNoticia" class="form-control" rows="4" style="width: 100%"></textarea>';

                                        }

                                    ?>

                                </div>

                            </div>

                            <div class="card rounded-lg card-secondary card-outline">

                                <div class="card-header pl-2 pl-sm-3">

                                    <label>Galería:</label>

                                </div>

                                <div class="card-body">

                                    <ul class="row p-0 vistaGaleria">

                                        <?php

                                            if($noticia != null) {

                                                $galeria = json_decode($noticia["galeria"], true);

                                                foreach($galeria as $key => $valueGaleria) {

                                                    echo '
                                                    
                                                        <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">

                                                            <img class="rounded-lg card-img-top" src="'.$rutaServidor.$valueGaleria.'">
                
                                                            <div class="card-img-overlay p-0 pr-3">
                
                                                                <button
                                                                    class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua"
                                                                    temporal="'.$valueGaleria.'">
                
                                                                    <i class="fas fa-times"></i>
                
                                                                </button>
                
                                                            </div>
                
                                                        </li>
                                                    
                                                    ';

                                                }

                                            }

                                        ?>

                                    </ul>

                                </div>

                                <input type="hidden" class="inputNuevaGaleria">

                                <input type="hidden" class="inputAntiguaGaleria" value="<?php echo implode(",", $galeria); ?>">

                                <div class="card-footer">

                                    <input type="file" multiple id="galeria" class="d-none">

                                    <label for="galeria" class="text-dark text-center py-5 border rounded bg-white w-100 subirGaleria efectoHover">

                                        Haz clic aquí o arrastra las imágenes <br>
                                        <span class="help-block small">Peso Max. 5MB | Formato: JPG</span>

                                    </label>

                                </div>

                            </div>

                        </div>

                        <!-- footer-card -->

                        <div class="card-footer">

                            <div class="card-tools float-right">

                                <?php

                                    if($noticia != null){

                                        echo '<input type="hidden" class="tipo" value="editarNoticia">';


                                    } else {

                                        echo '<input type="hidden" class="tipo" value="registroNoticia">';

                                    }

                                ?>

                                <button type="button" class="btn btn-info btn-sm guardarNoticia">
                                    <i class="fas fa-save"></i>
                                </button>

                                <?php

                                    if($noticia != null) {

                                        $rutasGaleria = json_decode($noticia["galeria"], true);

                                        echo '

                                            <button type="button" class="btn btn-danger btn-sm eliminarNoticia" id-noticia="'.$noticia["id"].'" galeria-noticia="'.implode(",", $rutasGaleria).'" ruta-imagen-principal="'.$noticia["imagen_destacada"].'">
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
