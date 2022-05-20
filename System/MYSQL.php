<?php

class MYSQL{
  
    private $host;
    private $user;
    private $pass;
    private $db;
    private $connection; 

    public function __construct($host = 'localhost',$user = 'root',$pass = '',$db = '') {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db   = $db;
        //$this->connection = new mysqli($this->host,$this->user,$this->pass,$this->db);
        try {
                $this->connection = new mysqli($this->host,$this->user,$this->pass,$this->db);
                if ($this->connection->connect_errno != null) {
                    echo "Error número ".$this->connection->connect_errno." conectando a la base de datos.<br>Mensaje: $db->connect_error.";
                    exit(); 
                }
        } catch (\Exception $th) {
            //throw $th;
        }
    }
    
    public function query($sql) {
        $result = null;
        try {
                if ($this->connection != null) {
                    $result = $this->connection->query($sql);
                }
                
        } catch (\Exception $th) {
            //throw $th;
        }
        return $result;
    }
    public function editar($table = '',$data = array(),$where= ''){
        $i = 0; 
        $sql = 'UPDATE '.$table.' SET ';
        $respuesta['estado'] = false;
        $respuesta['mensaje'] = 'OK';
        try {
                if($table == ''){
                    throw new Exception("Debes escribir un nombre a la tabla");
                }
                if (count($data) == 0) {
                    throw new Exception("Error, no hay información");
                } 
                $fil = '';
                foreach ($data as $columna => $valor) {
                    //Logica para armar columnas
                    if ($i != 0) { 
                        $fil.= ',';
                    } 
                    ////////////////////////////////////////
                    //Logica para los valores
                    $valor = is_numeric($valor) ? $valor : '"'.$valor.'"';
                    $fil.= $columna.'='.$valor;
                    $i++;
                } 
                 
                $sql = $sql.$fil.' WHERE '.$where;
                //echo $sql; exit;
                $this->query($sql);
                $respuesta['id'] = $this->connection->insert_id;
                $respuesta['estado'] = true;
        } catch (Exception $e) {
            $respuesta['mensaje'] = $e->getMessage();
        }
        
        return $respuesta;
    }
    public function insertar($table = '',$data = array()){
        $i = 0; 
        $sql = 'INSERT INTO '.$table.' ';
        $respuesta['estado'] = false;
        $respuesta['mensaje'] = 'OK';
        try {
                if($table == ''){
                    throw new Exception("Debes escribir un nombre a la tabla");
                }
                if (count($data) == 0) {
                    throw new Exception("Error, no hay información");
                }
                $col = '('; 
                $fil = '';
                foreach ($data as $columna => $valor) {
                    //Logica para armar columnas del insert
                    if ($i != 0) {
                        $col.= ',';
                        $fil.= ',';
                    }
                    $col.= $columna; 
                    ////////////////////////////////////////
                    //Logica para los valores
                    $valor = is_numeric($valor) ? $valor : '"'.$valor.'"';
                    $fil.= $valor;
                    $i++;
                }
                $col.= ') VALUES(';
                $fil.= ')'; 
                $sql = $sql.$col.$fil;
                //echo $sql; exit;
                $this->query($sql);
                $respuesta['id'] = $this->connection->insert_id;
                $respuesta['estado'] = true;
        } catch (Exception $e) {
            $respuesta['mensaje'] = $e->getMessage();
        }
        
        return $respuesta;
    }
    public function createTable($table = '',$data = array()){
        $i = 0; 
        $sql = 'CREATE '.$table.' (';
        $respuesta['estado'] = false;
        $respuesta['mensaje'] = 'OK';
        try {
                if($table == ''){
                    throw new Exception("Error, Debes escribir un nombre de tabla");
                }
                if (count($data) == 0) {
                    throw new Exception("Error, no hay información");
                }
                $col = ''; 
                $fil = '';
                foreach ($data as $columna => $valor) {
                    //Logica para armar columnas del insert
                    if ($i != 0) {
                        $col.= ',';
                        $fil.= ',';
                    }
                    $col.= $columna; 
                    ////////////////////////////////////////
                    //Logica para los valores
                    $valor = is_numeric($valor) ? $valor : '"'.$valor.'"';
                    $fil.= $valor;
                    $i++;
                }
                $col.= ') VALUES(';
                $fil.= ')';
                //(nombre,precio,stock,descripcion   
                $sql = $sql.$col.$fil;
                echo $sql; exit;
                $this->query($sql);
                $respuesta['estado'] = true;
        } catch (Exception $e) {
            $respuesta['mensaje'] = $e->getMessage();
        }
        
        return $respuesta;
    }
    public function reporte($table,$columnas,$where=''){
        $where = $where == '' ? '':' WHERE '.$where; 
        $result = $this->query('SELECT '.$columnas.' FROM '.$table.$where);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function validarUsuario($user,$clave){
        $result = $this->query("SELECT id FROM user WHERE email='$user' AND password='$clave'"); 
        if ($result->num_rows) {
            return true;
        }else{
            return false;
        }
    }
    public function mostrarProductos(){

    }
}