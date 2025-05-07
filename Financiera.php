<?php

class Fincanciera{
  private $denominacion;
  private $direccion;
  private $coleccionDePrestamos;

  public function __construct($denominacion, $direccion){
    $this->denominacion = $denominacion;
    $this->direccion = $direccion;
    $this->coleccionDePrestamos = array(); 
  }

  //? Getters
  public function getDenominacion(){
    return $this->denominacion;
  }

  public function getDireccion(){
    return $this->direccion;
  }

  public function getColeccionDePrestamos(){
    return $this->coleccionDePrestamos;
  }

  //? Setters
  public function setDenominacion($denominacion){
    $this->denominacion = $denominacion;
  }

  public function setDireccion($direccion){
    $this->direccion = $direccion;
  }

  public function __toString(){
    $cadena = "Denominacion: " . $this->getDenominacion() . "\n";
    $cadena .= "Direccion: " . $this->getDireccion() . "\n";
    $cadena .= "Prestamos: \n";
    foreach ($this->getColeccionDePrestamos() as $prestamo) {
      $cadena .= $prestamo->__toString() . "\n";
    }
    return $cadena;
  }

  public function otorgarPrestamo($objCliente, $cantCuotas, $monto, $interes){

    $prestamo = new Prestamo($monto, $cantCuotas, $interes, $objCliente);
    
    $this->coleccionDePrestamos[] = $prestamo; 
  }

  public function otorgarPrestamoSiCalifica(): void {
    foreach ($this->coleccionDePrestamos as $prestamo) {
        if (empty($prestamo->getColeccionDeCuotas())) {
            $monto = $prestamo->getMonto();
            $cuotas = $prestamo->getCantidadCuotas();
            $persona = $prestamo->getPersona();
            $sueldoNeto = $persona->getSueldoNeto();

            $valorCuota = $monto / $cuotas;

            if ($valorCuota <= ($sueldoNeto * 0.40)) {
                $prestamo->otorgarPrestamo();
            }
        }
    }
  }


}