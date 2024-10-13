<?php include '../../src/config/database.php'; ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Se instalan dependencias de nuestro Composer jeje

function generarContrasena($longitud = 8) { // Funcion para generar una contraseña ramdon donde usamos caracteres alfanumericos
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $contrasena = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)]; // sacamos el maximo de la cadena y le restamos uno para elegir 
        // un caracter aleatorio dentro de la cadena de caracteres (0-69)
    }
    return $contrasena;
}


$contraseniaAleatoria = generarContrasena(8); // Se manda a llamar la funcion para generar contra de 8 carac.

$correoUsuario = $_POST['correo'];

// Verifica si el correo ya existe en la base de datos
$sql2 = "SELECT COUNT(*) as total FROM usuarios WHERE usuario = '$correoUsuario';";
$result = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result); // Obtiene el resultado de la consulta

// Verifica si el correo ya está registrado
if ($row['total'] > 0) {
    // Si el correo ya existe
    echo "Este correo ya está registrado. Intenta con otro.";
?>
<hr>
    <a href="registrarUs.php">Regresar</a>
  <?php  
} else {
    $sql="insert into usuarios (usuario,contrasena) values ('$correoUsuario','$contraseniaAleatoria');";
    $execute=mysqli_query($conn,$sql);

    // Crea una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';            // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;                    // Habilitar autenticación SMTP
        $mail->Username = 'agjo220210@upemor.edu.mx';   // Tu correo de Gmail
        $mail->Password = 'zmqi gyee apef xbhz';         // Tu App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
        $mail->Port = 587;                         // Puerto TCP para TLS

        // Configuración del remitente y destinatario
        $mail->setFrom('agjo220210@upemor.edu.mx', 'Barberia 7A');
        $mail->addAddress($_POST['correo']);  // Destinatario: correo del usuario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Tus credenciales de acceso - Barberia 7A';
        $mail->Body = "
            <p>¡Hola!</p>
            <p>Aquí tienes tus credenciales para acceder a nuestra plataforma:</p>
            <ul>
                <li><strong>Usuario:</strong> $correoUsuario</li>
                <li><strong>Contraseña:</strong> $contraseniaAleatoria</li>
            </ul>
            ";
        $mail->AltBody = "Usuario: usuario\nContraseña: $contraseniaAleatoria";  // Sin diseño

        // Enviar el correo
        $mail->send();
        echo 'El correo se ha enviado exitosamente';
        
        // Redireccionar después de un breve descanso
        sleep(3);
        header("Location: registrarUs.php");

    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>

