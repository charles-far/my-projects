<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Iniciar sesión para ver contenido");</script>';
    echo '<script>window.location.href = "index.php"</script>';
} else {
    require_once('conn.php');
    $conn = conn::connect();
}

$query;
$title;
$tabla = filter_input(INPUT_GET, "tabla");
$id = filter_input(INPUT_GET, "id");

if (empty($tabla)) {
    $tabla = "dashboard";
}

switch ($tabla) {
    case "articulo":
        $query = mysqli_query($conn, "SELECT idArticulo as ID, numeroSerie as SERIE, nombre as NOMBRE, concat('Q. ', cast(precioVenta as char(20))) as PRECIO FROM articulo;");
        $title = "Artículos";
        break;
    case "categoria":
        $query = mysqli_query($conn, "SELECT idCategoria as ID, nombre as CATEGORIA from categoria;");
        $title = "Categorías";
        break;
    case "marca":
        $query = mysqli_query($conn, "SELECT idMarca as ID, nombre as MARCA from marca;");
        $title = "Marcas";
        break;
    case "proveedor":
        $query = mysqli_query($conn, "SELECT idProveedor as ID, nombre as NOMBRE, correoElectronico as CORREO from proveedor;");
        $title = "Proveedores";
        break;
    case "cliente":
        $query = mysqli_query($conn, "SELECT idCliente as ID, nit as NIT, nombre as NOMBRE, apellido as APELLIDO, telefono as TELEFONO, direccion as DIRECCION from cliente;");
        $title = "Clientes";
        break;
    default:
        $query = mysqli_query($conn, "SELECT 'Seleccione una opción del detalle a su izquierda' as DASHBOARD;");
        $title = "dashboard";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/shop.ico">

        <title>Dashboard</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/dashboard.css" rel="stylesheet">

    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Súper Mercado</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li>
                            <a href="salir.php">
                                <button type="button" class="btn btn-danger">Salir</button>
                            </a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="index.php">Inicio <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Analytics</a></li>
                        <li><a href="#">Export</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">Tablas <span class="sr-only">(current)</span></a></li>
                        <?php
                        echo '<li><a href="dashboard.php?tabla=categoria">Categorías</a></li>';
                        echo '<li><a href="dashboard.php?tabla=articulo">Artículos</a></li>';
                        echo '<li><a href="dashboard.php?tabla=marca">Marcas</a></li>';
                        echo '<li><a href="dashboard.php?tabla=proveedor">Proveedores</a></li>';
                        echo '<li><a href="dashboard.php?tabla=cliente">Clientes</a></li>';
                        ?>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Dashboard</h1>
                    <h2 class="sub-header">
                        <?php
                        echo $title;
                        ?>
                    </h2>
                    <?php
                    if ($tabla != "dashboard") {
                        echo '<div align="right">';
                        // Tomado de https://www.w3schools.com/bootstrap/bootstrap_modal.asp
                        echo '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Agregar</button>';
                        echo '</div>';
                    }
                    ?>
                    
                    <div class="table-responsive">
                        <?php
                        if (empty($id)) {
                            echo '<form action="controller/agregar.php" method="post">';
                            echo '<input type="hidden" name="tabla" value="' . $tabla . '">';
                        } else {
                            echo '<form action="controller/actualizar.php" method="post">';
                            echo '<input type="hidden" name="tabla" value="' . $tabla . '">';
                            echo '<input type="hidden" name="id" value="' . $id . '">';
                        }
                        ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <?php
                                    $encabezado = mysqli_fetch_fields($query);

                                    foreach ($encabezado as $key => $val) {
                                        echo '<th>' . $val->name . '</th>';
                                    }

                                    if ($tabla != "dashboard") {
                                        echo '<th colspan="2" align="justify">Operaciones</th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $columns = array();
                                while ($registro = mysqli_fetch_row($query)) {
                                    echo '<tr>';

                                    if ($registro[0] === $id) {
                                        foreach ($registro as $key => $value) {
                                            if ($key === 0) {
                                                echo '<td>' . $value . '</td>';
                                            }
                                            else {
                                                echo '<td><input type="text" class="form-control" name=col_' . $key . '" value="' . $value . '"></td>';
                                            }
                                        }
                                    } else {
                                        if (count($columns) > 0) {
                                            foreach ($registro as $key => $value) {
                                                echo '<td>' . $value . '</td>';
                                            }
                                        } else {
                                            foreach ($registro as $key => $value) {
                                                echo '<td>' . $value . '</td>';
                                                $columns[] = $key;
                                            }                                            
                                        }
                                    }

                                    if ($registro[0] === $id) {
                                        if ($tabla != "dashboard") {
                                            echo '<td><a href="dashboard.php?tabla=' . $tabla . '">Cancelar</a></td>';
                                            //echo '<td><a disabled href="controller/actualizar.php?tabla=' . $tabla . '&id=' . $registro[0] . '">Grabar cambio</a></td>';
                                            echo '<td><button type="submit" class="btn btn-default">Actualizar</a></td>';
                                        }
                                    } else {
                                        if ($tabla != "dashboard") {
                                            echo '<td><a href="dashboard.php?tabla=' . $tabla . '&id=' . $registro[0] . '">Editar</a></td>';
                                            echo '<td><a href="controller/eliminar.php?tabla=' . $tabla . '&id=' . $registro[0] . '">Eliminar</a></td>';
                                        }
                                    }
                                    
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Tomado de https://www.w3schools.com/bootstrap/bootstrap_modal.asp -->
                        <div class="container">
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Agregar</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo '<table class="table table-striped">';
                                            echo '<thead>';
                                            echo '<tr>';
                                            $encabezado2 = mysqli_fetch_fields($query);
                                            foreach ($encabezado2 as $key => $val) {
                                                if ($key != 0) {
                                                    echo '<th>' . $val->name . '</th>';
                                                }
                                            }
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                            echo '<tr>';
                                            for ($index = 0; $index < count($columns) - 1; $index++) {
                                                echo '<td><input type="text" class="form-control" name=agr_' . $columns[$index] . '"></td>';
                                            }
                                            echo '</tr>';
                                            echo '</tbody>';
                                            echo '</table>';
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default">Grabar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        echo '</form>'
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>');</script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>