<?php /*@autor Manuel Achaval */
class Autoload{
    static public function loadClass($class) {
        $classArr=array();
        $from= __DIR__.DIRECTORY_SEPARATOR;
        
        $classArr['database']= $from . "base_de_datos.php";
        $classArr['Categorias']= $from . "categorias.php";
        $classArr['Productos']= $from . "productos.php";
        
        if(isset($classArr[$class])){
            if(file_exists($classArr[$class])){
                include $classArr[$class];
            }else{
                throw new Exception("La clase ".$classArr[$class]." no existe");
            }
        }
    }
}

spl_autoload_register('Autoload::loadClass');