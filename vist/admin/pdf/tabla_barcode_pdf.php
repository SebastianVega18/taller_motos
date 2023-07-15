<?php
    require_once("../../../bd/conexion.php");
    $conectar = new database;
    $db = $conectar -> conectar();

    $mostrar = $db -> prepare("SELECT * FROM barcode WHERE id_barcode ='".$_POST['pdf']."' ");
    $mostrar -> execute();

    if(isset($_POST['img'])){
        echo '<script> window.location="barcode.php"</script>';
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
    <title>Codigo de barras productos</title>
</head>
<body>
<div class="container">
    <div id="nav">
        <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
            <div class="container">
                <div class="navbar-header">
                    <form method="POST">
                        <input type="hidden" name="img">
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
</div>
</body>
</html>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "../barcode.php";
        }, 1000);
    });
</script>