<?php
require_once('../config/conectar.php');
class Asignaciones
{
    // TODO: Implementar los métodos de la clase

    public function buscar($asignacion_id) // select * from asignaciones
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `asignaciones` WHERE `asignacion_id` = $asignacion_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from asignaciones
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `asignaciones`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($asignacion_id) // select * from asignaciones where id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `asignaciones` WHERE `asignacion_id` = $asignacion_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($estudiante_id, $profesor_id) // insert into asignaciones
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `asignaciones`(`estudiante_id`, `profesor_id`) 
                       VALUES ($estudiante_id, $profesor_id)";
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

    public function actualizar($asignacion_id, $estudiante_id, $profesor_id) // update asignaciones
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `asignaciones` SET 
                       `estudiante_id`=$estudiante_id,
                       `profesor_id`=$profesor_id
                       WHERE `asignacion_id` = $asignacion_id";
            if (mysqli_query($con, $cadena)) {
                return $asignacion_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($asignacion_id) // delete from asignaciones where id = $asignacion_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `asignaciones` WHERE `asignacion_id`= $asignacion_id";
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
