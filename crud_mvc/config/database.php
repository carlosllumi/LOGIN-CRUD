
<?php

class Database {

    public static function conectar() {

        try {
            $conexion = new PDO(
                "mysql:host=localhost;dbname=crud_mvc;charset=utf8mb4",
                "root",
                ""
            );

            $conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexion;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("Error al conectar con MySQL");
        }
    }
}
