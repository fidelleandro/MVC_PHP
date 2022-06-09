<?php  
//
mb_internal_encoding("UTF-8");
$url = parse_url($_SERVER['REQUEST_URI']);
$path = explode('/',$url['path']);
$protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$servername = strtolower($_SERVER['SERVER_NAME']);
$path[1] = $servername == 'localhost' ? $protocolo.$servername.'/'.$path[1] : $protocolo.$servername;
unset($path[0]);
$mis_rutas = $path;
unset($mis_rutas[1]);
//print_r($mis_rutas);  
include 'System/Router.php'; 
require_once 'System/Views.php';
include 'Routes/web.php';
include 'Controllers/Controller.php';

//echo '<pre>';
//print_r(Router::$routes); 
 //echo '</pre>';
foreach (Router::$routes as $route => $value) {
    if (file_exists( 'Controllers/'.$value['controller'].'.php')) {
        //echo 'Controllers/'.$value['controller'].'.php'; exit;
        foreach ($mis_rutas as $k => $ruta) {
            if($route == $ruta) { 
                require_once('Controllers/'.$value['controller'].'.php');
                $controller = $value['controller'];
                $method = $value['method'];
                $clase = new $controller(); //new ProductoController();
                return $clase->$method(); //$clase->index();
            }    
        } 
    }
}
//print_r($_POST); exit;
/////RUTAS POST
// foreach (Router::$routes_post as $route => $value) {
//     if (file_exists( 'Controllers/'.$value['controller'].'.php')) {
//         //echo 'Controllers/'.$value['controller'].'.php'; exit;
//         foreach ($mis_rutas as $k => $ruta) {
//             if($route == $ruta) { 
//                 require_once('Controllers/'.$value['controller'].'.php');
//                 $controller = $value['controller'];
//                 $method = $value['method'];
//                 $clase = new $controller(); //new ProductoController();
//                 //print_r($_POST); exit;
//                 return $clase->$method(); //$clase->index();
//             }    
//         }
        
//     }
// }