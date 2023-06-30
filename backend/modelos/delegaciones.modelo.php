<?php
require_once "conexion.php";

class ModeloDelegaciones {

    // ====================================================== //
    // ================ Mostrar Delegaciones ================ //
    // ====================================================== //
    static public function mdlMostrarDelegaciones($tabla, $item, $valor) {
        
        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT id AS id,
            nombre_delegacion AS nombre_delegacion,
            nombre_delegado AS delegado,
            nombre_imagen_delegacion_subida AS imagen,
            telefono_delegacion AS telefono,
            direccion_delegacion AS direccion,
            email_delegacion AS email,
            cuenta_twitter AS twitter,
            cuenta_facebook AS facebook,
            cuenta_instagram AS instagram
            FROM $tabla
            WHERE pasivo = 0
            AND $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT id AS id,
            nombre_delegacion AS nombre_delegacion,
            nombre_delegado AS delegado,
            nombre_imagen_delegacion_subida AS imagen,
            telefono_delegacion AS telefono,
            direccion_delegacion AS direccion,
            email_delegacion AS email,
            cuenta_twitter AS twitter,
            cuenta_facebook AS facebook,
            cuenta_instagram AS instagram
            FROM $tabla
            WHERE pasivo = 0
            ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Obtener el consecutivo de la proxima delegación
    ==========================================*/
    static public function mdlRegistroConsecutivo() {

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(id) IS NULL THEN 1
                    ELSE MAX(id)+1
                END AS id
            FROM datos_delegacion"
        );

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Registro Delegacion
    ==========================================*/
    static public function mdlRegistroDelegacion($tabla, $datos) {
        
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(nombre_delegacion, nombre_delegado, nombre_imagen_delegacion_subida, telefono_delegacion,
            direccion_delegacion, email_delegacion, cuenta_twitter, cuenta_facebook, cuenta_instagram, creado_por, creado_en_ip)
            VALUES(:delegacion, :delegado, :imagen, :telefono, :direccion, :email, :twitter, :facebook, :instagram, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':delegacion', $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(':delegado', $datos["delegado"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(':twitter', $datos["twitter"], PDO::PARAM_STR);
        $stmt->bindParam(':facebook', $datos["facebook"], PDO::PARAM_STR);
        $stmt->bindParam(':instagram', $datos["instagram"], PDO::PARAM_STR);
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
    Editar Delegacion
    ==========================================*/
    static public function mdlEditarDelegacion($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET nombre_delegacion = :delegacion, nombre_delegado = :delegado, 
            nombre_imagen_delegacion_subida = :imagen, telefono_delegacion = :telefono,
            direccion_delegacion = :direccion, email_delegacion = :email, cuenta_twitter = :twitter,
            cuenta_facebook = :facebook, cuenta_instagram = :instagram, modificado_el = :modificado_el,
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        
        $stmt->bindParam(':delegacion', $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(':delegado', $datos["delegado"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(':twitter', $datos["twitter"], PDO::PARAM_STR);
        $stmt->bindParam(':facebook', $datos["facebook"], PDO::PARAM_STR);
        $stmt->bindParam(':instagram', $datos["instagram"], PDO::PARAM_STR);
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

    static public function mdlEliminarDelegacion($tabla, $data){
        
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_el = :modificado_el, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip
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


}