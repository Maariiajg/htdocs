<?php
    try{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //echo $_POST['figura'];
            $figura = $_POST['figura'];
            if($figura == "triangulo"){
                $base = $_POST['base'];
                $altura = $_POST['altura'];

                if(!is_numeric($base) || $base <= 0 || !is_numeric($altura) || $altura <= 0){
                    //echo "Error: La base y la altura no pueden ser negativas"
                    throw new Exception("Error: La base y la altura no pueden ser negativas");
                }
            }else{
                $radio = $_POST['radio'];
            }
        }
    }catch(Exception $e){
        echo $e->get_Message();
    }
    

?>