<?php


require_once("../../bd/conexion.php");
$db = new Database();
$conectar= $db->conectar();


?>
<?php

  if ((isset($_POST["elimi"]))){

  $eliminar=$conectar->prepare("DELETE  FROM moto WHERE placa='".$_POST['elimi']."'");
  $eliminar->execute();
  echo '<script>alert ("Registro Eliminado");</script>';
  echo '<script> window.location="motos.php"</script>';
}  

?>