<?php
    require_once ("../../bd/conexion.php");
    $db = new database();
    $conec = $db -> conectar();

    $docu = $_POST['docu'];

    $consul = $conec -> prepare("SELECT email FROM usuarios WHERE documento = '$docu'");
    $consul -> execute();
    $cons = $consul -> fetch(PDO::FETCH_ASSOC);

    $correo = $cons['email'];
    $paracorreo = $correo;
    $titulo ="Recuperacion de contraseña";
    $msj = "Para cambiar tu contraseña da click en el siguiente link: http://localhost/taller_motos/controller/validaciones/contraseña.php";
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

?>