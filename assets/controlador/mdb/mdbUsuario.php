<?php

    include '../../modelo/metodosUser.php';
    session_start();

    function autenticarUsuario($email,$password){
        $ob = new User();
        $usuario = $ob->AutenticarUser($email,$password);
        return $usuario;
    }

    function insertarUsuario($nombre,$correo,$nick,$pass,$rol){
        $ob=new User();
        $usuario=new Usuario($nombre,$correo,$nick,$pass,$rol);
        $resultado=$ob->insertarUsuario($usuario);
        return $resultado;
    }

    function buscarUsuario($username)
{

    $dao = new User();
    $usuario = $dao->buscarUsuario($username);
    return $usuario;
}
    
    function modificarUsuario($nombre,$correo,$nickname,$password){
        $ob=new User();
        $rol = $_SESSION['rol'];

        $usuario=new Usuario($nombre,$correo,$nickname,$password,$rol);
        $resultado=$ob->modificarUsuario($usuario);
        return $resultado;
    }

  


?>