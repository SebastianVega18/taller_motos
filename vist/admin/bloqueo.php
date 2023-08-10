<?php
    require_once ("../../bd/conexion.php");
    session_start();

    $db = new database();
    $conectar = $db -> conectar();

    if(isset($_GET['variable'])){

        $cedula = $_GET['variable'];

        $con = $conectar -> prepare("SELECT usuario FROM usuarios WHERE documento = '$cedula'");
        $con -> execute();
        $cons = $con ->fetch(PDO::FETCH_ASSOC);
    
        $correo = "juan.vega18@misena.edu.co";
        $paracorreo = $correo;
        $titulo ="Usuario bloqueo";
        foreach($cons as $usu){
        $msj = "Administrador se acaba de inavilitar el usuario: ".$usu. " por exceder el numero establecido de intentos, por favor revise y habilitelo nuevamente";
        }
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