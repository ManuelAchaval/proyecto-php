<?php
include '../class/autoload.php';

if(isset($_POST['action'])&&$_POST['action']== 'guardar'){
    $nuevaCategoria = new Categorias();
    $nuevaCategoria ->nombre=$_POST['nombre_cat'];
    $nuevaCategoria ->guardar();
    
}else if (isset ($_GET['add'])){
    include 'views/categorias.html';
    die();
}

$listaCategorias= Categorias::cat_select();
var_dump($listaCategorias);
include './views/lista_categorias.html';