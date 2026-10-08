
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - Sistema MVC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">
                        Iniciar Sesión
                    </h3>

                    <?php if (isset($_SESSION["error"])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars(
                                $_SESSION["error"]
                            ) ?>
                        </div>
                        <?php unset($_SESSION["error"]); ?>
                    <?php endif; ?>

                    <form action="index.php?ruta=login"
                          method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Usuario
                            </label>

                            <input type="text"
                                   name="usuario"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Contraseña
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Ingresar
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
