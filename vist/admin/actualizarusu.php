<?php


require_once("../../bd/conexion.php");
$db = new Database();
$conectar= $db->conectar();
require_once "../../controller/styles/dependencias.php";

?>
   <?php
    
        $consulta=$conectar->prepare("SELECT * From usuarios INNER JOIN estado ON usuarios.id_estado=estado.id_estado INNER join tipo_usuarios on usuarios.id_tip_usu=tipo_usuarios.id_tip_usu" );
         $consulta->execute();
         $queryi=$consulta->fetch(PDO::FETCH_ASSOC);
           
       $con=$conectar->prepare("SELECT * from estado WHERE id_estado <3");
       $con->execute();
       
    

       $sqlt=$conectar->prepare("SELECT * from tipo_usuarios");
       $sqlt->execute();
       


       if ((isset($_POST["actualizar"]))&&($_POST["actualizar"]=="form"))
       {
        
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $estado= $_POST['estado'];
        
        
   
   
      


        if ( $nombre=="" || $telefono=="" || $email=="" || $estado=="")
        {
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> windows.location="index.php"</script>';
        }
        
        else
        {
          $actusql=$conectar->prepare("UPDATE usuarios SET   nombre_completo='$nombre',telefono='$telefono',email='$email' ,id_estado='$estado' WHERE documento='".$_GET['actu']."'");
          $actusql->execute();
          echo '<script>alert ("Actualizacion exitosa");</script>';
          echo '<script> window.location="usuarios.php"</script>';
            
    
        }
   
       }
  
   ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar usuarios</title>
    <?php require_once "navbar.php"  ?>
</head>
<body>
     
		<div class="container">
			<h1>Usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos"  name="form" method="post" >
						<label>Estado</label>
                        <select name="estado" class="form-control input-sm" >
							<option  value="<?php echo($queryi['id_estado'])?>"><?php echo($queryi['estados'])?></option>
							<?php foreach($con as $resul){
                             ?>
								<option value="<?php echo($resul['id_estado'])?>"><?php echo($resul['estados'])?> </option>
							<?php  
                             };

                             ?>
						</select>
                        <label>Tipo de usuario</label>
                        <select disabled name="tipo" class="form-control input-sm" name="tipo">
							<option value="<?php echo($queryi['id_tip_usu'])?>"><?php echo($queryi['tip_usu'])?> </option>
							<?php foreach($sqlt as $query){
                             ?>
								<option value="<?php echo($query['id_tip_usu'])?>"><?php echo($query['tip_usu'])?> </option>
							<?php  
                             };

                             ?>
						</select>
						<label>Nombre Completo</label>
						<input type="text" oninput="multipletext(this)" maxlength="32" class="form-control input-sm" id="nombre" name="nombre" value="<?php echo($queryi['nombre_completo'])?>">
						<label>Telefono</label>
						<input type="number" oninput="maxlengthNumber(this)" minlength="10" maxlength="10" class="form-control input-sm" id="telefono"  min="1" name="telefono" value="<?php echo($queryi['telefono'])?>">
						<label>Email</label>
						<input type="email" oninput="multipletext(this)" maxlength="32" class="form-control input-sm" id="email" name="email"  value="<?php echo($queryi['email'])?>">
						
						<br>
						<button name="validar" type="submit" id="btnAgregaArticulo" class="btn btn-primary"  >Actualizar</button>
                        <input type="hidden" name="actualizar" value="form">
                        <button type="submit" class="btn btn-warning"><a href="usuarios.php" style="color:#fff">Regresar</a></button>
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







