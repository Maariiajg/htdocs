<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen PHP. Parte 1</title>
</head>
<body>
    <?php
        //declaramos variables
        define("IVA", 21);
        $moneda = "€";
        $nombre = "Teclado mecánico";
        $precio_unitario = 49.90;
        $cantidad = 3;
        $descuento = 10;
        
        
        //Resultados:
        echo "<h1>Resumen del pedido: $nombre</h1>";

        //importe pedido
        $importe = $precio_unitario * $cantidad;
        linea("Importe base", $importe);

        //calculo del IVA (solo IVA)
        $iva = $importe * (IVA/100);
        linea("IVA", $iva);

        //calculo importe con iva
        $importe_final = $importe + $iva;
        linea("Importe con IVA", $importe_final);

        //calculo del importe con descuento
        $descuento_importe = $importe_final * ($descuento/100);
        linea("Descuento", $descuento_importe);

        $importe_final_descuento = $importe_final - $descuento_importe;
        linea("Total a pagar", $importe_final_descuento);

        //funcion para escribir los resultados
        function linea($etiqueta, $valor){
            global $moneda;
            global $descuento;
            if($etiqueta === "IVA"){
                $valor = number_format($valor, 2);
                echo "<p><strong>$etiqueta(" . IVA . "%): </strong>" .$valor . $moneda . "</p>";
            }else if($etiqueta === "Descuento"){
                $valor = number_format($valor, 2);
                echo "<p><strong>$etiqueta(" . $descuento . "%): </strong>" .$valor . $moneda . "</p>";
            }else{
                $valor = number_format($valor, 2);
                echo "<p><strong>$etiqueta: </strong>" .$valor . $moneda . "</p>";
            }
            
        }

    ?>
</body>
</html>