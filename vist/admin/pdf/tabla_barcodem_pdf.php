<?php
    require_once("../../../bd/conexion.php");
    $conectar = new database;
    $db = $conectar -> conectar();

    $mostrar = $db -> prepare("SELECT * FROM barcodem WHERE id_barcode ='".$_POST['pdf']."' ");
    $mostrar -> execute();

    if((isset($_POST['img']) && ($_POST['img'] =="img2"))){
        echo '<script> window.location="barcodem.php"</script>';
    }
?>
<br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../controller/styles/barcode.css">
    <title>Codigo de barras moto</title>
</head>
<body>
<div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
        <div class="container">
            <div class="navbar-header">
                <form method="POST">
                    <input type="hidden" name="img" value="img2">
                    <img ondblclick="DOMContentLoaded()" onclick="window.print()" src="../../../controller/img/icono1.png">
                </form>
            </div>
        <div id="navbar" class="collapse navbar-collapse">
    </div>
</div>
    <table class="tabla">
        <tr>
            <td>Nombre</td>
            <td>Codigo de barra</td>
        </tr>
        <?php 
            foreach($mostrar as $code){ 
        ?>
        <tr>
            <td><?php echo $code['nombre'];?></td>
            <td>
                <img src="../codigo/barcode.php?text=<?php echo $code['barcode']?>&size=40&codetype=Code128&print=true" />
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "../barcodem.php";
        }, 1000);
    });
</script>