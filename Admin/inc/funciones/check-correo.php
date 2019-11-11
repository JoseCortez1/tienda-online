<?php 
    $correo_ingresado = $_POST['correo'];


    include 'conexion.php';
    $correos_DB = $conn->query('SELECT correo FROM administradores WHERE eliminado = 0');
    
    if($correos_DB){
        foreach ($correos_DB as $correo_DB){
            
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
   