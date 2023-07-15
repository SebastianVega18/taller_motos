<?php
    require_once ("../../bd/conexion.php");


    $db = new database();
    $conec = $db -> conectar();

    // echo $_POST['elimi'];

    $elimi = $conec -> prepare ("DELETE FROM detalle_venta WHERE id_detallev = '".$_POST['elimi']."'");
    $elimi -> execute();

    if ((isset($_POST["elimi"]))){

        $elimi = $conec -> prepare ("DELETE FROM detalle_venta WHERE id_detallev = '".$_POST['elimi']."'");
        $elimi -> execute();

        echo '<script>alert ("Venta eliminada exitosamente");</script>';
        echo '<script> window.location="ventas.php"</script>';
    }
    else{
        echo '<script>alert ("!ERROR¡, la venta no se ha podido eliminar");</script>';
        echo '<script> window.location="ventas.php"</script>';
    }
?>

