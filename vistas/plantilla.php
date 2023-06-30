<?php
$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();
$link = ControladorLink::ctrObtenerLink($this);
$baseLocal = "<base href='http://localhost/websitemefcca-mvc/vistas/'>";
$baseServidor = "<base href='https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/'>";
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>MEFCCA</title>

    <!-- Google Anlytics -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBVRSLFGZ7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GBVRSLFGZ7');
    </script>
    <!-- Fin Google Analytics -->


    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">

    <?php

    if (isset($_GET["pagina"])) {
        $noticiaSeleccionada = ControladorNoticiasInicio::ctrMostrarTodasNoticias();
        foreach ($noticiaSeleccionada as $key => $valueNoticia) {
            $rute = 'noticia-';
            $url = ControladorUrlAmigable::ctrUrlAmigable($valueNoticia['titulo']);
            $pagina = $rute . $url;

            $enlace = explode("/", $_GET["pagina"]);

            if ($enlace[0] == $pagina) {

                $id = explode("/", $_GET['pagina']);
                $noticia = ControladorNoticia::ctrMostrarNoticia($id[1]);

                $nd = ($noticia[0]['descripcion']);

                echo "<meta property='og:url' content='google.com'> \n";
                echo "<meta property='og:type' content='article'> \n";
                $titl = ($noticia[0]['titulo']);
                echo "<meta property='og:title' content=' $titl '> \n";
                $urlnot = ('https://www.economiafamiliar.gob.ni/backend/' . $noticia[0]['imagen_destacada']);
                echo "<meta property='og:image:width' content='1200'> \n";
                echo "<meta property='og:image:height' content='630'> \n";
                echo "<meta property='og:image' content='$urlnot'> \n";
                $des = " ";
                echo "<meta property='og:description' content='$des'>";

                echo "<meta name='twitter:site' content='@MEFCCANic'> \n";
                echo "<meta name='twitter:card' content='summary_large_image'> \n";
                echo "<meta name='twitter:title' content='$titl'> \n";
                echo "<meta name='twitter:image' content='$urlnot'> \n";
                echo "<meta name='twitter:description' content='$nd'>";
                echo "<meta name='twitter:image:width' content='630'>";
                echo "<meta name='twitter:image:height' content='354'>";
            };
        }
    }
    ?>

    <?php echo $baseServidor; ?>

    <link rel="icon" href="img/icono.png">

    <link rel="stylesheet" href="css/plugins/normalize.css">
    <link rel="stylesheet" href="css/plugins/pushbar.css">
    <link rel="stylesheet" href="css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="css/plugins/slick.css">
    <link rel="stylesheet" href="css/plugins/slick-theme.css">
    <link rel="stylesheet" href="css/plugins/lightbox.css">
    <link rel="stylesheet" href="css/plugins/all.min.css">
    <link rel="stylesheet" href="css/plugins/audioplayer.css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/main.css">

    <!-- Bootstrap 4.5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <meta name="theme-color" content="#fafafa">
</head>

