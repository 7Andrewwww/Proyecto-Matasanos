<?php
require_once "logica/Persona.php";

class Paciente extends Persona {
    private $fechaNacimiento;

    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $fechaNacimiento = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave);
        $this->fechaNacimiento = $fechaNacimiento;
    }

    // Getter y Setter específico de Paciente
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    // Método de autenticación
    public static function autenticar($correo) {
        $conexion = new Conexion();
        $conexion->abrir();
        
        $sentencia = "SELECT * FROM Paciente WHERE correo = '$correo'";
        $conexion->ejecutar($sentencia);
        
        $fila = $conexion->registro();
        $conexion->cerrar();
        
        if ($fila) {
            return new Paciente(
                $fila[0], // idPaciente
                $fila[1], // nombre
                $fila[2], // apellido
                $fila[3], // correo
                $fila[4], // clave
                $fila[5]  // fechaNacimiento
            );
        }
        return null;
    }
}
?>