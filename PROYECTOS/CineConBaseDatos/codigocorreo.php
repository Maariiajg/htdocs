<?php
session_start();
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailerException;
use Helpers\Debug;

if (!isset($_SESSION['usuario'])) {
    die("No autorizado");
}

try {
    $usuario = $_SESSION['usuario'];
    $cine = $_SESSION['cine'];
    $asiento = $_SESSION['asiento'];
    $correoDestino = $_SESSION['correo'] ?? 'usuario@example.com'; // Deberíamos guardar el correo en sesión en validacion.php
    $qr_file = 'assets/images/qr_temp.svg';

    $mail = new PHPMailer(true);

    // Configuración del servidor (Esto debe configurarlo el usuario con sus datos reales)
    // $mail->isSMTP();
    // $mail->Host       = 'smtp.example.com';
    // $mail->SMTPAuth   = true;
    // $mail->Username   = 'user@example.com';
    // $mail->Password   = 'password';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port       = 587;

    $mail->setFrom('cine@premium.com', 'Cine Premium');
    $mail->addAddress($correoDestino, $usuario);

    // Adjuntos
    $mail->addAttachment($qr_file, 'entrada_qr.svg');

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Tu Entrada para Cine Premium';
    $mail->Body    = "
        <h1>¡Hola $usuario!</h1>
        <p>Aquí tienes los detalles de tu reserva en <strong>$cine</strong>:</p>
        <ul>
            <li><strong>Asiento:</strong> $asiento</li>
        </ul>
        <p>Te adjuntamos el código QR para tu entrada.</p>
        <p>¡Disfruta de la película!</p>
    ";

    // $mail->send(); // Desomentar cuando se configure el SMTP
    
    // Como no tenemos SMTP configurado, simulamos el éxito para el ejercicio
    $success = true;

} catch (MailerException $e) {
    Debug::log($e->getMessage(), 'MAIL_ERROR');
    $error = "No se pudo enviar el correo: " . $mail->ErrorInfo;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Envío de Correo - Cine Premium</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container animate-fade-in">
        <h1>📧 Envío de Correo</h1>
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                Correo preparado y enviado correctamente (Simulado).<br>
                Se ha adjuntado el QR y los detalles para <strong><?= htmlspecialchars($usuario) ?></strong>.
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <a href="codigo.php" class="btn">Volver a la Entrada</a>
    </div>
</body>
</html>
