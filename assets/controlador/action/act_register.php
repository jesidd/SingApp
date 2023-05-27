<?php

    include '../mdb/mdbUsuario.php';
    

    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $clave = $_POST['password'];
    $nickname = $_POST['nickname'];
    

    if($nombre && $clave && $email && $nickname != null){
        $usuario = insertarUsuario($nombre,$email,$nickname,$clave);

        if($usuario != null){
            $msg = 'Se registro correctamente';
            session_start();
            $_SESSION['msg']=$msg;
        }else{
            $errMsg .= 'Correo o nickname ya se encuentra registrado';
            session_start();
            $_SESSION['error']=$errMsg;
        }
    }else{
        $errMsg .= 'Registro fallido';
        session_start();
        $_SESSION['error']=$errMsg;
    }

    header("location: ../../sesion.php");

?>