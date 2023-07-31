<?php


require_once("../../bd/conexion.php");
$db = new Database();
$conectar= $db->conectar();
require_once "../../controller/styles/dependencias.php";


$usuario=$conectar->prepare("SELECT * from usuarios");
$usuario->execute();

$linea=$conectar->prepare("SELECT * from linea");
$linea->execute();

$modelo=$conectar->prepare("SELECT * from modelo");
$modelo->execute();

$cilindraje=$conectar->prepare("SELECT * FROM cilindraje");
$cilindraje->execute();

$color=$conectar->prepare("SELECT * FROM color");
$color->execute();

$tip_ser=$conectar->prepare("SELECT * FROM tipo_servicio");
$tip_ser->execute();

$tip_veh=$conectar->prepare("SELECT * FROM tipo_vehiculo");
$tip_veh->execute();

$carroceria=$conectar->prepare("SELECT * FROM tipo_carroceria");
$carroceria->execute();

$combustible=$conectar->prepare("SELECT * FROM combustible");
$combustible->execute();

?>
   <?php
    
        $consulta=$conectar->prepare("SELECT * from moto where placa='".$_GET['actu']."' ");
        $consulta->execute();
        $query=$consulta->fetch(PDO::FETCH_ASSOC);

        $id_marca = $query['id_marca'];
        $id_linea = $query['id_linea'];
        $id_modelo = $query['id_modelo'];
        $id_cilindraje = $query['id_cilindraje'];
        $id_color = $query['id_color'];
        $id_tip_servicio = $query['id_tip_servicio'];
        $id_clase = $query['id_clase'];
        $id_carroceria = $query['id_carroceria'];
        $id_combustible = $query['id_combustible'];
        
        $marca=$conectar->prepare("SELECT * from marca WHERE id_marca = '$id_marca' ");
        $marca->execute();
        $marca1 = $marca ->  fetch();

        $linea1=$conectar->prepare("SELECT * from linea WHERE id_linea = '$id_linea'");
        $linea1->execute();
        $linea2 = $linea1 -> fetch();

        $modelo1=$conectar->prepare("SELECT * from modelo WHERE id_modelo = '$id_modelo'");
        $modelo1->execute();
        $modelo2 = $modelo1 ->fetch();

        $cilindraje1=$conectar->prepare("SELECT * FROM cilindraje WHERE id_cilindraje = '$id_cilindraje'");
        $cilindraje1->execute();
        $cilindraje2 = $cilindraje1 -> fetch();

        $color1=$conectar->prepare("SELECT * FROM color WHERE id_color = '$id_color'");
        $color1->execute();
        $color2 = $color1 -> fetch();

        $tip_ser1=$conectar->prepare("SELECT * FROM tipo_servicio WHERE id_tip_servicio = '$id_tip_servicio'");
        $tip_ser1->execute();
        $tip_ser2 = $tip_ser1 -> fetch();

        $tip_veh1=$conectar->prepare("SELECT * FROM tipo_vehiculo WHERE id_clase = '$id_clase'");
        $tip_veh1->execute();
        $tip_veh2 = $tip_veh1 -> fetch();

        $carroceria1=$conectar->prepare("SELECT * FROM tipo_carroceria WHERE id_carroceria = '$id_carroceria'");
        $carroceria1->execute();
        $carroceria2 = $carroceria1 -> fetch();

        $combustible1=$conectar->prepare("SELECT * FROM combustible WHERE id_combustible = '$id_combustible'");
        $combustible1->execute();
        $combustible2 = $combustible1 -> fetch();


       if ((isset($_POST["actualizar"]))&&($_POST["actualizar"]=="form"))
       {

        $id=$_POST['id'];
        $descripcion = $_POST['descripcion'];
        $cantidad= $_POST['cantidad'];
        $marca=$_POST['marca'];
        $propietario=$_POST['propietario'];
        $id_linea=$_POST['linea'];
        $id_modelo=$_POST['modelo'];
        $id_cilindraje=$_POST['cilindraje'];
        $id_color=$_POST['color'];
        $id_tip_servicio=$_POST['tipser'];
        $id_clase=$_POST['tipveh'];
        $id_carroceria=$_POST['carroceria'];
        $capacidad=$_POST['capacidad'];
        $id_combustible=$_POST['combustible'];
        $numero_motor=$_POST['num_motor'];
        $vin=$_POST['vin'];
        $numero_chasis=$_POST['num_chasis'];


        
        if ($id==""  || $descripcion=="" || $cantidad=="" ||$marca==""||$propietario==""||$id_linea==""||$id_modelo==""||$id_cilindraje==""||$id_color==""||$id_tip_servicio==""||$id_clase==""||$id_carroceria==""||$capacidad==""||$id_combustible==""||$numero_motor==""||$vin==""||$numero_chasis=="")
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        
        else
        {
            $insertsql=$conectar->prepare("UPDATE moto SET placa = '$id', id_marca = '$marca', descripcion = '$descripcion', documento = '$propietario', km = '$cantidad', id_linea = '$id_linea', id_modelo = '$id_modelo', id_cilindraje = '$id_cilindraje', id_color = '$id_color', id_tip_servicio = '$id_tip_servicio', id_clase = '$id_clase', id_carroceria = '$id_carroceria', capacidad = '$capacidad', id_combustible = '$id_combustible', numero_motor = '$numero_motor', vin = '$vin', numero_chasis = '$numero_chasis' WHERE placa = '".$_GET['actu']."' ");
            $insertsql->execute();
            echo '<script>alert ("Actualizacion exitosa");</script>';
            echo '<script> window.location="motos.php"</script>';
        }
   
       }
  
   ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motos</title>
    <?php require_once "navbar.php"  ?>
       
       
