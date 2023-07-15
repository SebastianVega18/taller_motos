<?php
    require_once("../../../bd/conexion.php");

    $conectar = new database;
    $db = $conectar -> conectar();

    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];

    $consul = $db -> prepare("SELECT barcode FROM barcode WHERE barcode = '$codigo'");
    $consul -> execute();
    $resul = $consul -> fetch();



    if($resul==true){
        echo '<script>alert ("¡ERROR!, el codigo de barras ya exite");</script>';
        echo '<script> window.location="../barcode.php"</script>';
    }
    elseif($nombre == "" || $codigo == ""){ 
        echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
        echo '<script> window.location="../barcode.php"</script>';
    }
    else{

        $insert = $db -> prepare("INSERT INTO barcode (nombre,barcode) VALUE (?,?)");
        $insert -> execute([$nombre,$codigo]);

        header("location: ../barcode.php");
    }
?>