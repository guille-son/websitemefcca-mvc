<?php
    include 'modulos/header.php';

    $id = explode("/", $_GET['pagina']);
    $id_position = sizeof($id) - 1;
    $direccionEstu = ControladorEstructura::ctrMostrarEstructura($id[$id_position]);
    $documentosSideBar = ControladorDocumentosSideBar::ctrSideDocumentosEstructura($id[$id_position]);
    $sizeDocEstruct = ControladorDocumentosSideBar::ctrTotalDocumentosEstructura($id[$id_position]);
?>

<main class="seccion_direccion seccion contenedor">
    <div class="centrar_boton_seccion padding_boton_seccion">
        <div>
            <a href="<?php echo $ruta; ?>programas" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i> Programas</a>
        </div>
    </div>

    <div class="encabezado_direccion">
        <h2><?php echo $direccionEstu[0]['titulo'];?></h2>
    </div>

    <div class="contenedor_direccion clearfix">
        <div class="direccion_principal">
            <div class="texto"><?php echo $direccionEstu[0]['descripcion'];?></div>
        </div>

        <div class="sidebar_direcciones">

            <?php if( sizeof($sizeDocEstruct) > 2 ){ ?>
                <div class="centrar_boton_seccion padding_boton_seccion">
                    <div>
                        <a href="<?php echo $ruta; ?>estrategias/<?php echo $id[$id_position] ?>"
                            class="boton btn_estilo_uno">Ver más estrategias <i class="fas fa-arrow-right icono_boton"></i></a>
                    </div>
                </div>
            <?php } ?>

            <div class="contenedor_documentos clearfix">

                <?php foreach ($documentosSideBar as $key => $data) : ?>

                    <div class="documento">
                        <a href="<?php echo $servidor . $data['archivo'] ?>" target="_blank">
                            <img src="<?php echo $servidor . $data['imagen_documento'] ?>" alt="<?php $data['titulo_documento'] ?>">
                            <div class="contenido_documento">
                                <h2 class="limitar_tres_lineas"><?php echo $data['titulo_documento'] ?></h2>
                                <p class="limitar_dos_lineas"><?php echo $data['descrip_documento'] ?></p>
                            </div>
                        </a>
                    </div>

                <?php endforeach ?>

            </div>

        </div>
    </div>
</main>

<script>
document.title = '<?php echo $direccionEstu[0]['titulo']; ?>';
</script>

<?php
    include 'modulos/footer.php';
?>