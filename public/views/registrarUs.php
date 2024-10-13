<?php include '../../src/config/database.php'; ?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barbería 7A</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/side-image.css" />
</head>

<body class="bg-dark.bg-gradient">
    <form method="POST" name="frm1" id="frm1" action="correos.php">
        <dinamic-content path="../partials/header.html" style-path="../css/header-footer.css"></dinamic-content>
        <div class="content-container">
            <aside class="img-container"></aside>
            <main>
                <div class="alert alert-danger d-none" role="alert" id="modal-alert">
                    Ha ocurrido un error inesperado
                </div>
                <form id="login-form">
                    <legend>Correo electrónico</legend>
                    <section name="user-data" class="mb-3">
                        <label for="user-input" class="form-label">Correo</label>
                        <input type="text" class="form-control" name="correo" id="correo" />
                    </section>
                    <div class="d-grid gap-2">
                        <button id="login-button" class="btn btn-primary" type="submit">
                            Aceptar
                        </button>
                    </div>
                </form>
                <hr class="border border-primary border-3 opacity-75">
                <hr>
                <a class="btn btn-outline-dark" href="lectura.php" role="button">Regresar</a>
                <a class="btn btn-outline-danger" href="login.html" role="button">Ingresar</a>
            </main>
        </div>
        <dinamic-content path="../partials/footer.html" style-path="../css/header-footer.css"></dinamic-content>
        <script type="module" src="../js/login.js"></script>
    </form>
</body>

</html>