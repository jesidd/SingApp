<?php
    include '../mdb/mdbUsuario.php';

    $email = $_POST['correo'];
    $password = $_POST['pass'];

    if($email && $password !=null){
        $errMsg = '';
       //username and password sent from Form
            
        $usuario = autenticarUsuario($email, $password);
        echo $username;

       if($usuario != null){ // Puede iniciar sesión
           session_start();
           $_SESSION['ROL'] = $usuario->getRol();
            $_SESSION['NOMBRE_USUARIO'] = $usuario->getNickname();
            $_SESSION['Nombre_Completo'] = $usuario ->getNombre();
            $_SESSION['CORREO'] = $usuario->getCorreo();
            $_SESSION['go'] = 'Inicio seccion correctamente';
            header("location: ../../sesion.php");
            
       }else{ // No puede iniciar sesión
            $_SESSION['error']= 'Usuario o contraseña incorrecta, intente nuevamente';
            header("location: ../../sesion.php");
       }

    }else{ //valores vacios
        $errMsg .= 'Username and Password are not found';
         $_SESSION['error']= $errMsg;
         header("location: ../../sesion.php");
    }
       


?>