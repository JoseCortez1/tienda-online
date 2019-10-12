<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,800,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg" href="img/bug-solid.svg">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Programacion Web</title>
    <?php 
        $archivo = basename($_SERVER['PHP_SELF']); // basename= Devuelte el ultimo nomvre de una ruta
        $pagina = str_replace(".php", "", $archivo);
    ?>
</head>
<body class="<?php echo $pagina; ?>">


    

