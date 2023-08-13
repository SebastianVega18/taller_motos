<?php
    require_once("../../bd/conexion.php");
    $db = new Database();
    $conectar = $db->conectar();
    session_start();


        if((isset($_POST['actualizar'])))
        {

            $token = $_POST['token'];

            $sqli = $conectar->prepare("SELECT token FROM tokens WHERE token = :token");
            $sqli->bindParam(':token', $token);
            $sqli->execute();
            $fila1 = $sqli->fetch(PDO::FETCH_ASSOC);
                
            $token1 = $fila1['token'];
    
            if($token == $token1){

                $habilitar = $conectar -> prepare("UPDATE usuarios SET id_estado = 1 WHERE id_estado = 1");
                $habilitar -> execute();
                echo '<script>alert("Administrador su estado a pasado de inactivo a activo");</script>';
                echo '<script>window.location="../../index.html"</script>';
                exit();
            }else{

                echo '<script>alert("ERROR, los tokens no coinciden");</script>';
                echo '<script>window.location="habilitar.php"</script>';
                exit();
            }
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="shortcut icon" href="../img/icono.png" type="image/x-icon">
    <title>Habilitación</title>
</head>
<body>
 
 <div class=" contenido-centrado">
   
    <div class=" degradado sombra ">


    <div class="contenedor-img registo-img">
        <img class="imagen-registro" src="../img/27520215_7323981.jpg" alt="imagen logo">
    </div>
        <form class="formulario" method="POST">
            <h1>Habilitación de administrador</h1>
            <p>Completa la informacion</p>
            <br>
            <div class="campo">
                <label for="contra">Token</label>
                <input type="text" oninput="multipletext(this);"  placeholder="Tu token" id="contra" name="token" >
            </div>
            <br>
            <input class="boton azul registro-btn" type="submit" value="Verificar" name="actualizar" >
            <div class="enlaces">
                <a href="../../index.html"> volver</a>
            </div>
        </form>
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
					alert("Debe ingresar solo el formato solicitado");
                    break;
                }
            }

            if(letras.indexOf(teclado)==-1 && !teclado_especial){
                return false;
                a
				alert("Debe ingresar solo el formato solicitado");
            }
        }
    </script>
</body>
</html>
