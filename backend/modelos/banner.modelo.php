<?php

require_once "conexion.php";

class ModeloBanner {
    /*==========================================
    Mostrar Banner
    ==========================================*/
    static public function mdlMostrarBanner($tabla, $item, $valor) {
        
        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT id,
            orden AS orden,
            img AS imagen,
            estado,
            pasivo
            FROM $tabla
            WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT id,
            orden AS orden,
            img AS imagen,
            estado
            FROM $tabla
            WHERE pasivo = false
            ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Obtener el consecutivo de la proxima noticia
    ==========================================*/
    static public function mdlRegistroConsecutivo() {

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(id) IS NULL THEN 1
                    ELSE MAX(id)+1
                END AS id
            FROM banner"
        );

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Registro Banner
    ==========================================*/
    static public function mdlRegistroBanner($tabla, $datos) {

        $stmtOrden = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(orden) IS NULL THEN 1
                    ELSE MAX(orden)+1
                END AS orden
            FROM $tabla
            WHERE pasivo = 0"
        );

        $stmtOrden -> execute();

        $orden = $stmtOrden -> fetch(PDO::FETCH_ASSOC);

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(orden, img, creado_por, creado_en_ip)
            VALUES(:orden, :img, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':orden', $orden["orden"], PDO::PARAM_INT);
        $stmt->bindParam(':img', $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(':creado_por', $datos["creado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':creado_en_ip', $datos["creado_en_ip"], PDO::PARAM_STR);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;        
    }

    /*==========================================
    Editar Banner
    ==========================================*/
    static public function mdlEditarBanner($tabla, $datos){

        if( $datos["nuevoOrden"] !=  $datos["ordenActual"]) {

            // Consultamos el registro que tenga el mismo orden que
            // se envío.
            $stmtId = Conexion::conectar()->prepare(
                "SELECT id FROM $tabla
                WHERE orden = :orden"
            );

            $stmtId->bindParam(':orden', $datos["nuevoOrden"], PDO::PARAM_INT);

            $stmtId -> execute();

            $idCambiarOrden = $stmtId -> fetch(PDO::FETCH_ASSOC);

            // Cambiamos el registro que tenga el mismo orden
            $actualizarRegistro = Conexion::conectar()->prepare(
                "UPDATE $tabla SET orden = :orden
                WHERE id = :id"
            );

            $actualizarRegistro->bindParam(':id', $idCambiarOrden["id"], PDO::PARAM_INT);
            $actualizarRegistro->bindParam(':orden', $datos["ordenActual"], PDO::PARAM_INT);

            $actualizarRegistro -> execute();

        }

        // Actualizamos el orden del registro seleccionado
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET orden = :orden, img = :img, modificado_el = :modificado_el, 
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':orden', $datos["nuevoOrden"], PDO::PARAM_INT);
        $stmt->bindParam(':img', $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $datos["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;

    }

    /*==========================================
    Eliminar Banner
    ==========================================*/
    static public function mdlEliminarBanner($tabla, $data) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_el = :modificado_el, 
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':modificado_el', $data["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $data["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $data["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $data["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;
    }

    /*==========================================
    Habilitar o Deshabilitar Banner
    ==========================================*/
    static public function mdlEstadoBanner($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET estado = :estado, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

        $stmt->bindParam(':estado', $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $datos["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;
    }

}