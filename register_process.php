<?php
// Cargar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'suad_gamer';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Procesar el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['username'];
    $correo = $_POST['email'];
    $contraseña = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50));

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuarios (username, correo, password, token) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombreUsuario, $correo, $contraseña, $token]);

    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@gmail.com'; // Tu correo de Gmail
        $mail->Password = 'tu_contraseña'; // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el correo
        $mail->setFrom('tu_correo@gmail.com', 'Suad Gamer'); // Remitente
        $mail->addAddress($correo, $nombreUsuario); // Destinatario
        $mail->Subject = 'Confirma tu cuenta en Suad Gamer';
        $mail->Body = "Hola $nombreUsuario,\n\nPor favor, confirma tu cuenta haciendo clic en el siguiente enlace:\n";
        $mail->Body .= "http://localhost/confirm_email.php?token=$token\n\n¡Gracias por unirte a Suad Gamer!";
        
        // Enviar el correo
        $mail->send();
        echo "Registro exitoso. Revisa tu correo para confirmar tu cuenta.";
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>

// Generar un token único
$token = bin2hex(random_bytes(50));

// Actualizar el token del usuario
$sql = "UPDATE usuarios SET token = ? WHERE correo = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token, $correo]);

// Enviar correo de confirmación
$destinatario = $correo;
$asunto = "Confirma tu cuenta en Suad Gamer";
$mensaje = "Hola $nombreUsuario,\n\nPor favor, confirma tu cuenta haciendo clic en el siguiente enlace:\n";
$mensaje .= "http://localhost/confirm_email.php?token=$token\n\nGracias por unirte a Suad Gamer!";
$encabezados = "From: no-reply@suadgamer.com";

if (mail($destinatario, $asunto, $mensaje, $encabezados)) {
    echo "Registro exitoso. Revisa tu correo para confirmar tu cuenta.";
} else {
    echo "Error al enviar el correo de confirmación.";
}
ALTER TABLE usuarios ADD confirmado TINYINT DEFAULT 0;
ALTER TABLE usuarios ADD token VARCHAR(255);

