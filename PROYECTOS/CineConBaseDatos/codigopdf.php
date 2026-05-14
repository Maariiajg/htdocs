<?php
session_start();
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use Helpers\Debug;

if (!isset($_SESSION['usuario'])) {
    die("No autorizado");
}

try {
    $usuario = $_SESSION['usuario'];
    $cine = $_SESSION['cine'];
    $asiento = $_SESSION['asiento'];
    $qr_file = 'assets/images/qr_temp.svg';

    // Convertir SVG a Base64
    $imageData = base64_encode(file_get_contents($qr_file));
    $src = 'data:image/svg+xml;base64,' . $imageData;

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = "
    <html>
    <head>
        <style>
            body { font-family: 'Helvetica', sans-serif; text-align: center; color: #333; }
            .ticket { border: 2px dashed #333; padding: 20px; border-radius: 10px; margin-top: 50px; }
            h1 { color: #0f0c29; }
            .details { margin: 20px 0; font-size: 1.2rem; }
            .qr { margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='ticket'>
            <h1>CINE PREMIUM</h1>
            <p>Comprobante de Entrada</p>
            <div class='details'>
                <strong>Usuario:</strong> $usuario <br>
                <strong>Cine:</strong> $cine <br>
                <strong>Asiento:</strong> $asiento
            </div>
            <div class='qr'>
                <img src='$src' width='200'>
            </div>
            <p style='font-size: 0.8rem; margin-top: 20px;'>Presente este código en la entrada del cine.</p>
        </div>
    </body>
    </html>";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("entrada_" . $usuario . ".pdf", ["Attachment" => true]);

} catch (Exception $e) {
    Debug::log($e->getMessage(), 'PDF_ERROR');
    echo "Error al generar PDF: " . $e->getMessage();
}
