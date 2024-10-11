<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Ajusta la ruta si es necesario

// Crea una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';            // Servidor SMTP de Gmail
    $mail->SMTPAuth = true;                    // Habilitar autenticación SMTP
    $mail->Username = 'agjo220210@upemor.edu.mx';   // Tu correo de Gmail
    $mail->Password = 'zmqi gyee apef xbhz';         // Tu contraseña de Gmail (preferiblemente una "App Password")
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
    $mail->Port = 587;                         // Puerto TCP para TLS

    // Configuración del remitente y destinatario
    $mail->setFrom('agjo220210@upemor.edu.mx', 'Barbería 7A');
    $mail->addAddress($_POST['correo']);     // Destinatario: el correo ingresado por el usuario

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Tus credenciales de acceso - Barberia 7A.  usuario: usuario  Contrasenhia:123qaz';
    $mail->Body    = 'Aquí están tus credenciales para acceder a nuestra plataforma.';
    $mail->AltBody = 'Aquí están tus credenciales para acceder a nuestra plataforma.'; // Para clientes que no soporten HTML

    // Enviar el correo
    $mail->send();
    echo 'El correo se ha enviado exitosamente';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}