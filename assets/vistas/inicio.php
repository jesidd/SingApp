<?php //codigo q maneja el acceso a paginas solo cuando el usuario se loguea

    session_start();

    if(!isset($_SESSION['NOMBRE_USUARIO'])){
        echo 'debes iniciar seccion';
        session_destroy();
		header("Location: ../../vista/register.php");
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
</head>
<body>
    <p>Bienvenido</p>
</body>
</html>