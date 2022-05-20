<?php
include('System/MYSQL.php');
$conexion = new MYSQL('localhost','root','','tienda4');
$user = trim($_POST['username']);
$clave = trim($_POST['password']);
if ($user != '' && $clave != '') {

    $result = $conexion->validarUsuario($user,$clave);

    if($result){
        /****Crear sesion usuario y redirigir al dashboard */
        session_start();
        $_SESSION['user_login'] = true;
        header('Location:dashboard.php');//redireccionamiento a un archivo
    }
    else{
        echo 'login incorrecto';
    }
}