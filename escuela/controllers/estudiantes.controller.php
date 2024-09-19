<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// TODO: controlador de estudiantes
require_once('../models/estudiantes.model.php');
error_reporting(0);
$estudiantes = new Estudiantes;

switch ($_GET["op"]) {
    // TODO: operaciones de estudiantes
    case 'buscar': // Procedimiento para cargar los datos de un estudiante
        if (!isset($_POST["estudiante_id"])) {
            echo json_encode(["error" => "Student ID not specified."]);
            exit();
        }
        $estudiante_id = intval($_POST["estudiante_id"]);
        $datos = array();
        $datos = $estudiantes->buscar($estudiante_id);
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todos': // Procedimiento para cargar todos los datos de los estudiantes
        $datos = array();
        $datos = $estudiantes->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de la base de datos
        if (!isset($_POST["estudiante_id"])) {
            echo json_encode(["error" => "Student ID not specified."]);
            exit();
        }
        $estudiante_id = intval($_POST["estudiante_id"]);
        $datos = array();
        $datos = $estudiantes->uno($estudiante_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un estudiante en la base de datos
        if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["fecha_nacimiento"]) || !isset($_POST["grado"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $grado = $_POST["grado"];

        $datos = array();
        $datos = $estudiantes->insertar($nombre, $apellido, $fecha_nacimiento, $grado);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un estudiante en la base de datos
        if (!isset($_POST["estudiante_id"]) || !isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["fecha_nacimiento"]) || !isset($_POST["grado"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $estudiante_id = intval($_POST["estudiante_id"]);
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $grado = $_POST["grado"];

        $datos = array();
        $datos = $estudiantes->actualizar($estudiante_id, $nombre, $apellido, $fecha_nacimiento, $grado);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un estudiante en la base de datos
        if (!isset($_POST["estudiante_id"])) {
            echo json_encode(["error" => "Student ID not specified."]);
            exit();
        }
        $estudiante_id = intval($_POST["estudiante_id"]);
        $datos = array();
        $datos = $estudiantes->eliminar($estudiante_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
