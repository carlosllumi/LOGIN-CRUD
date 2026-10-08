
<?php

require_once __DIR__ . "/../models/Producto.php";

class ProductoController {

    public static function verificarAcceso() {
        if (!isset($_SESSION["usuario_id"])) {
            header("Location: index.php");
            exit;
        }
    }

    public static function listar() {
        self::verificarAcceso();

        $productos = Producto::listar();

        require __DIR__ . "/../views/productos.php";
    }

    public static function guardar() {
        self::verificarAcceso();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit("Metodo no permitido");
        }

        $nombre = trim($_POST["nombre"] ?? "");
        $precio = $_POST["precio"] ?? "";
        $cantidad = $_POST["cantidad"] ?? "";

        if (
            $nombre === "" ||
            strlen($nombre) > 100 ||
            !is_numeric($precio) ||
            $precio < 0 ||
            filter_var($cantidad, FILTER_VALIDATE_INT) === false ||
            $cantidad < 0
        ) {
            http_response_code(400);
            exit("Datos del producto invalidos");
        }

        $id = filter_input(
            INPUT_POST,
            "id",
            FILTER_VALIDATE_INT
        );

        if ($id && $id > 0) {
            Producto::actualizar(
                $id, $nombre, $precio, $cantidad
            );
        } else {
            Producto::crear(
                $nombre, $precio, $cantidad
            );
        }

        header("Location: index.php?ruta=productos");
        exit;
    }

    public static function eliminar() {
        self::verificarAcceso();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit("Metodo no permitido");
        }

        $id = filter_input(
            INPUT_POST,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id || $id <= 0) {
            http_response_code(400);
            exit("ID invalido");
        }

        Producto::eliminar($id);

        header("Location: index.php?ruta=productos");
        exit;
    }
}
