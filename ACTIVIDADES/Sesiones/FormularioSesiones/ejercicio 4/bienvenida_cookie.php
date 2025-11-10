<?php
    
    if(isset($_COOKIE['idioma'])){
        
        if($_COOKIE['idioma'] === "es"){
            echo "<h1>Bienvenido/a</h1>";
        }else if($_COOKIE['idioma'] === "en"){
            echo "<h1>Welcome</h1>";
        }
    }else{
        echo "no puedes visitar esta página sin decidir un idioma";
    }
?>