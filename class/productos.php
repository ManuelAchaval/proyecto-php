<?php /*@autor Manuel Achaval */

$driver = "mysql";
$dbName = "miproyecto";
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";

class productos {

    protected $id;
    public $nombre;
    public $descripcion;
    public $categoria;
    public $precio;
    public $imagen;
    private $exists = false;

    function __construct($id = null) {
        $db = new database($driver, $dbName, $host, $dbuser, $dbpass);
        $response = $db->select("productos", "id=?", array($id));

        if (isset($response[0]['id'])) {
            //estos nombres son de los inputs
            $this->id = $response[0]['id'];
            $this->nombre = $response[0]['nombre-produ'];
            $this->descripcion = $response[0]['desc-produ'];
            $this->precio = $response[0]['precio-produ'];
            $this->categoria = $response[0]['categoria-producto'];
            $this->imagen = $response[0]['img-produ'];
            $this->exists = true;
        } else {
            return false;
        }
    }

    public
            function muestro_produ() {
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
        $db = new database($driver, $dbName, $host, $dbuser, $dbpass);
        return $db->delete("productos", "id = " . $this->id);
    }


    private function produ_insert() {
        $db = new database($driver, $dbName, $host, $dbuser, $dbpass);
        $response = $db->insert("productos", "nombre-produ=?, desc-produ=?, precio-produ=?, cat-id=?, img-produ=?", "?,?,?,?", array($this->nombre, $this->descripcion, $this->precio, $this->categoria, $this->imagen));
    
        if($response){
            $this->id=$response;
            $this->exists=true;
            return true;
        }else{
            return false;
        }
    }
    
    private function produ_updt() {
        $db = new database($driver, $dbName, $host, $dbuser, $dbpass);
        $response = $db->update("productos", "nombre-produ=?, desc-produ=?, precio-produ=?, cat-id=?, img-produ=?", "id=?", array($this->nombre, $this->descripcion, $this->precio, $this->categoria, $this->imagen));
    
    }
}
