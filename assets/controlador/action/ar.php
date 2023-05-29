<?php

    include '../mdb/mdbUsuario.php';
    

    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $clave = $_POST['password'];
    $nickname = $_POST['nickname'];
    

    $usuarioExistente = buscarUsuario($correo);
        


    if($usuarioExistente) {
        $mensaje = "¡Usuario ya existe!";
        
    }else{
      
        $usuario = insertarUsuario($nombre,$email,$nickname,$clave,2);
    
        $mensaje = "¡Usuario ingresado con exito!";
       

    }
    header("location: ../../vistas/dashboardAdmin.php");

?>