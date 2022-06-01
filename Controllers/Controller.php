<?php 

class Controller{
    public function __construct(){
        
    } 
    public function view($page){ 
        Views::view($page);
    }
}