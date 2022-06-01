<?php
      Class Views{
         public static $routes = [];
         
         public function __construct(){ 
         }

         public static function view($page){
            $archivo ='Views/'.$page.'.php';
            require_once $archivo; exit;
            //echo file_get_contents($archivo); exit;
         } 

      }