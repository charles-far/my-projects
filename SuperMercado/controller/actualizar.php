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

$tabla = $parametros[0];
$id = $parametros[1];

if (empty($tabla)) {
    $tabla = "dashboard";
}

switch ($tabla) {
    case "articulo":
        $query = mysqli_query($conn, "UPDATE articulo SET numeroSerie = '" . $parametros[2] . "', nombre = '" . $parametros[3] . "', precioVenta = " . str_replace("Q. ", "", $parametros[4]) . " where idArticulo = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=articulo";</script>';
        break;
    case "categoria":
        $query = mysqli_query($conn, "UPDATE categoria SET nombre = '" . $parametros[2] . "' WHERE idCategoria = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=categoria";</script>';
        break;
    case "marca":
        $query = mysqli_query($conn, "UPDATE marca SET nombre = '" . $parametros[2] . "' WHERE idMarca = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=marca";</script>';
        break;
    case "proveedor":
        $query = mysqli_query($conn, "UPDATE proveedor SET nombre = '" . $parametros[2] . "', correoElectronico = '" . $parametros[3] . "' WHERE idProveedor = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=proveedor";</script>';
        break;
    case "cliente":
        $query = mysqli_query($conn, "UPDATE cliente SET nit = '" . $parametros[2] . "', nombre = '" . $parametros[3] . "', apellido = '" . $parametros[4] . "', telefono = '" . $parametros[5] . "', direccion = '" . $parametros[6] . "' WHERE idCliente = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=cliente";</script>';
        break;
    default:
        echo '<script>window.location.href = "../dashboard.php";</script>';
        break;
}