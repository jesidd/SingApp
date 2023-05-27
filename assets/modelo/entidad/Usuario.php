<?php


/**
 * Usuario
 */
class Usuario
{
    private $nombre;
    private $correo;
    private $nickname;
    private $password;
    private $rol;

    public function __construct($nombre,$correo,$nickname,$password,$rol){
        $this->nickname = $nickname;
        $this->rol = $rol;
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->password = $password;
    }
    
    public function setNickname($nick)
    {
        $this->nickname = $nick;

        return $this;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setNombre($name)
    {
        $this->nombre = $name;

        return $this;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

        
    public function toArray() {
        $vars = get_object_vars ( $this );
        $array = array ();
        foreach ( $vars as $key => $value ) {
            $array [ltrim ( $key, '_' )] = $value;
        }
        return $array;
    }
}