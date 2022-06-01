<?php
      Class Router{
         public static $routes = [];
         
         public function __construct(){}

         public static function GET($route,$controller,$method){
            static::$routes[$route] = ['controller' => $controller,
                                       'method' => $method
                                      ];
         }

      }