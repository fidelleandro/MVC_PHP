<?php 

class ProductoController extends Controller{

    public function index(){
        //$this->subirArchivo('libro.pdf','2MB');
        //echo 'estoy en index'; exit;
        $this->view('admin/gestion_producto');
    }
    public function exportarExcel(){
        echo 'Exportar a excel'; exit;  
    }
    public function action(){
        echo 'action <br>';  
        print_r($_POST); exit;
        echo 'viendo un producto'; exit;  
    }
    public function crear_producto(){
        
    }
}