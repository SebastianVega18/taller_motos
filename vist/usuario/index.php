<?php 
    session_start();

    include("../../controller/validar.php");

    require_once("../../bd/conexion.php");
    $db = new Database();
    $conectar= $db->conectar();
    require_once ("../../controller/styles/dependencias.php");

    $user = $conectar -> prepare("SELECT * FROM moto WHERE documento = '".$_SESSION["documento"]."'");
    $user -> execute();
    $user1 = $user -> fetch(PDO::FETCH_ASSOC);

    $marca1 = $user1["id_marca"];
    $usuario1 = $user1["documento"];
    $linea1 = $user1["id_linea"];
    $modelo1 = $user1["id_modelo"];
    $cilindraje1 = $user1["id_cilindraje"];
    $color1 = $user1["id_color"];
    $tip_ser1 = $user1["id_tip_servicio"];
    $tip_veh1 = $user1["id_clase"];
    $carroceria1 = $user1["id_carroceria"];
    $combustible1 = $user1["id_combustible"];
    $barcode1 = $user1["barcode"];
?>

<?php

    $marca=$conectar->prepare("SELECT * from marca WHERE id_marca = '$marca1'");
    $marca->execute();
    $marca2 = $marca -> fetch();

    $usuario=$conectar->prepare("SELECT * from usuarios WHERE documento = '$usuario1'");
    $usuario->execute();
    $usuario2 = $usuario -> fetch();

    $linea=$conectar->prepare("SELECT * from linea WHERE id_linea = '$linea1'");
    $linea->execute();
    $linea2 = $linea -> fetch();

    $modelo=$conectar->prepare("SELECT * from modelo WHERE id_modelo = '$modelo1'");
    $modelo->execute();
    $modelo2 = $modelo -> fetch();

    $cilindraje=$conectar->prepare("SELECT * FROM cilindraje WHERE id_cilindraje = '$cilindraje1'");
    $cilindraje->execute();
    $cilindraje2 = $cilindraje -> fetch();

    $color=$conectar->prepare("SELECT * FROM color WHERE id_color = '$color1'");
    $color->execute();
    $color2 = $color -> fetch();

    $tip_ser=$conectar->prepare("SELECT * FROM tipo_servicio WHERE id_tip_servicio = '$tip_ser1'");
    $tip_ser->execute();
    $tip_ser2 = $tip_ser -> fetch();

    $tip_veh=$conectar->prepare("SELECT * FROM tipo_vehiculo WHERE id_clase = '$tip_veh1'");
    $tip_veh->execute();
    $clase2 = $tip_veh -> fetch();

    $carroceria=$conectar->prepare("SELECT * FROM tipo_carroceria WHERE id_carroceria = '$carroceria1'");
    $carroceria->execute();
    $carroceria2 = $carroceria-> fetch();

    $combustible=$conectar->prepare("SELECT * FROM combustible WHERE id_combustible = '$combustible1'");
    $combustible->execute();
    $combustible2 = $combustible -> fetch();

    // $barcode=$conectar->prepare("SELECT * FROM barcodem WHERE barcode = '$barcode1'");
    // $barcode->execute();
    // $barcode2 = $barcode -> fetch();
?>

<?php
    if(isset($_POST['btncerrar']))
        {
            session_destroy();
            header('location:../../index.html');
        } 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../../controller/img/icono.png" type="image/x-icon">
    <title>Menu</title>
    <?php include_once("navar.php");?>
</head>
<body>
<br>
<div class="container">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption><h2>Mis motos</h2></caption>
        <thead>
            <td>Placa</td>
            <td>Marca</td>
            <td>Descripcion</td>
            <td>Propietario</td>
            <td>KM</td>
            <td>Linea</td>
            <td>Cilindraje</td>
            <td>Color</td>
            <td>T. Servicio</td>
            <td>Clase</td>
            <td>Carroceria</td>
            <td>Capacidad</td>
            <td>Combustible</td>
            <td>N. Motor</td>
            <td>VIN</td>
            <td>N. Chasis</td>
            <!-- <td>Codigo</td> -->
        </thead>
        <tbody>
            <td><?php echo $user1["placa"];?></td>
            <td><?php echo $marca2["marca"];?></td>
            <td><?php echo $user1["descripcion"];?></td>
            <td><?php echo $usuario2["nombre_completo"];?></td>
            <td><?php echo $user1["km"];?></td>
            <td><?php echo $linea2["linea"];?></td>
            <td><?php echo $cilindraje2["cilindraje"];?></td>
            <td><?php echo $color2["color"];?></td>
            <td><?php echo $tip_ser2["tip_servicio"];?></td>
            <td><?php echo $clase2["tip_vehiculo"];?></td>
            <td><?php echo $carroceria2["carroceria"];?></td>
            <td><?php echo $user1["capacidad"];?></td>
            <td><?php echo $combustible2["combustible"];?></td>    
            <td><?php echo $user1["numero_motor"];?></td>
            <td><?php echo $user1["vin"];?></td>
            <td><?php echo $user1["numero_chasis"];?></td>
            <!-- <?php 
                while($barcode2 = $barcode -> fetch()): 
            ?>
            <td>
                <img src="../admin/codigo/barcode.php?text=<?php echo $barcode2['barcode']?>&size=40&codetype=Code128&print=true" />
            </td>
            <?php
                endwhile;
            ?> -->
        </tbody>
    </table>
</div>
</body>
</html>