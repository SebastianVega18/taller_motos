<?php  
require_once("bd/conexion.php");
session_start();
$db = new Database();
$conectar = $db->conectar();



  

if($_POST["validar"]){
    $usuario=$_POST["usuario"];
    $clave=$_POST["clave"];
    $cedula=$_POST["documento"];
    

    $sqli=$conectar->prepare("SELECT password from usuarios where documento='$cedula'");
    $sqli->execute();
    $fila1=$sqli->fetch();

    if($fila1==true){
        $sql= $conectar->prepare ("SELECT * from usuarios where usuario='$usuario' and  documento='$cedula' ");
        $sql -> execute();
        $fila = $sql->fetch();
    
        $clave1= $fila1['password'];
    

        


        $pass=password_verify($clave,$clave1); 
        if($fila==true){
                
            $_SESSION['documento']= $fila['documento'];
            $_SESSION['nombre']=$fila['nombre_completo'];
            $_SESSION['tipo']=$fila['id_tip_usu'];
            $_SESSION['usuario']=$fila['usuario'];
            $_SESSION['estado']=$fila['id_estado'];
            $_SESSION['email']=$fila['email'];
            

        
            



        
            if($_SESSION['tipo'] == 1 AND $_SESSION['estado'] == 1 ){
                header("Location: vist/admin/index.php");

                exit();
            }

            else if($_SESSION['tipo'] == 2 AND $_SESSION['estado'] == 1 ){
                header("Location: vist/admin/index.php");
                exit();
            }

            else if($_SESSION['tipo'] == 3 AND $_SESSION['estado'] == 1 ){
                header("Location: vist/usuario/index.php");
                exit();
            }
            else{
                echo'<script>alert("ESTE USUARIO ESTA INACTIVO");</script>';
                echo '<script> window.location="index.html"</script>';
                exit();
            }

        
        }
        else{
                echo'<script>alert(" EXISTEN DATOS ERRONEOS");</script>';
                echo '<script> window.location="index.html"</script>';
                exit();
            }

    }
elseif ($usuario == "" || strlen($usuario) <4 || $clave == "" || strlen($clave) <4 || $cedula =="" || strlen($cedula) <6){
    echo'<script>alert("ERROR DATOS ERRONEOS O VACIOS");</script>';
    echo '<script> window.location="index.html"</script>';
}
else{
    echo'<script>alert("Contraseña Incorrecta");</script>';
    echo '<script> window.location="index.html"</script>';
}
}
?>
    

    