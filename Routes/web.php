<?php
//           ruta    , Controlador , ->metodo                 
Router::GET('gestion-de-productos','ProductoController','index');
Router::GET('quienes-somos','HomeController','quienes_somos');
Router::GET('mis-servicios','HomeController','servicios');
Router::GET('producto','ProductoController','ver');
//Router::GET('crear-producto','ProductoController','crear');
//Router::GET('modificar-producto','ProductoController','modificar');
//GET('gestion-de-producto','ProductoController','index');