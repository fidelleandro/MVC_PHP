<?php
include 'System/MYSQL.php';
$mysql = new MYSQL('localhost','root','','tienda_ciclo2');
$response['status'] = false ;

try {
        /*****Validaciones requeridas u obligatorias */
        if (trim($_POST['nombre']) == '') {
            throw new Exception("Error, el nombre es requerido");
        }
        if (trim($_POST['precio']) == '') {
            throw new Exception("Error, el precio es requerido");
        }
        if (trim($_POST['stock']) == '') {
            throw new Exception("Error, el stock es requerido");
        }
        if (trim($_POST['descripcion']) == '') {
            throw new Exception("Error, la descripción es requerida");
        }
        /*****fin de Validaciones requeridas u obligatorias */
        /****Otras validaciones************** */
        if ($_POST['precio'] <= 0) {
            throw new Exception("Error, el precio debe ser mayor de 0");
        }
        if ($_POST['stock'] <= 0) {
            throw new Exception("Error, el stock debe ser mayor de 0");
        }

        $datos = array('nombre'      => trim($_POST['nombre']),
                       'precio'      => trim($_POST['precio']),
                       'stock'       => trim($_POST['stock']), 
                       'descripcion' => trim($_POST['descripcion'])
              );
        
        if ($_POST['producto_id'] == '') {
            $resultado = $mysql->insertar('producto',$datos);
        }      
        else{
            $resultado = $mysql->editar('producto',$datos,'id = '.$_POST['producto_id']);
        }
        
        
        $datos['id'] = $resultado['id'];
        $response['data']  = $datos;
        $response['status']  = true ; 
        $response['message'] = $_POST['producto_id'] == '' ? 'El producto se registró' : 'Edité el producto';
} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}


echo json_encode($response); exit;