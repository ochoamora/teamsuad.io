<?php
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

// Validar el token
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token
    $sql = "SELECT * FROM usuarios WHERE token = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Confirmar el usuario
        $sql = "UPDATE usuarios SET confirmado = 1, token = NULL WHERE token = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token]);

        echo "Cuenta confirmada exitosamente. <a href='login.html'>Inicia sesión aquí</a>.";
    } else {
        echo "Token inválido o expirado.";
    }
} else {
    echo "Token no proporcionado.";
}
?>
