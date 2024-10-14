<?php  include 'C:/xampp/htdocs/EP2_PRW/src/config/database.php';
?>
<?php
    if(isset($_GET['id'])){
        $ID=$_GET['id'];
        $sql="select * from citas where idcitas=$ID";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_array($result);
            $nombre=$row['nombre'];
            $apellido=$row['apellido'];
            $hora=$row['hora'];
            $fecha=$row['fecha'];
            $servicio=$row['servicio'];


            //echo $nombre . "<br>". $precio;
        }
    }else{
        echo "No existe el ID";
    }

    if(isset($_POST['actualizar'])){
        $nombre=$row['nombre'];
            $apellido=$row['apellido'];
            $hora=$row['hora'];
            $fecha=$row['fecha'];
            $servicio=$row['servicio'];
        
        $sql= "update citas SET nombre='$nombre', apellido=' $apellido', fecha=' $fecha', hora='  $hora', servicio=' $servicio' WHERE idcitas=$ID";
        mysqli_query($conn,$sql);
        sleep(3);
        header("Location:eliminar_act.php");
    }
?>

<form action="actualizar.php?id=<?php echo $_GET['id'];?>" method="POST">
    <div class="form_container">
        <label>Nombre del cliente: <br>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre;?> "class="formulario_input">
        </label>
    </div>
    <div class="form_container">
        <label>apellido del cliente: <br>
            <input type="text" name="apellido" id="apellido" value="<?php echo $apellido;?> "class="formulario_input">
        </label>
    </div>
    <div class="form_container">
        <label>fecha: <br>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha;?> "class="formulario_input">
        </label>
    </div>
    <div class="form_container">
        <label>Hora: <br>
            <input type="time" name="hora" id="hora" value="<?php echo $hora;?> "class="formulario_input">
        </label>
    </div>
    <div class="form-group">
            <label for="servicio">Servicio:</label>
            <select name="servicio" id="servicio" class="form-control" required>
                <option value="">Selecciona un servicio</option>
                <?php
                    if (!$conn) {
                        die("Conexión fallida: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM servicios";
                    $result = mysqli_query($conn, $sql);
                    
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
                        }
                    } else {
                        echo "<option value=''>Error en la consulta: " . mysqli_error($conn) . "</option>";
                    }
                    mysqli_close($conn);
                ?>
            </select>
        </div>
        
    <br>
    <button name="actualizar" class="formulario_btn">Actualizar</button>

