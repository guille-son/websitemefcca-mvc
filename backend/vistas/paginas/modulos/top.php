<?php

// ====================================================== //
// ======== CONTAR TODAS LAS NOTICIAS PUBLICADAS ======== //
// ====================================================== //
$contarNoticias = ControladorNoticias::ctrMostrarNoticias(null, null);

// ====================================================== //
// ========= CONTAR TODOS LOS VIDEOS PUBLICADOS ========= //
// ====================================================== //
$contarVideos = ControladorVideos::ctrMostrarVideos(null, null);

// ====================================================== //
// ======= CONTAR TODOS LOS DOCUMENTOS PUBLICADOS ======= //
// ====================================================== //
$contarDocumentos = ControladorDocumentos::ctrMostrarDocumentos(null, null);

?>

<!--=====================================
Total Noticias
======================================-->
<div class="col-12 col-sm-6 col-lg-3">

    <div class="small-box bg-primary">

        <div class="inner">

            <h3><?php echo count($contarNoticias); ?></h3>

            <p class="text-uppercase">Noticias</p>

        </div>

        <div class="icon">

            <i class="fas fa-newspaper"></i>

        </div>

        <a href="noticias" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<!--=====================================
Total Videos
======================================-->
<div class="col-12 col-sm-6 col-lg-3">

  <div class="small-box bg-danger">

    <div class="inner">

      <h3><?php echo count($contarVideos); ?></h3>

      <p class="text-uppercase">Videos</p>

    </div>

    <div class="icon">

      <i class="fab fa-youtube"></i>

    </div>

    <a href="videos" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div>

<!--=====================================
Total Documentos
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

  <div class="small-box bg-secondary">

    <div class="inner">

      <h3><?php echo count($contarDocumentos); ?></h3>

      <p class="text-uppercase">Documentos</p>

    </div>

    <div class="icon">

      <i class="fas fa-file-alt"></i>

    </div>

    <a href="document" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

  </div>

</div> 