<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/urlamigable.controlador.php";
require_once "controladores/ruta.controlador.php";

require_once "controladores/banner.controlador.php";
require_once "modelos/banner.modelo.php";

require_once "controladores/noticias.inicio.controlador.php";
require_once "modelos/noticias.inicio.modelo.php";

require_once "controladores/noticia.controlador.php";
require_once "modelos/noticia.modelo.php";

require_once "controladores/noticias.sidebar.controlador.php";
require_once "modelos/noticias.sidebar.modelo.php";

require_once "controladores/estructura.controlador.php";
require_once "modelos/estructura.modelo.php";

require_once "controladores/noticias.PreaNext.controlador.php";
require_once "modelos/noticias.PreaNext.modelo.php";

require_once "controladores/videos.inicio.controlador.php";
require_once "modelos/videos.inicio.modelo.php";

require_once "controladores/documentos.sidebar.controlador.php";
require_once "modelos/documentos.sidebar.modelo.php";
require_once "controladores/live.controlador.php";
require_once "modelos/live.modelo.php";

require_once "controladores/radio.controlador.php";
require_once "modelos/radio.modelo.php";

require_once "controladores/date.controlador.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();