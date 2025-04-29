<?php
class Paciente {
    private $idPaciente;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $fechaNacimiento;
    
    public function __construct($idPaciente, $nombre, $apellido, $correo, $clave, $fechaNacimiento) {
        $this->idPaciente = $idPaciente;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    // Getters
    public function getIdPaciente() { return $this->idPaciente; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getCorreo() { return $this->correo; }
    public function getClave() { return $this->clave; }
    public function getFechaNacimiento() { return $this->fechaNacimiento; }
    
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