</head>
<body>



		<div class="container">
			<h1>Motos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos"  name="formu" method="post" >
						<label>Marca</label>
                        <input type="text" disabled class="form-control input-sm" id="id" name="id" placeholder="<?php echo $marca1['marca'];?>">   
                        <label >Propietario</label>
                        <input type="text" disabled class="form-control input-sm" id="id" name="id" placeholder="<?php echo $query['documento'];?>">   
                        <label>Placa</label>
						<input type="text" disabled class="form-control input-sm" id="id" name="id" placeholder="<?php echo $query['placa'];?>">
						<label>Descripcion</label>
						<input type="text" oninput="multipletext(this)" maxlength="25" class="form-control input-sm" id="descripcion" name="descripcion" placeholder="<?php echo $query['descripcion'];?>">
						<label>kilometraje</label>
						<input type="number" oninput="maxlengthNumber(this)" maxlength="3" min="0" class="form-control input-sm" id="cantidad" name="cantidad" placeholder="<?php echo $query['km'];?>">
                        <label>Linea</label>
						<select class="form-control input-sm" name="linea">
							<option disabled selected value=""><?php echo $linea2['linea']?></option>
							<?php foreach($linea as $resull){
                             ?>
								<option value="<?php echo($resull['id_linea'])?>"><?php echo($resull['linea'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Modelo</label>
						<select class="form-control input-sm" name="modelo">
							<option disabled selected value=""><?php echo $modelo2['modelo']?></option>
							<?php foreach($modelo as $resulmo){
                             ?>
								<option value="<?php echo($resulmo['id_modelo'])?>"><?php echo($resulmo['modelo'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Cilindraje</label>
						<select class="form-control input-sm" name="cilindraje">
							<option disabled selected value=""><?php echo $cilindraje2['cilindraje']?></option>
							<?php foreach($cilindraje as $resulci){
                             ?>
								<option value="<?php echo($resulci['id_cilindraje'])?>"><?php echo($resulci['cilindraje'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Color</label>
						<select class="form-control input-sm" name="color">
							<option disabled selected value=""><?php echo $color2['color']?></option>
							<?php foreach($color as $resulcol){
                             ?>
								<option value="<?php echo($resulcol['id_color'])?>"><?php echo($resulcol['color'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Tipo de servcio</label>
						<select class="form-control input-sm" name="tipser">
							<option disabled selected value=""><?php echo $tip_ser2['tip_servicio']?></option>
							<?php foreach($tip_ser as $resulser){
                             ?>
								<option value="<?php echo($resulser['id_tip_servicio'])?>"><?php echo($resulser['tip_servicio'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Tipo de vehiculo</label>
						<select class="form-control input-sm" name="tipveh">
							<option disabled selected value=""><?php echo $tip_veh2['tip_vehiculo']?></option>
							<?php foreach($tip_veh as $resulveh){
                             ?>
								<option value="<?php echo($resulveh['id_clase'])?>"><?php echo($resulveh['tip_vehiculo'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Carroceria</label>
						<select class="form-control input-sm" name="carroceria">
							<option disabled selected value=""><?php echo $carroceria2['carroceria']?></option>
							<?php foreach($carroceria as $resulcar){
                             ?>
								<option value="<?php echo($resulcar['id_carroceria'])?>"><?php echo($resulcar['carroceria'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Capacidad</label>
                        <input type="number" oninput="maxlengthNumber(this)" maxlength="2" class="form-control input-sm" id="capacidad" name="capacidad" placeholder="<?php echo $query['capacidad'];?>">
                        <label>Combustible</label>
						<select class="form-control input-sm" name="combustible">
							<option disabled selected value=""><?php echo $combustible2['combustible']?></option>
							<?php foreach($combustible as $resulcom){
                             ?>
								<option value="<?php echo($resulcom['id_combustible'])?>"><?php echo($resulcom['combustible'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Numero de motor</label>
                        <input type="number" oninput="maxlengthNumber(this)" maxlength="10" class="form-control input-sm" id="num_motor" name="num_motor" placeholder="<?php echo $query['numero_motor'];?>">
                        <label>VIN</label>
                        <input type="number" oninput="maxlengthNumber(this)" maxlength="10" class="form-control input-sm" id="vin" name="vin" placeholder="<?php echo $query['vin'];?>">
                        <label>Numero de chasis</label>
                        <input type="number" oninput="maxlengthNumber(this)" maxlength="10" class="form-control input-sm" id="num_chasis" name="num_chasis" placeholder="<?php echo $query['numero_chasis'];?>">
                        <br>
						<button name="validar" type="submit" id="btnAgregaArticulo" class="btn btn-primary">Actualizar</button>
                        <input type="hidden" name="actualizar" value="form">
                        <button type="submit" class="btn btn-warning"><a href="motos.php" style="color:#fff">Regresar</a></button>
					</form>
				</div>
			</div>
		</div>
        
		<!-- Button trigger modal -->
      
		<!-- Modal -->
     
<body>
<script>
        function maxlengthNumber(obj){
            if(obj.value.length > obj.maxLength){
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo el numero de digitos establecidos");

            }
        }
    </script>

    <script>
        function multipletext(e) {
            key=e.keyCode || e.which;

            teclado=String.fromCharCode(key).toLowerCase();

            letras="qwertyuiopasdfghjklñzxcvbnm";

            especiales="8-37-38-46-164-46";

            teclado_especial=false;

            for(var i in especiales){
                if(key==especiales[i]){
                    teclado_especial=true;
                    break;
                }
            }

            if(letras.indexOf(teclado)==-1 && !teclado_especial){
                return false;
                a
            }
        }
    </script>
<head>
</html>
