<?php

class ControladorDate
{
    /*====================================================
            MOSTRAR LA NOTICIA SELECCIONADA
    =====================================================*/

    static public function obtenerFechaEnLetra($fecha)
    {
        $dia = ControladorDate::conocerDiaSemanaFecha($fecha);
        $num = date("j", strtotime($fecha));
        /* $anno = date("Y", strtotime($fecha)); */
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        return $dia . ', ' . $num . ' de ' . $mes /*. ' del '  . $anno */;
    }

    static public function conocerDiaSemanaFecha($fecha)
    {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }
}
