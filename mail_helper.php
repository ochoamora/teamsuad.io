<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga PHPMailer
require 'vendor/autoload.php'; // Si usaste Composer
// require 'libs/PHPMailer/PHPMailer.php'; // Si descargaste manualmente
// require 'libs/PHPMailer/SMTP.php';
// require 'libs/PHPMailer/Exception.php';

function enviarCorreo($destinatario, $asunto, $cuerpo) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_email@gmail.com'; // Tu correo
        $mail->Password = 'tu_contraseña'; // Tu contraseña o contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('tu_email@gmail.com', 'Suad Gamer'); // Dirección y nombre del remitente
        $mail->addAddress($destinatario); // Destinatario
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->isHTML(true); // Habilitar contenido HTML

        $mail->send();
        return true; // El correo se envió correctamente
    } catch (Exception $e) {
        error_log("Error al enviar correo: " . $mail->ErrorInfo);
        return false; // Hubo un error
    }
}
