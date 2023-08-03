<?php

    require_once("../../bd/conexion.php");
    $db = new Database();
    $conectar= $db->conectar();
    require_once "../../controller/styles/dependencias.php";

?>

<?php
    
    $consulta=$conectar->prepare("SELECT * from documentos where id_documentos ='".$_GET['actu']."' ");
    $consulta->execute();
    $query=$consulta->fetch(PDO::FETCH_ASSOC);
        
    if ((isset($_POST["actualizar"]))&&($_POST["actualizar"]=="form"))
    {
        $nombre = $_POST['nombreu'];
        $precio = $_POST['precio'];
        
        if ($nombre=="" || $precio == "")
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        else
        {
            $actusql=$conectar->prepare("UPDATE documentos SET documentos ='$nombre', precio = '$precio' WHERE id_documentos ='".$_GET['actu']."'");
            $actusql->execute();
            echo '<script>alert ("Actualizacion exitosa");</script>';
            echo '<script> window.location="doculegal.php"</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos legales</title>
    <?php require_once "navbar.php"  ?>
</head>
<body>
		<div class="container">
			<h1>Documentos legales</h1>
            <br>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos"  name="formu" method="post" >
                        <label>Referencia</label>
						<input type="number" disabled class="form-control input-sm" id="id" name="idu"   value="<?php echo $query['id_documentos'] ?>">
                        <br>
						<label>Documento legal</label>
						<input type="text" oninput="multipletext(this)" maxlength="20" class="form-control input-sm" id="nombre" name="nombreu"  value="<?php echo $query['documentos'] ?>">
                        <br>
                        <label>Precio</label>
						<input type="number" oninput="maxlengthNumber(this)" maxlength="10" class="form-control input-sm" id="precio" name="precio"   value="<?php echo $query['precio'] ?>">
						<br>
						<button name="validar" type="submit" id="btnAgregaArticulo" class="btn btn-primary btn-s">Actualizar</button>
                        <input type="hidden" name="actualizar" value="form">
                        <button type="submit" class="btn btn-warning"><a href="doculegal.php" style="color:#fff">Regresar</a></button>
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