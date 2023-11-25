<?php
include '../class/autoload.php';

if(isset($_POST['action'])&&$_POST['action']== 'guardar'){
    $nuevaCategoria = new categorias();
    $nuevaCategoria ->nombre=$_POST['nombre_cat'];
    $nuevaCategoria ->guardar();
    
}else if (isset ($_GET['add'])){
    include 'views/categorias.html';
    die();
}

$listaCategorias= categorias::cat_select();
include './views/lista_categorias.html';