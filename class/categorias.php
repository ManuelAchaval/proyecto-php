<?php /*@autor Manuel Achaval */

// $driver = "mysql";
// $dbName = "miproyecto";
// $host = "127.0.0.1";
// $dbuser = "root";
// $dbpass = "";

class Categorias {

    protected $id;
    public $nombre;
    private $exist = false;

    function __construct($id = null) {
        if ($id != null) {
            $db = new database("mysql",  "miproyecto", "127.0.0.1", "root", "");
            $response = $db->select("categorias", "id=?", array($id));
            
            if(isset($response[0]['id'])){
                $this->id = $response[0]['id'];
                $this->nombre = $response[0]['nom-cate'];
                $this->exist=true;
            }
        }else{
            return false;
        }
    }
    public
            function muestro_cat() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }

    public function guardar() {
        if ($this->exists) {
            return $this->cat_updt();
        } else {
            return $this->cat_insert();
        }
    }

    public function eliminar() {
        $db = new database("mysql",  "miproyecto", "127.0.0.1", "root", "");
        return $db->delete("categorias", "id = " . $this->id);
    }


    private function cat_insert() {
        $db = new database("mysql",  "miproyecto", "127.0.0.1", "root", "");
        $response = $db->insert("categorias", "nom-cate=?", "id=?", array($this->nombre));
    
        if($response){
            $this->id=$response;
            $this->exists=true;
            return true;
        }else{
            return false;
        }
    }
    
    private function cat_updt() {
        $db = new database("mysql",  "miproyecto", "127.0.0.1", "root", "");
        $response = $db->update("categorias", "nom-cate=?", "id=?", array($this->nombre));
    
    }
    
    static public function cat_select() {
        $db = new database("mysql",  "miproyecto", "127.0.0.1", "root", "");
        return $db-> select("categorias");
    }
    /* static public function listar() {
      $db = new base_datos();
      return $db->listar("categorias");
      } */
}
