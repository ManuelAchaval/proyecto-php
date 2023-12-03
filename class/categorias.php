<?php /*@autor Manuel Achaval */

 define("DRIVER", 'mysql');
define("DB", 'miproyecto');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'categorias');


class Categorias {

    protected $id;
    public $nombre;
    private $exist = false;

    function __construct($id = null) {
        if ($id != null) {
            $db = new base_de_datos(DRIVER, DB, HOST, USER,PASS);
            $response = $db->select(TABLE, "id=?", array($id));
            
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
        $db = new base_de_datos(DRIVER, DB, HOST, USER,PASS);
        return $db->delete(TABLE, "id = " . $this->id);
    }


    private function cat_insert() {
        $db = new base_de_datos(DRIVER, DB, HOST, USER,PASS);
        $response = $db->insert(TABLE, "nom-cate=?", "id=?", array($this->nombre));
    
        if($response){
            $this->id=$response;
            $this->exists=true;
            return true;
        }else{
            return false;
        }
    }
    
    private function cat_updt() {
        $db = new base_de_datos(DRIVER, DB, HOST, USER,PASS);
        $response = $db->update(TABLE, "nom-cate=?", "id=?", array($this->nombre));
    
    }
    
    static public function cat_select() {
        $db = new base_de_datos(DRIVER, DB, HOST, USER,PASS);
        return $db-> select(TABLE);
    }
    /* static public function listar() {
        $db = new base_datos();
        return $db->listar("categorias");
      } */
}
