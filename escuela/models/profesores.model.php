<?php
require_once('../config/conectar.php');
class Profesores
{
    // TODO: Implementar los métodos de la clase

    public function buscar($profesor_id) // select * from profesores where profesor_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `profesores` WHERE `profesor_id` = $profesor_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from profesores
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `profesores`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($profesor_id) // select * from profesores where profesor_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `profesores` WHERE `profesor_id` = $profesor_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $especialidad, $email) // insert into profesores
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `profesores`(`nombre`, `apellido`, `especialidad`, `email`) 
                       VALUES ('$nombre', '$apellido', '$especialidad', '$email')";
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

    public function actualizar($profesor_id, $nombre, $apellido, $especialidad, $email) // update profesores
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `profesores` SET 
                       `nombre`='$nombre',
                       `apellido`='$apellido',
                       `especialidad`='$especialidad',
                       `email`='$email'
                       WHERE `profesor_id` = $profesor_id";
            if (mysqli_query($con, $cadena)) {
                return $profesor_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($profesor_id) // delete from profesores where profesor_id = $profesor_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `profesores` WHERE `profesor_id` = $profesor_id";
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
