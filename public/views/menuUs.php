<?php include '../../src/config/database.php'; ?>
<?php
     include '../../src/config/session.php';
  // Importar funciones de sesión
    isUserLogged(); // Verificar si hay sesión activa
    main($conn); 
?>
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
                crossorigin="anonymous"
            />
            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"
            ></script>
            <link rel="stylesheet" href="../css/side-image.css" />
        </head>
        <body class="bg-dark.bg-gradient">
        <form method="POST" name="frm1" id="frm1" action="correos.php">
    <dinamic-content path="../partials/header.html" style-path="../css/header-footer.css"></dinamic-content>
    <div class="content-container">
        <aside class="img-container"></aside>
        <main>
        <p>
        <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>
    <ul>
        <a href="createCita.html"><img src="../assets/icon/c.png" alt="Crear"></a>
        <a href="ver_citas.php"><img src="../assets/icon/r.png"/></a>
        <a href="editar_cita.php"><img src="../assets/icon/u.gif"/></a>
        <a href="eliminar_cita.php"><img src="../assets/icon/d.png"/></a>
        <a href="/src/controllers/logout.php"><img src="../assets/icon/r.png"/></a></li>    
    </ul>
        </p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate,
          rerum, reprehenderit consequatur perferendis officia, vitae fuga animi
          temporibus itaque atque
        </p>
        <picture>
          <img loading="lazy" src="../assets/img/2.jpg" alt="imagen blog" />
        </picture>
        </main>
        </div>
        <dinamic-content path="../partials/footer.html" style-path="../css/header-footer.css"></dinamic-content>
        <script type="module" src="../js/login.js"></script>
    </form>
        </body>
    </html>
        