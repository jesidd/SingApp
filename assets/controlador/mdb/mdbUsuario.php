<?php

    include '../../modelo/metodosUser.php';
    session_start();

    function autenticarUsuario($email,$password){
        $ob = new User();
        $usuario = $ob->AutenticarUser($email,$password);
        return $usuario;
    }

    function insertarUsuario($nombre,$correo,$nick,$pass){
        $ob=new User();
        $usuario=new Usuario($nombre,$correo,$nick,$pass,2);
        $resultado=$ob->insertarUsuario($usuario);
        return $resultado;
    }
    
    function modificarUsuario($username,$correo,$pass){
        $ob=new User();
        $id = $_SESSION['id'];

        $usuario=new Usuario($id,$username,$correo,$pass);
        $resultado=$ob->modificarUsuario($usuario);
        return $resultado;
    }

    function borrarUsuario($username,$password){
        $ob= new User();
        $id = $_SESSION['id'];

        $usuario= new Usuario($id,$username," ",$password);
        $resultado=$ob->borrarUsuario($usuario);
        return $resultado;
    }


?>