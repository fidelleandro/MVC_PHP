<?php 

class Controller{
    public function __construct(){
        
    } 
    public function view($page){
        //echo 'maiz'; exit;
        
        Views::view($page);
    }
}