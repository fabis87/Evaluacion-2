<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// TODO: controlador de profesores
require_once('../models/profesores.model.php');
error_reporting(0);
$profesores = new Profesores;

switch ($_GET["op"]) {
    // TODO: operaciones de profesores
    case 'buscar': // Procedimiento para cargar los datos de un profesor por ID
        if (!isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Professor ID not specified."]);
            exit();
        }
        $profesor_id = intval($_POST["profesor_id"]);
        $datos = array();
        $datos = $profesores->buscar($profesor_id);
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todos': // Procedimiento para cargar todos los datos de los profesores
        $datos = array();
        $datos = $profesores->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de un profesor por ID
        if (!isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Professor ID not specified."]);
            exit();
        }
        $profesor_id = intval($_POST["profesor_id"]);
        $datos = array();
        $datos = $profesores->uno($profesor_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un nuevo profesor en la base de datos
        if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["especialidad"]) || !isset($_POST["email"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];

        $datos = array();
        $datos = $profesores->insertar($nombre, $apellido, $especialidad, $email);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un profesor en la base de datos
        if (!isset($_POST["profesor_id"]) || !isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["especialidad"]) || !isset($_POST["email"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $profesor_id = intval($_POST["profesor_id"]);
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $email = $_POST["email"];

        $datos = array();
        $datos = $profesores->actualizar($profesor_id, $nombre, $apellido, $especialidad, $email);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un profesor en la base de datos
        if (!isset($_POST["profesor_id"])) {
            echo json_encode(["error" => "Professor ID not specified."]);
            exit();
        }
        $profesor_id = intval($_POST["profesor_id"]);
        $datos = array();
        $datos = $profesores->eliminar($profesor_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
