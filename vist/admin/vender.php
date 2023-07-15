<?php 
	session_start();
	require_once("../../bd/conexion.php");

	$db = new database();
	$conectar= $db->conectar();


	$consul=$conectar->prepare("SELECT * FROM usuarios where id_tip_usu=1 ");
	$consul->execute();

	$consu=$conectar->prepare("SELECT * FROM moto  ");
	$consu->execute();

	$cons=$conectar->prepare("SELECT * FROM productos  ");
	$cons->execute();

	if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
	$granTotal = 0;
?>

<?php
	if(isset($_GET["status"])){
		if($_GET["status"] === "1"){
?>

<div class="container">
	<div class="alert alert-success">
		<strong>¡Correcto!</strong> Venta realizada correctamente
	</div>
</div>

<?php
	}else if($_GET["status"] === "2"){
?>

<div class="container">
	<div class="alert alert-info">
		<strong>Venta cancelada</strong>
	</div>
</div>

<?php
	}else if($_GET["status"] === "3"){
?>

<div class="container">
	<div class="alert alert-info">
		<strong>Ok</strong> Producto quitado de la lista
	</div>
</div>

<?php
	}else if($_GET["status"] === "4"){
?>

<div class="container">
	<div class="alert alert-warning">
		<strong>Error:</strong> El producto que buscas no existe
	</div>
</div>

<?php
	}else if($_GET["status"] === "5"){
?>

<div class="container">
	<div class="alert alert-danger">
		<strong>Error: </strong>El producto está agotado
	</div>
</div>

<?php
	}else{
?>

<div class="container">
	<div class="alert alert-danger">
		<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
	</div>
</div>
<?php
	}	
}
?>

<br>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../controller/styles/menu.css">
	<link rel="stylesheet" href="../../controller/styles/iconos.css">
	<title>Venta de productos</title>
	<?php  include_once "index.php";?>
</head>
<body>
	<div class="container">
		<h1>Vender Productos</h1>
		<br>
		<form method="post" action="agregarAlCarrito.php">
			<label class="labe1" >Codigo</label>
				<select class="form-select form-select-lg " id="codigo" name="codigo">
					<option disabled selected value="">Elige el producto</option>
					<?php
						while ($row = $cons->fetch(PDO::FETCH_ASSOC)) {
							echo "<option value=" . $row['id_productos'] . ">"  . $row['nom_producto'] . "-". $row['barcode'] .  "</option>";
						}
					?>
				</select>
				<br>
				<br>
			<input type="submit" name="agregar" value="agregar" class="btn btn-success" >  
			<br>
			<br>
		</form>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
				    <th>Nombre</th>
					<th>Descripción</th>
					<th>Valor unitario</th>
					<th>Quitar</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach(@$_SESSION["carrito"] as $indice  => $producto ){ 	
					
					$granTotal += $producto->total;
				
				?>
				<tr>
					<td><?php echo $producto->id_productos ?></td>
					
					<td><?php echo $producto->nom_producto ?></td>
					<td><?php echo $producto->descripcion ?></td>
					
					
					<td><?php echo $producto->precio ?></td>
					
					<td><a class="glyphicon glyphicon-remove" class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i></i></a></td>
					<td>
						<form action="cambiar_cantidad.php" method="post">
							<input name="indice" type="hidden" value="<?php echo $indice; ?>">
							<input min="1" name="cantidad" class="form-control" required type="number"  value="<?php echo $producto->cantidad; ?>">
						</form>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
	<h3 class="total">Total: <?php echo $granTotal; ?></h3>
	<br>
	<br>
	<form action="./terminarVenta.php" method="POST">
						<br> 
						<br>
						<br>

	<label class="labe1" >Vehiculo</label>
            	<select class="select-box selec" id="placa" name="placa">
					<option disabled selected value="">Elige vehiculo por placa</option>
						<?php foreach($consu as $moto){
                            ?>
								<option value="<?php echo($moto['placa'])?>"><?php echo($moto["placa"])?> </option>
							<?php
					
};

                            ?>
						</select>
    <br>
	<br>
	<br>
		<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
		<button type="submit" class="btn btn-success">Terminar venta</button>
		<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
	</form>
	
		
		
	</div>
	</div>
	<script  type="text/javascript">
		$(document).ready(function(){
		$('#vendedor').select2();
		$('#placa').select2();
		$('#codigo').select2();
	});
	</script>
	</body>

</html>