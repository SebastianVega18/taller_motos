<?php

require_once("../../bd/conexion.php");
$db = new Database();
$conectar= $db->conectar();


?>
<?php

  if ((isset($_POST["elimi"]))){

    $tip_usu = $_POST['elimi'];
    $consul = $conectar -> prepare("SELECT * FROM tipo_usuarios WHERE id_tip_usu = $tip_usu");
    $consul -> execute();
    $resul = $consul -> fetch();

    $tipo = $resul['id_tip_usu'];
    if($tipo == 2){
      echo '<script>alert ("¡ERROR!, el registro no se puede eliminar");</script>';
      echo '<script> window.location="tip_usu.php"</script>';
    }
    else{
      $eliminar=$conectar->prepare("DELETE  FROM tipo_usuarios where id_tip_usu='".$_POST['elimi']."'");
      $eliminar->execute();
      echo '<script>alert ("Registro Eliminado");</script>';
      echo '<script> window.location="tip_usu.php"</script>';
    }
}  

?>

