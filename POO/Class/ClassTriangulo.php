<?php
require_once('ClassFigura.php');

class ClassTriangulo extends ClassFigura implements IOperaciones{

  
}

$objTriangulo=new ClassTriangulo();
$objTriangulo->dibujar();


?>