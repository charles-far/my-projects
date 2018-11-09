<?php
session_start(); //Recupera sesión
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <title>Súper Mercado Virtual</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/jumbotron.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Súper Mercado Virtual</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                        echo'<form class="navbar-form navbar-right" action="salir.php">
                        <div class="form-group">
                            <input name="usuario" class="form-control" value="' . $_SESSION['usuario'] . '" readonly>
                        </div>
                        <div class="form-group">
                        </div>
                        <button type="submit" class="btn btn-warning">Salir</button>
                      </form>';
                    } else {
                        echo'<form class="navbar-form navbar-right" action="acceso.php" method="post">
                        <div class="form-group">
                            <input name="usuario" type="text" placeholder="Usuario" class="form-control">
                        </div>
                        <div class="form-group">
                          <input name="pass" type="password" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Ingresar</button>
                      </form>';
                    }
                    ?>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Supermercado Virtual</h1>
                <p>Esta es una plantilla para un sitio web simple de mercadeo o informativo. Incluye las utilidades llamadas jumbotron y tres piezas de soporte de contenido. Usalo como el punto de partida para crear algo &uacute;nico.</p>
                <p><a class="btn btn-primary btn-lg" href="dashboard.php" role="button">Dashboard &raquo;</a></p>
            </div>
        </div>

        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/byb.jpg" alt="B&B">
                    </div>

                    <div class="item">
                        <img src="img/incaparina.jpg" alt="Incaparina">
                    </div>

                    <div class="item">
                        <img src="img/sasson.jpg" alt="Sasson">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>B&B</h2>
                    <p align="justify">Somos un equipo motivado por mantener el compromiso de alta satisfacción de nuestros clientes a través de productos de excelente calidad y servicio a precios competitivos. Al mismo tiempo mantener una innovación continua de los productos, la calidad y el servicio, reiterando a nuestros colaboradores el compromiso de un crecimiento compartido.</p>
                    <p><a class="btn btn-default" target="_blank" href="http://byb.com.gt/be/?page_id=136" role="button">Ver detalles &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Sasson</h2>
                    <p align="justify">Grupo Alza fue fundada en 1983, nació con el propósito de comercializar productos alimenticios, iniciando con la fabricación de especies y condimentos. Desde sus inicios sus fundadores Don Roberto y Doña María Anita Bueso le imprimieron a la empresa un carácter humano y de servicio, con una visión de gran alcance basado en la constante innovación de productos de alta calidad y genuina presentación.</p>
                    <p><a class="btn btn-default" target="_blank" href="http://www.grupoalza.com/qui%C3%A9nes-somos" role="button">Ver detalles &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Incaparina</h2>
                    <p align="justify">INCAPARINA es un alimento de alto valor nutritivo que consiste en una mezcla 100% vegetal elaborada a base de harina de maíz y harina de soya en las cantidades apropiadas para obtener una fuente de proteína completa. Fortificada con vitaminas y minerales esenciales, Hierro y Zinc de alta calidad.</p>
                    <p><a class="btn btn-default" target="_blank" href="http://www.centraldealimentos.com/marcas/incaparina/" role="button">Ver detalles &raquo;</a></p>
                </div>
            </div>
            
            <hr>

            <footer>
                <p>&copy; 2016 Company, Inc.</p>
            </footer>
        </div> <!-- /container -->
        
        <!-- Slider -->



        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>');</script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
