<?php

require_once ("../../bd/conexion.php");
$db = new Database();
$conectar = $db->conectar();

if(isset($_GET['variable'])){

    $cedula = $_GET['variable'];

    $consul = $conectar -> prepare("SELECT * FROM usuarios WHERE documento = '$cedula'");
    $consul -> execute();
    $con = $consul -> fetch(PDO::FETCH_ASSOC);

    $cor = $con['email'];

    $correo = $cor;
    $paracorreo = $correo;
    $titulo ="Recordatorio";
    $msj = "Usuario alguno de sus servicios contratos por nosotros estan proximos a vencer";
    $tucorreo="From:juan.vega18@misena.edu.co";
    if(mail($paracorreo, $titulo, $msj, $tucorreo))
    {
        echo'<script>alert("Correo enviado con exito");</script>';
        echo '<script> window.location="../../index.html"</script>';
        exit();
    }
    else{
        echo'<script>alert("ERROR, intentelo nuevamente");</script>';
        echo '<script> window.location="../../index.html"</script>';
        exit();
    }
}
?>