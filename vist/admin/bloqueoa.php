<?php

    if(isset($_GET['variable1'])){

        $secreto = $_GET['variable1'];

        $correo = "juan.vega18@misena.edu.co";
        $paracorreo = $correo;
        $titulo ="Bloqueo de cuenta";
        $msj = "Administrador su cuenta acaba de ser bloqueada por motivos de seguridad, por favor vaya al siguiente enlace para poder habilitar su cuenta: http://localhost/taller_motos/controller/validaciones/habilitar.php";
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