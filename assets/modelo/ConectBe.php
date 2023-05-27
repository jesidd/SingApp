<?php

    class ConectBe{
    
        private $conexion;
        private $cadenaConexion;
    
        public function __construct(){
            $this->cadenaConexion ='mysql:host=localhost;dbname=singapp;charset=utf8';
            $this->conexion = new PDO($this->cadenaConexion,'root','');      
        }

        public function ejecutarConsulta($sql="",$values=array()){
            if($sql != ""){
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute($values);
                $tabla_datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                $this->conexion=null;
                return $tabla_datos;
            }else{
                return 0;
            }
        }

        public function ejecutarActualizacion($sql="", $values=array()){
            if($sql != ""){
                $consulta=$this->conexion->prepare($sql);
                $consulta->execute($values);
                $numero_tablas_afectadas = $consulta->rowCount();
                $this->conexion=null;
                return $numero_tablas_afectadas;
            }else{
                return 0;
            }
        }
        
      }

?>