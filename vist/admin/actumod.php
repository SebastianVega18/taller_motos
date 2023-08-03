<?php
    require_once("../../bd/conexion.php");
    $db = new Database();
    $conectar= $db->conectar();
    require_once "../../controller/styles/dependencias.php";
?>
<?php
    $consulta=$conectar->prepare("SELECT * from modelo where id_modelo='".$_GET['actu']."' ");
    $consulta->execute();
    $query=$consulta->fetch(PDO::FETCH_ASSOC);

    if ((isset($_POST["actualizar"]))&&($_POST["actualizar"]=="form"))
    {
        $nombre = $_POST['nombreu'];
        
        if ($nombre=="")
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        else
        {
            $actusql=$conectar->prepare("UPDATE modelo SET modelo ='$nombre' WHERE id_modelo = '".$_GET['actu']."'");
            $actusql->execute();
            echo '<script>alert ("Actualizacion exitosa");</script>';
            echo '<script> window.location="modelo.php"</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <?php require_once "navbar.php"  ?>
</head>
<body>
	<div class="container">
		<h1>Modelo</h1>
        <br>
		<div class="row">
			<div class="col-sm-4">
				<form id="frmArticulos"  name="formu" method="post" >
                    <label>Referencia</label>
					<input type="number" disabled class="form-control input-sm" id="id" name="idu"   value="<?php echo $query['id_modelo'] ?>">
                    <br>
					<label>Modelo</label>
					<input type="text" oninput="multipletext(this)" maxlength="15" class="form-control input-sm" id="nombre" name="nombreu"  value="<?php echo $query['modelo'] ?>">
					<br>
					<button name="validar" type="submit" id="btnAgregaArticulo" class="btn btn-primary"  >Actualizar</button>
                    <input type="hidden" name="actualizar" value="form">
                    <button type="submit" class="btn btn-warning"><a href="modelo.php" style="color:#fff">Regresar</a></button>
				</form>
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
</body>
</html>