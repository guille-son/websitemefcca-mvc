<?php
require_once "conexion.php";

Class ModeloProgramasEmblematicos{
    /*====================================================
            MOSTRAR NOTIMEFCCA
    =====================================================*/

    static public function mdlCargaProgramas($paginaActual,$pageSize,$titulo) {
        require_once "../controladores/ruta.controlador.php";

        $paginaPosicion = $paginaActual * $pageSize;
        $servidor = ControladorRuta::ctrServidor();
        $ruta = ControladorRuta::ctrRuta();
        $likeMatch = "'%" . $titulo . "%'";

        try {
            $statementNoticia = Conexion::conectar()->prepare("SELECT
            ie.id as id,
            ie.titulo as titulo,
            ie.imagen as imagen,
            ie.descripcion as descripcion
            FROM informacion_estructura ie
            INNER JOIN catalogo cat
            ON cat.id = ie.estructura_id
            WHERE
            ie.pasivo = 0
            AND cat.descripcion = 'Programas Emblemáticos'
            AND ie.titulo LIKE $likeMatch
            ORDER BY ie.id DESC;");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementNoticia->execute();
        $programas = $statementNoticia->fetchAll();

        $liElements = [];

        for($i=0; $i < $pageSize; $i++){
            if( array_key_exists($paginaPosicion,$programas) ){

                $descripcion = strip_tags($programas[$paginaPosicion]['descripcion']);
                $direccion = ModeloProgramasEmblematicos::mdlGetDireccionHref($programas[$paginaPosicion]['titulo'],$programas[$paginaPosicion]['id']);
            
                $htmlCode = '
                <li class="noticia temporal">
                    <img src="' . $servidor . $programas[$paginaPosicion]['imagen'] . '" alt="Imagen programa">
                    <div class="contenido_noticia">
                        <div class="encabezado_noticia">
                            <h2 class="limitar_tres_lineas">' . $programas[$paginaPosicion]['titulo'] . '</h2>
                        </div>
                        <p class="limitar_dos_lineas">' . $descripcion . '</p>
                        <div class="pie_noticia">
                            <a href="' . $direccion . '" class="boton btn_estilo_dos">Ver mas <i
                                    class="fas fa-arrow-right icono_arrow icono_boton"></i></a>
                        </div>
                    </div>
                </li>';

                $paginaPosicion++;
                $liElements[$i] = $htmlCode;
            }else{
                break;
            }
        }

        return json_encode($liElements);
    }

    /* Carga de solo los ID para la gestion de la paginacion */
    static public function mdlNumProgramas($tituloMatch){
        $likeMatch = "'%" . $tituloMatch . "%'";

        try {
            $statementId = Conexion::conectar()->prepare("SELECT
            ie.id
            FROM informacion_estructura ie
            INNER JOIN catalogo cat
            ON cat.id = ie.estructura_id
            WHERE
            ie.pasivo = 0
            AND cat.descripcion = 'Programas Emblemáticos'
            AND ie.titulo LIKE $likeMatch
            ORDER BY ie.id DESC;");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    
        $statementId->execute();
    
        $programasId = $statementId->fetchAll();
    
        return json_encode(sizeof($programasId));
    }

    static public function mdlGetDireccionHref($tituloPrograma,$idPrograma){
        require_once "../controladores/ruta.controlador.php";
        require_once "../controladores/urlamigable.controlador.php";

        $ruta = ControladorRuta::ctrRuta();
        $url = ControladorUrlAmigable::ctrUrlAmigable($tituloPrograma);
        $programa = "programa-";
        $progra = "programa/";
        $pleca = "/";
        $id = $idPrograma;
        
        $direccion = $ruta.$progra.$programa.$url.$pleca.$id;

        return $direccion;
    }
}

?>