<body>

    <section>
        <?php
        $transmision = '';
        date_default_timezone_set('America/Managua');
        $Date = date('Y-m-d');
        $Time = date('H:i:s', time());
        if ($link[2] == $Date) {
            if ($link[1] < $Time) {
                $transmision = '';
            } else if ($link[1] > $Time) {
                $transmision = $link[0];
            }
        } else {
            $transmision = '';
        }
        ?>

        <a href="<?php echo $transmision ?>" target="_blank" id='btn-envivo' class="btn-flotante">
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_ydojae2b.json" background="transparent" speed="2.5" style="width: 1800px; height: 1800px;" loop autoplay></lottie-player>
        </a>
    </section>


    <?php
    if (isset($_GET["pagina"])) {

        $pagina = explode("/", $_GET['pagina']);

        if ($_GET["pagina"] == "delegaciones") {
            include "paginas/delegaciones.php";

        }

        if ($_GET["pagina"] == "adelante") {
            include "paginas/adelante.php";

        }

        if ($pagina[0] == "proyecto") {
            include "paginas/proyecto.php";
        }

        if ($pagina[0] == "direccion") {
            include "paginas/direccion.php";
        }


        if ($pagina[0] == "programas") {
            include "paginas/programa_paginacion.php";
        }

        if ($pagina[0] == "programa") {
            include "paginas/programa.php";
        }

        if ($pagina[0] == "estrategias") {
            include "paginas/estrategias.php";
        }

        if ($pagina[0] == "entesDescentralizados") {
            include "paginas/entes.php";
        }

        if ($_GET["pagina"] == "convocatorias") {
            include "paginas/convocatorias.php";
        }

        if ($_GET["pagina"] == "notimefcca") {
            include "paginas/notimefcca.php";
        }

        if ($_GET["pagina"] == "juridico") {
            include "paginas/juridico.php";
        }

        if ($_GET["pagina"] == "mision") {
            include "paginas/mision.php";
        }

        if ($_GET["pagina"] == "boletin") {
            include "paginas/boletin.php";
        }

        if ($_GET["pagina"] == "anfef") {
            include "paginas/anfef.php";
        }

        if ($pagina[0] == "documentos") {
            include "paginas/documentos.php";
        }

        if ($pagina[0] == "videos") {
            include "paginas/videos.php";
        }

        if ($pagina[0] == "expo") {
            include "paginas/expo.php";
        }

	if ($pagina[0] == "expo22") {
            include "paginas/expo22.php";
        }

        if ($pagina[0] == "expo23") {
            include "paginas/expo23.php";
        }

        if ($pagina[0] == "flores") {
            include "paginas/flores.php";
        }

        if ($pagina[0] == "fuerzabendita") {
            include "paginas/fuerzabendita.php";
        }

        if ($pagina[0] == "expometal") {
            include "paginas/expometal.php";
        }

        if ($pagina[0] == "rutacreativa") {
            include "paginas/rutacreativa.php";
        }

        if ($pagina[0] == "inscripciones") {
            include "paginas/inscripciones.php";
        }

        if ($pagina[0] == "cdigitales") {
            include "paginas/cdigitales.php";
        }

        if ($pagina[0] == "agronegocios") {
            include "paginas/agronegocios.php";
        }

        if ($pagina[0] == "artesanias") {
            include "paginas/artesanias.php";
        }

        if ($pagina[0] == "juguetes") {
            include "paginas/juguetes.php";
        }

        if ($pagina[0] == "eco-madera") {
            include "paginas/eco-madera.php";
        }
        if ($pagina[0] == "acompanamientoDGAVC") {
            include "paginas/acompanamientoDGAVC.php";
        }

        $noticiaSeleccionada = ControladorNoticiasInicio::ctrMostrarTodasNoticias();
        foreach ($noticiaSeleccionada as $key => $valueNoticia) {
            $rute = 'noticia-';
            $url = ControladorUrlAmigable::ctrUrlAmigable($valueNoticia['titulo']);
            $pagina = $rute . $url;

            $enlace = explode("/", $_GET["pagina"]);

            if ($enlace[0] == $pagina) {
                include "paginas/noticia.php";
            }
        }
    } else {
        include "paginas/inicio.php";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/plugins/audioplayer.js"></script>
    <script src="js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="js/plugins/plugins.js"></script>
    <script src="js/plugins/lightbox.js"></script>
    <script src="js/plugins/youtube.js"></script>
    <script src="js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins/slick.js"></script>
    <script src="js/mapa.js"></script>
    <script src="js/mapaa.js"></script>




    <script src="/websitemefcca-mvc/vistas/js/plugins/barraPaginacion.js"></script>
    <script src="/websitemefcca-mvc/vistas/js/plugins/shuffle.js"></script>
    <script src="/websitemefcca-mvc/vistas/js/paginacion.js"></script>

    <script src="https://www.youtube.com/iframe_api"></script>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.js" integrity="sha256-ytBPHlXtZUPR29lnLm6p+dZYwAU+g0XpyMsWD4i0lH4=" crossorigin="anonymous"></script>
    <script src="/websitemefcca-mvc/vistas/js/buzon.js"></script>

    <link rel="stylesheet" href="css/plugins/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- ENVIVO -->
    <script src="/websitemefcca-mvc/vistas/js/envivo.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.slider').slick({
                dots: true,
                autoplay: true,
                arrows: false,
                slidesToScroll: 1,
                autoplaySpeed: 3000,
                fade: true
            });
        });
    </script>
    <script src="js/plugins/pushbar.js"></script>
    <script>
        var pushbar = new Pushbar({
            blur: true,
            overlay: true
        });
    </script>
    <script src="js/main.js"></script>

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(["_setAccount", "UA-36251023-1"]);
        _gaq.push(["_setDomainName", "jqueryscript.net"]);
        _gaq.push(["_trackPageview"]);

        (function() {
            var ga = document.createElement("script");
            ga.type = "text/javascript";
            ga.async = true;
            ga.src =
                ("https:" == document.location.protocol ?
                    "https://ssl" :
                    "http://www") + ".google-analytics.com/ga.js";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>

</html>
