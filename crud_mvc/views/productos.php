
<?php
$productoEditar = null;

if (isset($_GET["editar"])) {
    $idEditar = filter_input(
        INPUT_GET,
        "editar",
        FILTER_VALIDATE_INT
    );

    if ($idEditar && $idEditar > 0) {
        $productoEditar = Producto::buscar($idEditar);
    }
}

function escapar($valor) {
    return htmlspecialchars(
        (string)$valor,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>CRUD de Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">
            Sistema MVC - Productos
        </span>

        <div>
            <span class="text-white me-3">
                <?php echo escapar($_SESSION["usuario"]); ?>
            </span>

            <a href="logout.php"
               class="btn btn-light btn-sm">
                Cerrar sesion
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <h2>Gestion de Productos</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5>
                <?php echo $productoEditar
                    ? "Editar producto"
                    : "Registrar producto"; ?>
            </h5>

            <form method="POST"
                  action="index.php?ruta=guardar">

                <input type="hidden"
                       name="csrf_token"
                       value="<?php echo escapar($_SESSION['csrf_token']); ?>">

                <input type="hidden"
                       name="id"
                       value="<?php echo escapar(
                           $productoEditar["id"] ?? ""
                       ); ?>">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nombre</label>

                        <input type="text"
                               name="nombre"
                               class="form-control"
                               maxlength="100"
                               required
                               value="<?php echo escapar(
                                   $productoEditar["nombre"] ?? ""
                               ); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Precio</label>

                        <input type="number"
                               name="precio"
                               step="0.01"
                               min="0"
                               class="form-control"
                               required
                               value="<?php echo escapar(
                                   $productoEditar["precio"] ?? ""
                               ); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cantidad</label>

                        <input type="number"
                               name="cantidad"
                               min="0"
                               step="1"
                               class="form-control"
                               required
                               value="<?php echo escapar(
                                   $productoEditar["cantidad"] ?? ""
                               ); ?>">
                    </div>

                </div>

                <button type="submit"
                        class="btn btn-success">
                    <?php echo $productoEditar
                        ? "Actualizar"
                        : "Guardar"; ?>
                </button>

                <?php if ($productoEditar): ?>
                    <a href="index.php?ruta=productos"
                       class="btn btn-secondary">
                        Cancelar
                    </a>
                <?php endif; ?>

            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5>Lista de productos</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo escapar($producto["id"]); ?></td>
                            <td><?php echo escapar($producto["nombre"]); ?></td>
                            <td>$<?php echo escapar($producto["precio"]); ?></td>
                            <td><?php echo escapar($producto["cantidad"]); ?></td>

                            <td>
                                <a class="btn btn-warning btn-sm"
                                   href="index.php?ruta=productos&editar=<?php echo urlencode($producto['id']); ?>">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="index.php?ruta=eliminar"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este producto?');">

                                    <input type="hidden"
                                           name="csrf_token"
                                           value="<?php echo escapar($_SESSION['csrf_token']); ?>">

                                    <input type="hidden"
                                           name="id"
                                           value="<?php echo escapar($producto["id"]); ?>">

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
