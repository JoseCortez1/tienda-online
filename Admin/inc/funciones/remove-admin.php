<?php
    include 'conexion.php';

    $id = $_POST['id'];
    

    try {
        $stmt = $conn->prepare("UPDATE administradores SET eliminado = 1 WHERE id=? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
         $respuesta = array(
             'respuesta' => 'correcto'
         );

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => 'error'
        );
      
    }

    echo json_encode($respuesta);
    ?>