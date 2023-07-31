<?php



require_once("../../bd/conexion.php");
include "../../controller/styles/dependencias.php";
$db = new database();

$conectar= $db->conectar();




 if ((isset($_POST["agregar"]))&&($_POST["agregar"]=="formu"))
    {
        $id=$_POST['idm'];
        $servicio = $_POST['servicio'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        

        $validar="SELECT id_servicios FROM servicio WHERE id_servicios ='$id' or servicio ='$servicio'";
        $queryi=$conectar->prepare($validar);
        $queryi->execute();
        $fila1=$queryi->fetchAll(PDO::FETCH_ASSOC);

        if ($fila1){
            echo '<script> alert ("EL SERVICIO YA EXISTE ");</script>';
            echo '<script> windows.location= "index.php"</script>';

        }

        else if ($id=="" || $servicio =="" || $precio =="" || $descripcion == "")
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        
        else
        {
            $insertsql=$conectar->prepare("INSERT INTO servicio (id_servicios,servicio,precio,descripcion) VALUES (?,?,?,?);");
            $insertsql->execute([$id,$servicio,$precio,$descripcion]);
            echo '<script>alert ("Registro Exitoso, Gracias");</script>';
            echo '<script> window.location="servicio.php"</script>';
        }

    }


?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <?php require_once "navbar.php"  ?>
       
       
</head>
<body>



		<div class="container">
			<h1>Servicios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos"  name="formu" method="post" >
                        <label>Referencia</label>
						<input type="number" oninput="maxlengthNumber(this)" maxlength="3" class="form-control input-sm" id="id" name="idm">
						<label>Servicio</label>
						<input type="text" oninput="multipletext(this)" maxlength="25" class="form-control input-sm" id="marca" name="servicio">
                        <label>Precio</label>
						<input type="number" oninput="maxlengthNumber(this)" maxlength="10" class="form-control input-sm" id="id" name="precio">
                        <label>Descripcion</label>
						<input type="text" oninput="multipletext(this)" maxlength="32" class="form-control input-sm" id="descripcion" name="descripcion">
						<br>
						<button name="validar" type="submit" id="btnAgregaArticulo" class="btn btn-success"  >Agregar</button>
                        <input type="hidden" name="agregar" value="formu">
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticulosLoad">
                    <?php require_once "tabla_servicio.php";?>
                    </div>
				</div>
			</div>
		</div>
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
<body>
    
<head>
</html>