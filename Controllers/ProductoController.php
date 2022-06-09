<?php 

class ProductoController extends Controller{

    public function index(){
        //$this->subirArchivo('libro.pdf','2MB');
        //echo 'estoy en index'; exit;
        $this->view('admin/gestion_producto');
    }
    public function exportarExcel(){
        echo 'Exportar a excel';
        /****** Muestran todo tipo de errores en php *******/ 
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        /**************************************************/
        require 'librerias/PHPExcel-1.8/PHPExcel.php';

        exit;  
    }
    public function action(){
        echo 'action <br>';  
        print_r($_POST); exit;
        echo 'viendo un producto'; exit;  
    }
    public function crear_producto(){
        
    }
}