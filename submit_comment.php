<?php
// Incluir la conexión a la base de datos
include('connect.php');

// Verificar si el usuario está logueado
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Debes estar logueado para comentar.");
}

// Obtener el comentario enviado
$comentario = $_POST['comentario'];
$user_id = $_SESSION['user_id'];

// Insertar el comentario en la base de datos
$sql = "INSERT INTO comentarios (user_id, comentario) VALUES (:user_id, :comentario)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':comentario', $comentario);

if ($stmt->execute()) {
    echo "Comentario enviado exitosamente.";
    header("Location: home.html"); // Redirigir al usuario de vuelta a la página de inicio
} else {
    echo "Hubo un error al enviar el comentario.";
}
?>
