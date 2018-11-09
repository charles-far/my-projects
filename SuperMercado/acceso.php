<?php
session_start(); //Inicia sesión

$usu = filter_input(INPUT_POST, "usuario");
$pass = filter_input(INPUT_POST, "pass");
$rowcount; /* Almacena la cantidad de registros obtenidos */

require_once('conn.php');
$conn = conn::connect();
$query = mysqli_query($conn, "SELECT * FROM usuario where nombreUsuario = '" . $usu . "' and contrasena = '" . $pass . "';");

$rowcount = mysqli_num_rows($query);

//while ($registro = mysqli_fetch_row($query)) {
//    //echo '|idUsuario: ' . $registro[0] . '|activo: ' . $registro[1] . '|nombre: ' . $registro[2] . '|pass: ' . $registro[3] . "|";
//    //echo $pass;
//    $passDB = $registro[3];
//}

if ($rowcount === 1) {
    $_SESSION['usuario'] = $usu;
    $_SESSION['pass'] = $pass;
    
    $usu = $_SESSION['usuario'];
    $pass = $_SESSION['pass'];
    
    echo '<script>alert("Bienvenido ' .$usu. '")</script>';
    ////echo '<script>window.history.back()</script>';
    echo '<script>window.location.href = "dashboard.php";</script>';
}
else {
    echo '<script>alert("revise su contraseña")</script>';
    //echo '<script>window.history.back()</script>';
}