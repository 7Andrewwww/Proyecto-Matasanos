<?php

class MedicoDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $idEspecialidad;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $idEspecialidad = 0){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> idEspecialidad = $idEspecialidad;
    }

    public function consultarPorEspecialidad($idEspecialidad){
        return "select idMedico, nombre, apellido, correo
                from Medico 
                where Especialidad_idEspecialidad = $idEspecialidad
                order by apellido asc";
    }
}
