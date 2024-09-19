<?php
class ClaseConectar
{
    public $conexion;
    protected $db;
    private $host = "localhost";
    private $usuario = "root";
    private $pass = "root";
    private $base = "escuela";
    public function ProcedimientoParaConectar()
    {
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->pass, $this->base);
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        if ($this->conexion->connect_error) {
            die("Error: " . $this->conexion->connect_error);
        }
        $this->db = $this->conexion;
        if ($this->db == false) die("Error: " . $this->conexion->connect_error);

        return $this->conexion;
    }
}