<?php
    session_start();
   
    unset($_SESSION['usuario']);
    unset($_SESSION['pass']);
    
    echo '<script>window.location.href = "index.php";</script>';
    exit();
?>