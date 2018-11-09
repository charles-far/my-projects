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

$tabla = filter_input(INPUT_GET, "tabla");
$id = filter_input(INPUT_GET, "id");

if (empty($tabla)) {
    $tabla = "dashboard";
}

switch ($tabla) {
    case "articulo":
        $query = mysqli_query($conn, "DELETE FROM articulo WHERE idArticulo = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=articulo";</script>';
        break;
    case "categoria":
        $query = mysqli_query($conn, "DELETE FROM categoria WHERE idCategoria = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=categoria";</script>';
        break;
    case "marca":
        $query = mysqli_query($conn, "DELETE FROM marca WHERE idMarca = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=marca";</script>';
        break;
    case "proveedor":
        $query = mysqli_query($conn, "DELETE FROM proveedor WHERE idProveedor = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=proveedor";</script>';
        break;
    case "cliente":
        $query = mysqli_query($conn, "DELETE FROM cliente WHERE idCliente = " . $id . ";");
        echo '<script>window.location.href = "../dashboard.php?tabla=cliente";</script>';
        break;
    default:
        echo '<script>window.location.href = "../dashboard.php";</script>';
        break;
}