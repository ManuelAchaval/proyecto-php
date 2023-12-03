<?php /*@autor Manuel Achaval */

// $driver = "mysql";
// $dbName = "miproyecto";
// $host = "127.0.0.1"
// $dbuser = "root";
// $dbpass = "";

define("DRIVER", 'mysql');
define("DB", 'miproyecto');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'productos');

class productos {

    protected $id;
    public $nombre;
    public $descripcion;
    public $categoria;
    public $precio;
    public $imagen;
    private $exists = false;

    function __construct($id = null) {
        $db = new base_de_datos(DRIVER, DB, HOST, USER, PASS);
        $response = $db->select(TABLE, "id=?", array($id));

        if (isset($response[0]['id'])) {
            //estos nombres son de los inputs
            $this->id = $response[0]['id'];
            $this->nombre = $response[0]['nombre_produ'];
            $this->descripcion = $response[0]['desc_produ'];
            $this->precio = $response[0]['precio_produ'];
            $this->categoria = $response[0]['categoria_producto'];
            $this->imagen = $response[0]['img_produ'];
            $this->exists = true;
        } else {
            return false;
        }
    }

    public function muestro_produ() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }

    public function guardar() {
        if ($this->exists) {
            return $this->product_updt();
        } else {
            return $this->product_insert();
        }
    }

    public function eliminar() {
        $db = new base_de_datos(DRIVER,DB, HOST, USER, PASS);
        return $db->delete(TABLE, "id = " . $this->id);
    }


    private function produ_insert() {
        $db = new base_de_datos(DRIVER,DB, HOST, USER, PASS);
        $response = $db->insert(TABLE, "nombre_produ=?, desc_produ=?, precio_produ=?, cat_id=?, img_produ=?", "?,?,?,?,?", array($this->nombre, $this->descripcion, $this->precio, $this->categoria, $this->imagen));
    
        if($response){
            $this->id=$response;
            $this->exists=true;
            return true;
        }else{
            return false;
        }
    }
    
    private function produ_updt() {
        $db = new base_de_datos(DRIVER,DB, HOST, USER, PASS);
        $response = $db->update(TABLE, "nombre_produ=?, desc_produ=?, precio_produ=?, cat_id=?, img_produ=?", "id=?", array($this->nombre, $this->descripcion, $this->precio, $this->categoria, $this->imagen));
    
    }

    static public function product_select(){
        $db = new base_de_datos(DRIVER, DB,HOST,USER,PASS);
        return $db->listar(TABLE);
    }
}
/*$db = new base_de_datos("mysql", "miproyecto", "127.0.0.1", "root", "");
        $join='categorias ON categorias.id = productos.cat_id';
        $columns=array(
            "productos.id",
            "productos.nombre_produ",
            "productos.desc_produ",
            "productos.precio_produ",
            "productos.img_produ", 
            "categorias.nom_cate",
        );
        return $db -> select(TABLE, $columns, $join);*/