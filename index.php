<?php  
$url = parse_url($_SERVER['REQUEST_URI']);
$path = explode('/',$url['path']);
$protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
$servername = strtolower($_SERVER['SERVER_NAME']);
$path[1] = $servername == 'localhost' ? $protocolo.$servername.'/'.$path[1] : $protocolo.$servername;
unset($path[0]);
print_r($path);