<?php
require_once("logica/Persona.php");
require_once("persistencia/Conexion.php");
require_once("persistencia/MedicoDAO.php");

class Medico extends Persona {
    private $foto;
    private $especialidad;

    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $especialidad = ""){
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
        $this -> foto = $foto;
        $this -> especialidad = $especialidad;
    }

    public function getFoto() {
        return $this->foto;
    }
    
    public function getEspecialidad(){
        return $this -> especialidad;
    }
    
    public function consultarPorEspecialidad(){
        $conexion = new Conexion();
        $medicoDAO = new MedicoDAO();
        $conexion -> abrir();
        $conexion -> ejecutar($medicoDAO -> consultarPorEspecialidad($this ->  especialidad -> getId()));
        $medicos = array();
        while (($datos = $conexion->registro()) != null) {
            $medico = new Medico(
                $datos[0], // id
                $datos[1], // nombre
                $datos[2], // apellido
                $datos[3], // correo
                "",
                "",
                $this -> especialidad
            );
            array_push($medicos, $medico);
        }
        $conexion->cerrar();
        return $medicos;
    }


    
    public static function autenticar($correo) {
        $conexion = new Conexion();
        $conexion->abrir();
        
        $sentencia = "SELECT * FROM Medico WHERE correo = '$correo'";
        $conexion->ejecutar($sentencia);
        
        $fila = $conexion->registro();
        $conexion->cerrar();
        
        if ($fila) {
            // Asegúrate de que el constructor reciba todos los parámetros necesarios
            return new Medico(
                $fila[0], // idMedico
                $fila[1], // nombre
                $fila[2], // apellido
                $fila[3], // correo
                $fila[4], // clave
                $fila[5], // foto
                new Especialidad($fila[6]) // Especialidad
            );
        }
        return null;
    }

}

