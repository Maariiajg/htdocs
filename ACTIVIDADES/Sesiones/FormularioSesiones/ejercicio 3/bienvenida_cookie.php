<?php
    //Comprobar si la cookie 'usuario'está establecida
    if(isset($_COOKIE['usuario'])){
        echo "Bienvanido, ";
        echo $_COOKIE['usuario'];
        echo "!";
    }else{
        echo "no puedes visitar esta página sin estar registrado";
    }
?>