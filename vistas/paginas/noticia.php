  <?php
  include 'modulos/header.php';

  $id = explode("/", $_GET['pagina']);
  $noticia = ControladorNoticia::ctrMostrarNoticia($id[1]);
  $galeria = json_decode($noticia[0]['galeria'], true);

  $noticiaSidebar = ControladorNoticiasSidebar::ctrMostrarNoticiasSidebar($id[1]);
  $tipo = "noticia-";
  $pleca = "/";

  $leftSign = "<";
  $rightSign = ">";
  $siguiente = ControladorPreaNextNoticias::NoticiaPreaNextId($id[1], $rightSign);
  $anterior = ControladorPreaNextNoticias::NoticiaPreaNextIdPrevious($id[1], $leftSign);

  $rutaImg = "../../../backend/"

  ?>

  <main class="seccion_noticia seccion contenedor">
    <div class="centrar_boton_seccion padding_boton_seccion">
      <div>
        <a href="<?php echo $ruta; ?>notimefcca" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i> NotiMefcca</a>
      </div>
    </div>

    <div class="encabezado_noticia">
      <h2><?php echo $noticia[0]["titulo"]; ?></h2>
      <div class="contenido_encabezado_noticia">
        <nav class="redes_sociales">
          <a href="" class="facebook" id="compartirFacebook" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
          <a href="" class="whatsapp" id="compartirWhatsapp" target="_blank"><i class="fab fa-whatsapp" aria-hidden="false"></i></a>
          <a href="" class="twitter" id="compartirTwitter" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
        </nav>
        <div class="lista_detalle_noticia">
          <p><i class="far fa-calendar" aria-hidden="true"></i> <span><?php echo $noticia[0]["fecha"]; ?></span></p>
          <p><i class="far fa-clock" aria-hidden="true"></i> <span><?php echo $noticia[0]["hora"]; ?></span></p>
          <p><i class="far fa-user" aria-hidden="true"></i> <span><?php echo $noticia[0]["nombre_completo"]; ?></span></p>
        </div>
      </div>
    </div>

    <div class="contenedor_noticia clearfix">
      <div class="noticia_principal">
        <div class="imagen_destacada">

          <?php if ($noticia[0]["imagen_destacada"] != null) { ?>
            <img src="<?php echo $servidor . $noticia[0]["imagen_destacada"]; ?>" alt="Imagen Destacada">
          <?php } else { ?>
            <img src="<?php echo $servidor . 'vistas/img/error404.jpg' ?>" alt="Imagen Destacada">
          <?php } ?>

        </div>
        <div class="texto"><?php echo $noticia[0]["descripcion"]; ?></div>
            
        <div class="galeria">
          <div class="will-scale-slider">
            <section class="lazy slider2">

              <?php if ($noticia[0]['galeria'] != null) { ?>

                <?php foreach ($galeria as $key => $valueGaleria) : ?>
                  <a href="<?php echo $servidor . $valueGaleria; ?>" data-lightbox="galeria">
                    <img class="imagen" src="<?php echo $servidor . $valueGaleria; ?>" alt="Imagen Galeria">
                  </a>
              <?php endforeach;
              } ?>

            </section>
          </div>
        </div>

        <div class="botones_sig_ant">
          <?php
          if ($anterior != null) { ?>
            <?php $url2 = ControladorUrlAmigable::ctrUrlAmigable($anterior['titulo']); ?>
            <a href="<?php echo $ruta . $tipo . $url2 . $pleca . $anterior[0]; ?>" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i> <span>Anterior</span></a>
          <?php } ?>

          <?php
          if ($siguiente != null) { ?>
            <?php $url3 = ControladorUrlAmigable::ctrUrlAmigable($siguiente['titulo']); ?>
            <a href="<?php echo $ruta . $tipo . $url3 . $pleca . $siguiente[0] ?>" class="boton btn_estilo_uno"><span>Siguiente</span> <i class="fas fa-arrow-right icono_boton"></i></a>
          <?php } ?>

        </div>
      </div>

      <div class="sidebar_noticias">
        <?php foreach ($noticiaSidebar as $key => $valueSidebar) : ?>
          <?php $url = ControladorUrlAmigable::ctrUrlAmigable($valueSidebar['titulo']); ?>
          <?php $id = $valueSidebar['id']; ?>
          <div class="noticia">
            <img src="<?php echo $servidor . $valueSidebar['imagen_noticia']; ?>" alt="Imagen Noticia 1">
            <div class="contenido_noticia">
              <div class="encabezado_noticia">
                <h2 class="limitar_tres_lineas"><?php echo $valueSidebar['titulo']; ?></h2>
                <div class="lista_detalle_noticia">
                  <p><i class="far fa-calendar" aria-hidden="true"></i> <span><?php echo $valueSidebar['fecha']; ?></span></p>
                  <p><i class="far fa-clock" aria-hidden="true"></i> <span><?php echo $valueSidebar['hora']; ?></span></p>
                  <p><i class="far fa-user" aria-hidden="true"></i> <span><?php echo $valueSidebar['nombre_completo'] ?></span></p>
                </div>
              </div>
              <p class="limitar_dos_lineas"><?php echo $valueSidebar['descripcion_corta']; ?></p>
              <div class="pie_noticia">
                <nav class="redes_sociales">

                  <?php $url = ControladorUrlAmigable::ctrUrlAmigable($valueSidebar['titulo']); ?>
                        
                  <a href="<?php echo 'https://www.facebook.com/share.php?u=' . $ruta . $tipo . $url . $pleca . $valueSidebar['id']?>"  target="_blank" class="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                  <a href="<?php echo 'https://web.whatsapp.com/send?text=' . $ruta . $tipo . $url . $pleca . $valueSidebar['id']?>"  target="_blank" class="whatsapp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                  <a href="<?php echo 'https://twitter.com/share?url=' . $ruta . $tipo . $url . $pleca . $valueSidebar['id']?>"  target="_blank" class="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                </nav>
                <a href="<?php echo $ruta . $tipo . $url . $pleca . $id; ?>" class="boton btn_estilo_dos">Ver más <i class="fas fa-arrow-right icono_arrow icono_boton"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </main>

  <script>
      document.title = '<?php echo $noticia[0]["titulo"]; ?>';
  
      let ttl = window.document.title;
      let urlac = window.document.URL;
      let sharefb = 'http://www.facebook.com/share.php?src=sp&u=';
      let dc = '<?php echo $valueSidebar["descripcion_corta"]; ?>';
      let go = 'google.com';
      let dir2= urlac;
      document.getElementById("compartirFacebook").href = sharefb+dir2;

      let sharetw = 'http://twitter.com/share?=';
      let texttw = 'text='+ttl;
      document.getElementById("compartirTwitter").href = sharetw+texttw+'&url='+dir2;

      let sharewh = 'https://web.whatsapp.com/send?text=';
      document.getElementById("compartirWhatsapp").href = sharewh+urlac;

  </script>

  <?php
  include 'modulos/footer.php';
  ?>