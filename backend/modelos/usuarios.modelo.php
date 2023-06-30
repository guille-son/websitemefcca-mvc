<?php

require_once "conexion.php";

class ModeloUsuarios {
    /*==========================================
    Mostrar Usuarios
    ==========================================*/
    static public function mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor) {
        if($item != null && $valor != null) {
            $stmt = Conexion::conectar() -> prepare("SELECT u.id AS id,
            u.username AS usuario,
            u.nombres AS nombre, 
            u.apellidos AS apellido,
            u.email AS correo,
            u.rol_id AS rol_id,
            c.descripcion AS rol,
            u.password AS password,
            u.pasivo AS pasivo
            FROM $tabla1 u
            INNER JOIN $tabla2 c ON c.id = u.rol_id
            WHERE u.$item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        } else {
            $stmt = Conexion::conectar() -> prepare("SELECT u.id AS id,
            u.username AS usuario,
            CONCAT_WS(' ', u.nombres, u.apellidos) AS nombre_completo,
            u.email AS correo,
            u.rol_id AS rol_id,
            c.descripcion AS rol
            FROM $tabla1 u
            INNER JOIN $tabla2 c ON c.id = u.rol_id
            WHERE u.pasivo = false
            ORDER BY u.id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;
    }

    /*==========================================
    Mostrar Usuarios
    ==========================================*/
    static public function mdlDatosPublicadosPorUsuario($tabla, $id) {

        $stmt = Conexion::conectar() -> prepare("SELECT COUNT(id) AS cantidad
        FROM $tabla
        WHERE creado_por = :id
        AND pasivo = false");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        $stmt -> execute();
        return $stmt -> fetch();

        $stmt = null;

    }
    

    /*================================================
    Validar que el correo y el usuario no se repitan
    =================================================*/
    static public function buscarUsuarioRepetido($usuario) {
        $statement = Conexion::conectar()->prepare(
            "SELECT COUNT(1) FROM usuario
            WHERE username = '$usuario' "
        );

        $statement->execute();
        $resultado = $statement->fetchColumn();

        return $resultado;
    }

    static public function buscarCorreoRepetido($correo) {
        $statement = Conexion::conectar()->prepare(
            "SELECT COUNT(1) FROM usuario
            WHERE email = '$correo' "
        );

        $statement->execute();
        $resultado = $statement->fetchColumn();

        return $resultado;
    }

    /*==========================================
    Registro de Usuarios
    ==========================================*/
    static public function mdlRegistroUsuarios($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(username, nombres, apellidos, email, rol_id, password, creado_por, creado_en_ip)
            VALUES(:username, :nombres, :apellidos, :email, :rol_id, :password, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':username', $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':nombres', $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(':rol_id', $datos["rol_id"], PDO::PARAM_INT);
        $stmt->bindParam(':password', $datos["password"], PDO::PARAM_STR);
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
    Editar Usuario
    ==========================================*/
    static public function mdlEditarUsuarios($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET username = :username, nombres = :nombres, apellidos = :apellidos,
            email = :email, rol_id = :rol_id, password = :password, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

        $stmt->bindParam(':username', $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':nombres', $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(':rol_id', $datos["rol_id"], PDO::PARAM_INT);
        $stmt->bindParam(':password', $datos["password"], PDO::PARAM_STR);
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

    /*==========================================
    Eliminar Usuario
    ==========================================*/
    static public function mdlEliminarUsuarios($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

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

    /*==========================================
    Ajuste de Usuario
    ==========================================*/
    static public function mdlAjusteUsuario($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET password = :password, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

        $stmt->bindParam(':password', $datos["password"], PDO::PARAM_STR);
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