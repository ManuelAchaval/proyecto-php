<?php

include 'class/autoload.php';

$productos = Productos::product_select();

include 'home.html';