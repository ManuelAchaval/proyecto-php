<?php /*@autor Manuel Achaval */

class base_de_datos{
    private $gbd;
    
    function __construct($driver, $database, $host, $user, $pass) {
        $conection =$driver . ":dbname=" . $database . ";host=$host";
        $this->gbd=new PDO($conection, $user,$pass);
        
        if($this->gbd) {throw new Exception("No se ha podido realizar la conexion");}
    }
    // funciones 

    function select($tabla, $filtros=null , $arr_prepare=null, $order=null, $limit=null) {
        $sql =" SELECT * FROM ".$tabla;
        if($filtros != null ){
        $sql .= " WERE " .$filtros;}
        if($order != null ){ $sql .= " ORDER BY " .$order;}
        if($limit != null ){ $sql .= " LIMIT " .$limit;}
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if($resource){ return $resource->fetchAll (PDO:FETCH_ASSOC);}
        else{
            echo '<pre>';
            print_r($this->gbd->errorInfo());
            echo'</pre>';
            throw new Exception('No se pudo consultar');
        }
    }
    
    function delete($tabla, $filtros=null , $arr_prepare=null) {
        $sql ="DELETE FROM ".$tabla . " WERE " .$filtros;

        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if($resource){ 
            $this->gbd->lastInsertId();
            return $resource->fetchAll(PDO::FETCH_ASSOC);
        }else{
            echo '<pre>';
            print_r($this->gbd->errorInfo());
            echo'</pre>';
            throw new Exception('Error al insertar datos');
        }
    }
    
    function insert($tabla, $valores, $campos, $arr_prepare=null) {
        $sql ="INSERT INTO ". $tabla . "(". $campos . ") VALUES ($valores)";
        
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if($resource){ return $resource->fetchAll (PDO:FETCH_ASSOC);}
        else{
            echo '<pre>';
            print_r($this->gbd->errorInfo());
            echo'</pre>';
            throw new Exception('No se pudo consultar');
        }
    }
    
    function update($tabla, $campo, $valor, $filtros, $arr_prepare=null) {
        $sql ="UPDATE ". $tabla . "SET". $campo . "=" . $valor . " WERE ".$filtros;
        
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if($resource){
            return $resource->fetchAll (PDO:FETCH_ASSOC);}
        else{
            echo '<pre>';
            print_r($this->gbd->errorInfo());
            echo'</pre>';
            throw new Exception('Error al actualizar ');
        }
    }
    
}

/*try{
    $conector = new PDO("mysql:dbname=miproyecto;host=127.0.0.1","root","");
    echo "Conexion Exitosa";
}catch (Exception $e){
    echo "Conexion Fallida" . $e -> getMessage();
}


class base_de_datos {
    private $conexion;

    public function __construct() {
        $servername = "localhost";
        $username = "tu_usuario";
        $password = "tu_contraseña";
        $dbname = "tu_basededatos";

        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function listar($tabla) {
        $query = "SELECT * FROM " . $tabla;
        $result = $this->conexion->query($query);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }
}
