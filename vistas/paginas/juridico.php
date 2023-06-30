<?php include 'modulos/header.php'; ?>

<?php 
    $noticiasInicio = ControladorNoticiasInicio::ctrMostrarNoticiasJuridico(); 
    $noticia = "noticia-";
    $pleca = "/";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="seccion padding_boton_seccion contenedor contenido_encabezado_corto p-movil">
        <div class='centrar_boton_seccion padding_boton_seccion'>
            <a href="<?php echo $ruta; ?>" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i> Inicio</a>
        </div>
    </div>

    <section class="contenedor">
        <div class="contenedor_noticia clearfix contenedor contenido_encabezado_corto seccion ct-mj">
            <div class="noticia_principal padding_boton_seccion ">
                <h2 class="encabezado_marco_juridico">Marco Jurídico</h2>
                <p class='pagn'>El Marco Jurídico o marco legal del Ministerio de Economía Familiar,
                    Comunitaria, Cooperativa y Asociativa es el conjunto de Leyes,
                    Decretos Ejecutivos, Decretos Legislativos, Resoluciones y
                    Acuerdos Ministeriales que regulan el funcionamiento institucional,
                    en el que se establecen y concentran políticas, planes, programas
                    y acciones dirigidas a atender y acompañar las actividades productivas
                    de la economía familiar y comunitaria, involucrando todas las formas de
                    emprendimientos y pequeños negocios del campo y la ciudad, la transferencia
                    de nuevas tecnologías y mejores prácticas productivas para mejorar los
                    niveles de producción, rendimientos agropecuarios, productividad, ingresos
                    y el nivel de vida de las familias y las comunidades, contribuyendo a la
                    defensa de la seguridad y soberanía alimentaria y la protección contra los
                    impactos del cambio climático.</p>
            </div>

            <div class="sidebar_noticias marco_juridico">
                <div class="centrar_boton_seccion padding_boton_seccion">
                    <a href="<?php echo $ruta; ?>notimefcca" class="boton btn_estilo_uno">NotiMefcca <i class="fas fa-arrow-right icono_boton"></i></a>
                </div>

                <ul class="lista_personalizada contenedor_notimefcca clearfix">
                    <?php foreach ($noticiasInicio as $key => $valueNoticia) : ?>
                    <?php $url = ControladorUrlAmigable::ctrUrlAmigable($valueNoticia['titulo']); ?>
                    <?php $id = $valueNoticia['id']; ?>
                    <li class="noticia">
                        <img src="<?php echo $servidor.$valueNoticia['imagen_noticia']; ?>" alt="Imagen Noticia">
                        <div class="contenido_noticia">
                            <div class="encabezado_noticia">
                                <h2 class="limitar_tres_lineas"><?php echo $valueNoticia['titulo']; ?></h2>
                                <div class="lista_detalle_noticia">
                                    <p><i class="far fa-calendar" aria-hidden="true"></i>
                                        <span><?php echo $valueNoticia['fecha']; ?></span>
                                    </p>
                                    <p><i class="far fa-clock" aria-hidden="true"></i>
                                        <span><?php echo $valueNoticia['hora']; ?></span>
                                    </p>
                                    <p><i class="far fa-user" aria-hidden="true"></i>
                                        <span><?php echo $valueNoticia['nombre_completo'] ?></span>
                                    </p>
                                </div>
                            </div>
                            <p class="limitar_dos_lineas"><?php echo $valueNoticia['descripcion_corta']; ?></p>
                            <div class="pie_noticia">
                                <nav class="redes_sociales">
                                    <a href="<?php echo $valueNoticia['facebook']; ?>" target="_blank"
                                        class="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    <a href="<?php echo $valueNoticia['instagram']; ?>" target="_blank"
                                        class="instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    <a href="<?php echo $valueNoticia['twitter']; ?>" target="_blank" class="twitter"><i
                                            class="fab fa-twitter" aria-hidden="true"></i></a>
                                </nav>
                                <a href="<?php echo $ruta.$noticia.$url.$pleca.$id; ?>" class="boton btn_estilo_dos">Ver
                                    mas <i class="fas fa-arrow-right icono_arrow icono_boton"></i></a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>


</body>

<script>
document.title = 'Marco Jurídico';
</script>

</html>

<?php include 'modulos/footer.php'; ?>