<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Iniciar sesión para ver contenido");</script>';
    echo '<script>window.location.href = "../index.php"</script>';
} else {
    require_once('../conn.php');
    $conn = conn::connect();
}

$query;
$parametros = array();

foreach (filter_input_array(INPUT_POST) as $key => $value) {
    $parametros[] = $value;
}

//print "<pre>";
//print_r($parametros);
//print "</pre>";

$tabla = $parametros[0];

//$query = "INSERT INTO articulo (numeroSerie, nombre, precioVenta) VALUES ('" . $parametros[1] . "', '" . $parametros[2] . "', " . str_replace("Q. ", "", $parametros[3]) . ");";
//echo $query;


if (empty($tabla)) {
    $tabla = "dashboard";
}

switch ($tabla) {
    case "articulo":
        $query = mysqli_query($conn, "INSERT INTO articulo (numeroSerie, nombre, precioVenta) VALUES ('" . $parametros[1] . "', '" . $parametros[2] . "', " . str_replace("Q. ", "", $parametros[3]) . ");");
        echo '<script>window.location.href = "../dashboard.php?tabla=articulo";</script>';
        break;
    case "categoria":
        $query = mysqli_query($conn, "INSERT INTO categoria (nombre) VALUES ('" . $parametros[1] . "');");
        echo '<script>window.location.href = "../dashboard.php?tabla=categoria";</script>';
        break;
    case "marca":
        $query = mysqli_query($conn, "INSERT INTO marca (nombre) VALUES ('" . $parametros[1] . "');");
        echo '<script>window.location.href = "../dashboard.php?tabla=marca";</script>';
        break;
    case "proveedor":
        $query = mysqli_query($conn, "INSERT INTO proveedor (nombre, correoElectronico) VALUES ('" . $parametros[1] . "', '" . $parametros[2] . "');");
        echo '<script>window.location.href = "../dashboard.php?tabla=proveedor";</script>';
        break;
    case "cliente":
        $query = mysqli_query($conn, "INSERT INTO cliente (nit, nombre, apellido, telefono, direccion) VALUES ('" . $parametros[1] . "', '" . $parametros[2] . "', '" . $parametros[3] . "', '" . $parametros[4] . "', '" . $parametros[5] . "');");
        echo '<script>window.location.href = "../dashboard.php?tabla=cliente";</script>';
        break;
    default:
        echo '<script>window.location.href = "../dashboard.php";</script>';
        break;
}