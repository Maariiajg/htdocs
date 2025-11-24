<?php
session_start();

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

// Comprobar datos recibidos por GET
if (!isset($_GET['usuario'], $_GET['asiento'], $_GET['cine'])) {
    die("Faltan datos para generar el PDF.");
}

$usuario = htmlspecialchars($_GET['usuario']);
$asiento = htmlspecialchars($_GET['asiento']);
$cine    = htmlspecialchars($_GET['cine']);

// Ruta del QR temporal generado previamente
$qr_file = "http://localhost/proyectos/cine/qr_temp.png";

// Construcción del HTML del PDF
$qr_base64 = base64_encode(file_get_contents($qr_file));
$html = "
<h1>Entrada de Cine</h1>
<p><strong>Usuario:</strong> $usuario</p>
<p><strong>Asiento:</strong> $asiento</p>
<p><strong>Cine:</strong> $cine</p>
<p><strong>Código QR:</strong></p>
<img src='data:image/png;base64,$qr_base64' style='width:200px;'>
";

// Crear PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->render();

// Descargar PDF
$dompdf->stream("entrada_cine.pdf", ["Attachment" => true]);
?>
