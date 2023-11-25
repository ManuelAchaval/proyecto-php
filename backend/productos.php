<?php

include '../class/autoload.php';

if(isset($_POST['action'])&&$_POST['action']== 'guardar'){
    $nuevoProducto = new productos();
    $nuevaProducto ->nombre=$_POST['nom_prod'];
    $nuevaProducto ->descripcion=$_POST['descr_prod'];
    $nuevaProducto ->precio=$_POST['precio_prod'];
    $nuevaProducto ->categoria=$_POST['cat_prod'];
    $nuevaProducto ->imagen=$_POST['img_prod'];
    $nuevaProducto -> guardar();
    
}else if (isset ($_GET['add'])){
    include 'views/productos.html';
    die();
}
include './views/lista_productos.html';