<?php
	require_once("../../bd/conexion.php");

	$db = new database();
	$conectar= $db->conectar();


	if(!isset($_POST["codigo"])) return;
	$codigo = $_POST["codigo"];
	$sentencia = $conectar->prepare("SELECT * FROM productos WHERE id_productos = ? LIMIT 1;");
	$sentencia->execute([$codigo]);
	$producto = $sentencia->fetch(PDO::FETCH_OBJ);

	if($producto){
		if($producto->cantidad_ini < 1){
			header("Location: ./vender.php?status=5");
			exit;
		}
		session_start();
		$indice = false;
		for ($i=0; $i < count($_SESSION["carrito"]); $i++) { 
			if($_SESSION["carrito"][$i]->id_productos === $codigo){
				$indice = $i;
				break;
			}
		}
		if($indice === FALSE){
			$producto->cantidad = 1;
			$producto->total = $producto->precio;
			array_push($_SESSION["carrito"], $producto);
		}else{
			$_SESSION["carrito"][$indice]->cantidad++;
			$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
		}
		header("Location: ./vender.php");
	}
	else return header("Location: ./vender.php?status=4");
?>