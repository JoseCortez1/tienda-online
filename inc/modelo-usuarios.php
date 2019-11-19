<?php

if(isset($_POST['tipo']) && ($_POST['tipo'] == "verificar")){
  include "conexion.php";
  $correo = $_POST['correo'];
  $pass = $_POST['pass'];
  try {
    $stmt = $conn->prepare("SELECT nombre, pass, id FROM usuarios WHERE correo = ? AND eliminado = 0 ");

    $stmt->bind_param("s", $correo);
    $stmt->execute();

    $stmt->bind_result($nombre_usuario, $pass_usuario, $id_usuario);
    $stmt->fetch();

  } catch (Exception $e) {
    echo $e->getMessage();
  }



  if($nombre_usuario){
      if(password_verify($pass, $pass_usuario)){
          session_start();

          $_SESSION['correo_usuario'] = $correo;
          $_SESSION['user'] = $nombre_usuario;
          $_SESSION['tipo_user'] = "usuario_logeado";
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
if(isset($_POST['tipo']) && ($_POST['tipo'] == "crear")){
  include "conexion.php";
  $correo = $_POST['correo'];
  $stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE correo = ? ");
  $stmt->bind_param("s", $correo);
  $stmt->execute();

  $stmt->bind_result($usuario_existe);
  $stmt->fetch();

  if($usuario_existe){
    $respuesta = array(
      "tipo" => "error",
      "respuesta" => "usuario ya registrado"
    );
    echo json_encode($respuesta);
  }else{

    try {
      $pass = $_POST['pass'];
      $nombre = $_POST['nombre'];
      $opciones = [
          'cost'=>12,
      ];
      $passHash = password_hash($pass,PASSWORD_BCRYPT,$opciones);
      $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, pass) VALUES (?,?,?) ");
      $stmt->bind_param("sss", $nombre, $correo, $passHash);
      $stmt->execute();

      if($stmt->affected_rows > 0){
        $respuesta = array(
          "tipo" => "correcto",
          "respuesta" => "usuario registrado correctamente"
        );
        session_start();
        $_SESSION['correo_usuario'] = $correo;
        $_SESSION['user'] = $nombre;
        $_SESSION['tipo_user'] = "usuario_logeado";
        $_SESSION['id'] = $stmt->insert_id;



        echo json_encode($respuesta);
      }else{
        $respuesta = array(
          "tipo" => "errorBD",
          "respuesta" => "Error al registrar el usuario"
        );
        echo json_encode($respuesta);
      }
    } catch (Exception $e) {
      echo "error! insercion: " .  $e->getMessage();
    }

  }
}

?>
