<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Iniciar sesión para ver contenido");</script>';
    echo '<script>window.location.href = "index.php"</script>';
} else {
    require_once('conn.php');
    $conn = conn::connect();
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
                    <a class="navbar-brand" href="#">Artículos fdf</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Help</a></li>
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
                        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Analytics</a></li>
                        <li><a href="#">Export</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><a href="">Artículos</a></li>
                        <li><a href="">Nav item again</a></li>
                        <li><a href="">One more nav</a></li>
                        <li><a href="">Another nav item</a></li>
                        <li><a href="">More navigation</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><a href="">Nav item again</a></li>
                        <li><a href="">One more nav</a></li>
                        <li><a href="">Another nav item</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Artículos</h1>

                    <h2 class="sub-header">Artículos almacenados</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <?php
                                $query = mysqli_query($conn, "SELECT idArticulo as ID, numeroSerie as SERIE, nombre as NOMBRE, concat('Q. ', cast(precioVenta as char(20))) as PRECIO FROM articulo;");
                                $encabezado = mysqli_fetch_fields($query);

                                foreach ($encabezado as $key => $val) {
                                        echo '<th>' . $val->name . '</th>';
                                }

                                echo '<th>Edición</th>';
                                echo '<th>Eliminación</th>';
                                ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($registro = mysqli_fetch_row($query)) {
                                    echo '<tr>';
                                    foreach ($registro as $value) {
                                        echo '<td>' . $value . '</td>';
                                    }
                                    echo '<td><a href="#">Editar</a></td>';
                                    echo '<td><a href="#">Eliminar</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
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
    <?php
//                                foreach ($encabezado as $key => $val) {
//                                    if ($key === 0 || $key === 3 || $key === 4 || $key === 6) {
//                                        echo '<th>' . $val->name . '</th>';
//                                    }
//                                }
    ?>
</html>