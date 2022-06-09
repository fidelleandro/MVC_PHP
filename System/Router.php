<?php
      Class Router{
         public static $routes = [];
         public static $routes_post = [];
         
         public function __construct(){}

         public static function GET($route,$controller,$method){
            static::$routes[$route] = ['controller' => $controller,
                                       'method' => $method
                                      ];
             
         }
         public static function POST($route,$controller,$method){
            static::$routes_post[$route] = ['controller' => $controller,
                                            'method' => $method
                                            ];
         }

      }