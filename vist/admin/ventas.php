
<?php

	require_once("../../bd/conexion.php");


	$db = new database();
	$conectar= $db->conectar();


	$sentencia = $conectar->prepare("SELECT factura_venta.total, factura_venta.fecha, factura_venta.id_venta,usuarios.nombre_completo, GROUP_CONCAT(productos.barcode, '..',  productos.nom_producto, '..', detalle_venta.cantidad SEPARATOR '__') AS productos  FROM factura_venta INNER JOIN detalle_venta ON detalle_venta.id_venta = factura_venta.id_venta INNER JOIN productos ON productos.id_productos = detalle_venta.id_producto INNER join usuarios on factura_venta.documento=usuarios.documento  GROUP BY factura_venta.id_venta ORDER BY factura_venta.id_venta;");
	$sentencia->execute();
	$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

	$barcode = $conectar -> prepare ("SELECT * FROM barcode");
	$barcode -> execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../controller/styles/iconos.css">
    <title>Historial de ventas</title>
	<?php  include_once "index.php";?>
</head>
<body>
    
<div class="container">
	<div class="col-xs-12">
		<h1>Ventas</h1>
		<div>
			<a class="btn btn-success" href="./vender.php">Nueva <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					<th>Vendedor</th>
					<th>Productos vendidos</th>
					<th>Total</th>
					<th>Imprimir</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id_venta ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td><?php echo $venta->nombre_completo ?></td>

					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>

								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>

								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta->total ?></td>
                    
					<td><a class="btn btn-success" href="<?php echo "imprimir.php?id=" . $venta->id_venta?>"><i class="glyphicon glyphicon-arrow-down"></i></a></td>
					<td>
					<form method="post" action="eliminarVenta.php" > 
						<button type="submit" class="btn btn-danger btn-s" onclick="return ConfirmDelete()" >
							<span class="glyphicon glyphicon-remove">
								<input type="hidden" name="elimi" value="<?php echo $venta->id_venta?>">
							</span>
						</button>
					</form>
						<!-- <a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id_venta?>"><i class="glyphicon glyphicon-remove"></i></a></td> -->
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
    function ConfirmDelete()
    {
        var respuesta = confirm("Estas seguro de eliminar la venta");

        if (respuesta == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
</body>	
</html>