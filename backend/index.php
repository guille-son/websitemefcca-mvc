<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";

require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";

require_once "controladores/rol.controlador.php";
require_once "modelos/rol.modelo.php";

require_once "controladores/estructura.controlador.php";
require_once "modelos/estructura.modelo.php";

require_once "controladores/noticias.controlador.php";
require_once "modelos/noticias.modelo.php";

require_once "controladores/catalogo.controlador.php";
require_once "modelos/catalogo.modelo.php";

require_once "controladores/documentos.controlador.php";
require_once "modelos/documentos.modelo.php";

require_once "controladores/videos.controlador.php";
require_once "modelos/videos.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();