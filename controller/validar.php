<?php


    if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']))
    {
        header("location: ../../index.html");
        exit();
    }

?>