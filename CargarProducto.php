<?php
include 'System/MYSQL.php';
$mysql = new MYSQL('localhost','root','','tienda_ciclo2');
$id = $_POST['id'];
$resultado = $mysql->reporte('producto','id,nombre,precio,stock,descripcion',"id=$id");
$response['status'] = true;
$response['datos'] = $resultado[0];
echo json_encode($response); exit;