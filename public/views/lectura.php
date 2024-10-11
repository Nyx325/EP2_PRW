<?php include '../../src/config/database.php'; ?>


<?php
    sleep(2);
    // Realizar la consulta
    $sql = "SELECT inicio,dia,fin FROM horario";
    $execute =mysqli_query($conn,$sql);

    $sql2 = "SELECT nombre,precio FROM servicios";
    $execute2 =mysqli_query($conn,$sql2);
?>
                
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
        <body>
            <dinamic-content path="../partials/header.html"style-path="../css/header-footer.css"></dinamic-content>
            <div class="content-container">
                <aside class="img-container"></aside>
                <main>
                    <p></p><h2>Horarios de atención</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Día</th>
                            <th>Apertura</th>
                            <th>Cierre</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($execute->num_rows > 0) {
                                // Salida de datos de cada fila
                                while($row = $execute->fetch_assoc()) {
                                    echo "<tr><td>" . $row["dia"]. "</td><td>" . $row["inicio"]. "</td><td>" . $row["fin"];
                                }
                            } else {
                                echo "<tr><td colspan='4'>No hay resultados</td></tr>";
                            }
                            ?>
                        </tbody>
                            
                    </table>
                    <hr class="border border-warning border-3 opacity-75">
                    <p></p><h2>Servicios</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>precio</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($execute2->num_rows > 0) {
                                // Salida de datos de cada fila
                                while($row2 = $execute2->fetch_assoc()) {
                                    echo "<tr><td>" . $row2["nombre"]. "</td><td>" . $row2["precio"]. "</td><td>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No hay resultados</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                            
                    </table>

                    <hr>
                    <a class="btn btn-outline-dark" href="../../index.html" role="button">Regresar</a>
                    <a class="btn btn-outline-danger" href="registrarUs.php" role="button">Registrarse</a>
                </main>
            </div>
            
            <dinamic-content
                path="../partials/footer.html"
                style-path="../css/header-footer.css"
            ></dinamic-content>

            <script type="module" src="../js/login.js"></script>
        </body>
    </html>
        
