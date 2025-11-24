<?php
session_start();
require 'vendor/autoload.php'; // PHPMailer y Dompdf
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

// Recibir datos por GET
if (!isset($_GET['usuario'], $_GET['asiento'], $_GET['cine'], $_SESSION['correo'])) {
    die("Faltan datos para enviar el correo.");
}

$usuario = htmlspecialchars($_GET['usuario']);
$asiento = htmlspecialchars($_GET['asiento']);
$cine    = htmlspecialchars($_GET['cine']);
$correo  = $_SESSION['correo'];

//Generar PDF en memoria (igual que codigopdf.php)
$qr_file = 'qr_temp.png';
$qr_base64 = base64_encode(file_get_contents($qr_file));
$html = "
<h1>Entrada de Cine</h1>
<p><strong>Usuario:</strong> $usuario</p>
<p><strong>Asiento:</strong> $asiento</p>
<p><strong>Cine:</strong> $cine</p>
<p><strong>Código QR:</strong></p>
<img src='data:image/png;base64,$qr_base64' style='width:200px;'>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();

// Guardar PDF en archivo temporal
$pdf_path = 'entrada_'.$usuario.'.pdf';
file_put_contents($pdf_path, $dompdf->output());

//Configurar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Cambia por tu SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'antonio@gmail.com';
    $mail->Password   = 'erchulo';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Destinatario y remitente
    $mail->setFrom('antonio@gmail.com', 'Cine');
    $mail->addAddress($correo, $usuario);

    // Adjuntar PDF
    $mail->addAttachment($pdf_path);

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Tu entrada de cine';
    $mail->Body    = "Hola $usuario,<br>Adjuntamos tu entrada para el cine <strong>$cine</strong>, asiento <strong>$asiento</strong>.";

    $mail->send();
    echo "Correo enviado correctamente a $correo.";

    // Eliminar PDF temporal
    unlink($pdf_path);

} catch (Exception $e) {
    echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
}
?>
