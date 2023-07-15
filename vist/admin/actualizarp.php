<?php


require_once("../../bd/conexion.php");
$db = new Database();
$conectar= $db->conectar();
require_once "../../controller/styles/dependencias.php";

?>
   <?php
    
        $consulta=$conectar->prepare("SELECT * from productos,estado where id_productos='".$_GET['actu']."' and productos.id_estado=estado.id_estado ");
            $consulta->execute();
            $query=$consulta->fetch(PDO::FETCH_ASSOC);
        $con=$conectar->prepare("SELECT * from estado WHERE id_estado > 3");
        $con->execute();
        $fila=$con->fetch();

        $produ = $conectar -> prepare("SELECT cantidad_ini FROM productos WHERE id_productos = '".$_GET['actu']."' ");
        $produ -> execute();
        $resultado = $produ -> fetch();

        $cantidad_ant = $resultado ['cantidad_ini'];

        

        if ((isset($_POST["actualizar"]))&&($_POST["actualizar"]=="form"))
        {
        $id = $_GET['actu'];
        $nombre = $_POST['nombreu'];
        $precio = $_POST['preciou'];
        $descripcion = $_POST['descripcionu'];
        $cantidad = $_POST['cantidadu'];

        $suma = $cantidad + $cantidad_ant;

   
        $validar="SELECT * FROM productos ";
        $queryi=$conectar->prepare($validar);
        $queryi->execute();
        $fila1=$queryi->fetchAll(PDO::FETCH_ASSOC);


         if ($id=="" || $nombre=="" || $precio=="" || $descripcion=="" )
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
       
        else
        {
          $actusql=$conectar->prepare("UPDATE productos SET id_productos='$id' , nom_producto='$nombre',precio='$precio',descripcion='$descripcion', cantidad_ini = '$suma', cantidad_ant = '$cantidad_ant'  WHERE id_productos='".$_GET['actu']."'");
          $actusql->execute();
          echo '<script>alert ("Actualizacion exitosa");</script>';
               echo '<script> window.location="productos.php"</script>';
            
    
        }
   
       }
  
   ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once "index.php"  ?>
</head>
<body>
     
		<div class="container">
			<h1>Productos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos"  name="formu" method="post" >
						<label>Estado</label>
                        <select name="estadou" disabled id="" class="form-control input-sm">
                        <option value="<?php echo($query['id_estado'])?>"><?php echo($query['estados'])?></option>
                
                    <?php
                    do{
                    ?>

                    <option value="<?php echo($fila['id_estado'])?>"><?php echo($fila['estados'])?></option>
            


                    <?php
                        }while($fila=$con->fetch());
                    ?>
                    </select>
                        <label>Referencia</label>
						<input type="text" disabled class="form-control input-sm" id="idu" name="idu"   value="<?php echo $query['id_productos'] ?>">

						<label>Nombre</label>
						<input type="text" oninput="multipletext(this)" maxlength="25" class="form-control input-sm" id="nombre" name="nombreu"  value="<?php echo $query['nom_producto'] ?>">
						<label>Precio</label>
						<input type="number" oninput="maxlengthNumber(this)" maxlength="10" class="form-control input-sm" id="precio"  min="1" name="preciou" value="<?php echo $query['precio'] ?>">
						<label>Descripcion</label>
						<input type="text" oninput="multipletext(this)" maxlength="32" class="form-control input-sm" id="descripcion" name="descripcionu" value="<?php echo $query['descripcion'] ?>">
						<label>Cantidad</label>
						<input type="number" oninput="maxlengthNumber(this)" maxlength="4"  class="form-control input-sm" id="cantidad" name="cantidadu" value="">
						<br>
						<button name="validar" type="submit" id="btnAgregaArticulo" class="btn btn-primary"  >Actualizar</button>
                        <input type="hidden" name="actualizar" value="form">
                        <button type="submit" class="btn btn-warning"><a href="productos.php" style="color:#fff">Regresar</a></button>
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







































