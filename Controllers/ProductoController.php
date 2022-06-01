<?php 

class ProductoController extends Controller{

    public function index(){
        //$this->subirArchivo('libro.pdf','2MB');
        //echo 'estoy en index'; exit;
        $this->view('admin/gestion_producto');
    }
    public function ver(){

        echo 'viendo un producto'; exit;  
    }
    public function crear_producto(){
        
    }
}