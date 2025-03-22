<?php
require_once('ClassFigura.php');
require_once('../Interface/IOperaciones.php');

class ClassCuadrado extends ClassFigura implements IOperaciones{
  private $alto;
  private $ancho;
  private $respuesta;
  public function __construct($al,$an)
  {
    $this->alto=$al;
    $this->ancho=$an;
  }

  public function calcular()
  {
    
  }
  public function calcularArea()
  {
    
  }

  public function imprimir(){
    echo"El valor calculado es :".$this->respuesta;
  }


}

$objCuadrado=new ClassCuadrado(100,200);
//$objCuadrado->calcular();
$objCuadrado->imprimir();
$objCuadrado->dibujar();
?>