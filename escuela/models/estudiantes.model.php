<?php
require_once('../config/conectar.php');
class Estudiantes
{
    // TODO: Implementar los métodos de la clase

    public function buscar($nombre) // select * from estudiantes where nombre = $nombre
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes` WHERE `nombre` = '$nombre'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from estudiantes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($estudiante_id) // select * from estudiantes where id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `estudiantes` WHERE `estudiante_id` = $estudiante_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $fecha_nacimiento, $grado) // insert into estudiantes
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `estudiantes`(`nombre`, `apellido`, `fecha_nacimiento`, `grado`) 
                       VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$grado')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Return the inserted ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($estudiante_id, $nombre, $apellido, $fecha_nacimiento, $grado) // update estudiantes
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `estudiantes` SET 
                       `nombre`='$nombre',
                       `apellido`='$apellido',
                       `fecha_nacimiento`='$fecha_nacimiento',
                       `grado`='$grado'
                       WHERE `estudiante_id` = $estudiante_id";
            if (mysqli_query($con, $cadena)) {
                return $estudiante_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($estudiante_id) // delete from estudiantes where id = $estudiante_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `estudiantes` WHERE `estudiante_id`= $estudiante_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Success
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
