<?php
    // Recuperamos los arrays enviados desde el formulario
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $duracion = $_POST['duracion'];


    // Creamos un array asociativo con la información de cada película
    $peliculas = [];
        for ($i = 0; $i < 4; $i++) {
        $peliculas[] = [
            "titulo" => $titulo[$i],    
            "anio" => $anio[$i],
            "duracion" => $duracion[$i]
        ];
        }

    //funcion del ejercicio 4
    function determinarCategoria($anio, $duracion){  
        $categoria = ""; //iniciamos a vacío
        if ($anio >= 2023 && $duracion > 120){
            return $categoria = "Estreno Imperdible"; //devolvemos el resultado dependiendo de que condicion cumpla
        }else if($anio <= 2000){
            return $categoria = "Clasico Reconocido";
        }else{
            return $categoria = "Contenido General";
        }
    }

    //Recorrer el array $peliculas y mostrar los resultados
    echo "<h1>Formulario: Lista de películas</h1>";
    echo "Introduce al menos <b>4 peliculas</b> con título, año y duración (min).</br></br>";
    //mostrar cabecara de la tabla
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Titulo</th>";
    echo "<th>Año</th>";
    echo "<th>Duracion</th>";
    echo "<th>Categoría</th>";
    echo "<tr>";
    //bucle para recorrer peliculas y escribir resultados
      foreach ($peliculas as $peli) {
          // llamar a funcion para asignar categorias
          $categoria = determinarCategoria($peli['anio'], $peli['duracion']);

          // Mostrar cada fila de la tabla
          echo "<tr>";
          echo "<td>{$peli['titulo']}</td>";
          echo "<td>{$peli['anio']}</td>";
          echo "<td>{$peli['duracion']}</td>";
          echo "<td>{$categoria}</td>";
          echo "</tr>";
         
      }
    echo "</table>"; //cerrar tabla

?>