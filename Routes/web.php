<?php
//           ruta    , Controlador , ->metodo                 
Router::GET('exportar-excel','ProductoController','exportarExcel');
Router::GET('gestion-de-productos','ProductoController','index');
Router::POST('gestion-de-productos-action','ProductoController','action');
Router::GET('quienes-somos','HomeController','quienes_somos');
Router::GET('mis-servicios','HomeController','servicios');
Router::GET('producto','ProductoController','ver');
//Router::GET('crear-producto','ProductoController','crear');
//Router::GET('modificar-producto','ProductoController','modificar');
//GET('gestion-de-producto','ProductoController','index');