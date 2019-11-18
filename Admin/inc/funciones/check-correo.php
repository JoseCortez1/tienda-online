<?php
    $correo_ingresado = $_POST['correo'];


    include 'conexion.php';
    if(isset($_GET['alta_usuario'])){
        $correos_DB = $conn->query('SELECT correo FROM usuarios WHERE eliminado = 0');
    }else{
        $correos_DB = $conn->query('SELECT correo FROM administradores WHERE eliminado = 0');
    }


    if($correos_DB){
        foreach ($correos_DB as $correo_DB){
          //  var_dump($correo_DB);
            if($correo_DB['correo'] == $correo_ingresado){
                $respuesta =array(
                    'respuesta' => 'iguales'
                );
            }
        }
        if(!isset($respuesta)){

            $respuesta =array(
                'respuesta' => 'diferentes'
            );
        }
    }else{
        $respuesta =array(
            'respuesta' => 'Error'
        );
    }

    echo json_encode($respuesta);
