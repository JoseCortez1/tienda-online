<?php
    
    $tipo = $_POST['tipo'];

    if($tipo === 'verificar'){
        include 'conexion.php';
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $stmt = $conn->prepare("SELECT nombre, correo, pass, id , rol FROM administradores WHERE correo = ?");
        $stmt->bind_param('s',$correo);
        $stmt->execute();

        $stmt->bind_result($nombre_usuario, $correo_usuario, $pass_usuario,$id_usuario, $rol_usuario);
        $stmt->fetch();

        if($correo_usuario){
            if(password_verify($pass, $pass_usuario)){
                session_start();
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                $_SESSION['correo_usuario'] = $correo_usuario;
                $_SESSION['rol'] = $rol_usuario;
                $_SESSION['login'] = true;
                $_SESSION['id'] = $id_usuario;

                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }
            else{
                $respuesta = array(
                    'respuesta' =>'El password es incorrecto'
                );
            }
        }else{
            $respuesta = array(
                'respuesta' =>'El correo no se ha registrado'
            );
        }

        echo json_encode($respuesta);
    }