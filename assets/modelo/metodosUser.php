<?php

include 'ConectBe.php';
include '../../modelo/entidad/Usuario.php';

class User{

    public function AutenticarUser($email,$pass){
        $conectbe = new ConectBe();

        $data_table= $conectbe->ejecutarConsulta("SELECT * FROM usuario WHERE correo = :email AND contraseña = :pass", 
                                                    array(':email'=>$email,':pass'=>$pass));
        $usuario= null;
        if(count($data_table)==1){
            foreach($data_table as $indice => $valor){
                $usuario = new Usuario(
                        $data_table[$indice]["nombre"],
                        $data_table[$indice]["correo"],
                        $data_table[$indice]["nickname"],
                        $data_table[$indice]["contraseña"],
                        $data_table[$indice]["rol_idrol"],
                        );
            }
            return $usuario;
        }else{
            return null;
        }

    }

    public function verificarExistente($correo, $nick){
        $conectbe = new ConectBe();
        
        $data_table= $conectbe->ejecutarConsulta("SELECT * FROM usuario WHERE correo = :correo OR nickname = :nick", 
                                                    array(':nick'=>$nick,':correo'=>$correo));
        $usuario= null;
        if(count($data_table)==1){
            foreach($data_table as $indice => $valor){
                $usuario = new Usuario(
                    $data_table[$indice]["nombre"],
                    $data_table[$indice]["correo"],
                    $data_table[$indice]["nickname"],
                    $data_table[$indice]["contraseña"],
                    $data_table[$indice]["rol_idrol"],
                        );
            }
            return $usuario;
        }else{
            return null;
        }

    }

    public function insertarUsuario(Usuario $usuario){
        $data_source= new ConectBe();

        $iguales = $this->verificarExistente($usuario->getCorreo(),$usuario->getNickname());

        if($iguales == null){
            $sql = "INSERT INTO usuario (nombre, correo, nickname, contraseña, rol_idrol) VALUES ( :nombre, :correo, :nick, :password, :rol)";
            $resultado = $data_source->ejecutarActualizacion($sql, array(
                ':nombre'=>$usuario->getNombre(),
                ':correo'=>$usuario->getCorreo(),
                ':nick'=>$usuario->getNickname(),
                ':password'=>$usuario->getPassword(),
                ':rol'=>$usuario->getRol()
                )
            );
            return $resultado;
        }else{
            $errMsg .= 'correo o nickname already existing';
            return null;
        }
    }

    /*
    public function buscarUsuarioPorUser($username){
        $data_source = new ConectBe();
        $data_table= $data_source->ejecutarConsulta("SELECT * FROM usuarios WHERE usuario = :username", 
                                                    array(':username'=>$username));
        $usuario=null;
        if(count($data_table)==1){
            foreach($data_table as $indice => $valor){
                $usuario = new Usuario(
                    $data_table[$indice]["id"],
                    $data_table[$indice]["usuario"],
                    $data_table[$indice]["correo"],
                    $data_table[$indice]["password"]
                    );
            }
            return $usuario;
        }else{
            return null;
        }
    }    

    public function buscarUsuarioPorId($id){
        $data_source = new ConectBe();

        $data_table= $data_source->ejecutarConsulta("SELECT * FROM usuarios WHERE id = :id", 
                                                    array(':id'=>$id));
        $usuario=null;
        if(count($data_table)==1){
            foreach($data_table as $indice => $valor){
                $usuario = new Usuario(
                    $data_table[$indice]["id"],
                    $data_table[$indice]["usuario"],
                    $data_table[$indice]["correo"],
                    $data_table[$indice]["password"]
                    );
            }
            return $usuario;
        }else{
            return null;
        }
    }    
    
    public function verificarExistenteExcpt($username, $correo,$id){
        $conectbe = new ConectBe();

        $data_table= $conectbe->ejecutarConsulta("SELECT * FROM usuarios WHERE id <> $id AND ( usuario = :user OR correo = :correo )", 
                                                    array(':user'=>$username,':correo'=>$correo));
        $usuario= null;
        if(count($data_table)==1){
            foreach($data_table as $indice => $valor){
                $usuario = new Usuario(
                        $data_table[$indice]["id"],
                        $data_table[$indice]["usuario"],
                        $data_table[$indice]["correo"],
                        $data_table[$indice]["password"]
                        );
            }
            return $usuario;
        }else{
            return null;
        }

    }*/

    /*
    public function modificarUsuario(Usuario $usuario){
        $data_source= new ConectBe();

        //$usuarioFirst = $this->buscarUsuarioPorUser($usuario->getUsername());$usuarioFirst->getId()
        
        $iguales = $this->verificarExistenteExcpt($usuario->getUsername(),$usuario->getCorreo(),$usuario->getId());//verifica si los datos de confirmacion son los mismos del usuario

        if($iguales == null){
            $sql = "UPDATE usuarios SET "
            . " usuario= :username, "
            . " correo= :correo, "
            . " password= :password"
            . " WHERE id= :id";
            $resultado = $data_source->ejecutarActualizacion($sql, array(
            ':username'=>$usuario->getUsername(),
            ':correo'=>$usuario->getCorreo(),
            ':password'=>$usuario->getPassword(),
            ':id'=>$usuario->getId()
              )
            );
        }else{
            $resultado = null;
        }

        return $resultado;
    }
    */

}


?>