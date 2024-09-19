<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// TODO: controlador de asignaciones
require_once('../models/asignaciones.model.php');
error_reporting(0);
$asignaciones = new Asignaciones;

switch ($_GET["op"]) {
    // TODO: operaciones de asignaciones
    case 'buscar': // Procedimiento para cargar los datos de una asignación
        if (!isset($_POST["asignacion_id"])) {
            echo json_encode(["error" => "Assignment ID not specified."]);
            exit();
        }
        $asignacion_id = intval($_POST["asignacion_id"]);
        $datos = array();
        $datos = $asignaciones->buscar($asignacion_id);
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todos': // Procedimiento para cargar todos los datos de las asignaciones
        $datos = array();
        $datos = $asignaciones->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de la base de datos
        if (!isset($_POST["asignacion_id"])) {
            echo json_encode(["error" => "Assignment ID not specified."]);
            exit();
        }
        $asignacion_id = intval($_POST["asignacion_id"]);
        $datos = array();
        $datos = $asignaciones->uno($asignacion_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar una asignación en la base de datos
        if (!isset($_POST["estudiante_id"]) || !isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $estudiante_id = intval($_POST["estudiante_id"]);
        $profesor_id = intval($_POST["profesor_id"]);

        $datos = array();
        $datos = $asignaciones->insertar($estudiante_id, $profesor_id);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar una asignación en la base de datos
        if (!isset($_POST["asignacion_id"]) || !isset($_POST["estudiante_id"]) || !isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $asignacion_id = intval($_POST["asignacion_id"]);
        $estudiante_id = intval($_POST["estudiante_id"]);
        $profesor_id = intval($_POST["profesor_id"]);

        $datos = array();
        $datos = $asignaciones->actualizar($asignacion_id, $estudiante_id, $profesor_id);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar una asignación en la base de datos
        if (!isset($_POST["asignacion_id"])) {
            echo json_encode(["error" => "Assignment ID not specified."]);
            exit();
        }
        $asignacion_id = intval($_POST["asignacion_id"]);
        $datos = array();
        $datos = $asignaciones->eliminar($asignacion_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
