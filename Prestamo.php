<?php

class Prestamo{

  private static int $contador = 1;

  private $identificacion;
  private $codigoElectrodomestico;
  private $fechaOtorgamiento;
  private $monto;
  private $cantidadCuotas;
  private $tazaInteres;
  private $coleccionDeCuotas;
  private $refPersona; // referencia a la persona que solicito el préstamo.


  public function __construct($monto, $cantidadCuotas, $tazaInteres, $refPersona){
    $this->monto = $monto;
    $this->cantidadCuotas = $cantidadCuotas;
    $this->tazaInteres = $tazaInteres;
    $this->refPersona = $refPersona;
    $this->coleccionDeCuotas = array(); 
    $this-> identificacion = self::$contador++;
  }

  //? Getters
  public function getMonto(){
    return $this->monto;
  }

  public function getCantidadCuotas(){
    return $this->cantidadCuotas;
  }

  public function getTazaInteres(){
    return $this->tazaInteres;
  }

  public function getRefPersona(){
    return $this->refPersona;
  }

  public function getColeccionDeCuotas(){
    return $this->coleccionDeCuotas;
  }

  public function getIdentificacion(){
    return $this->identificacion;
  }

  public function getCodigoElectrodomestico(){
    return $this->codigoElectrodomestico;
  }

  public function getFechaOtorgamiento(){
    return $this->fechaOtorgamiento;
  }

  //? Setters
  public function setMonto($monto){
    $this->monto = $monto;
  }
  public function setCantidadCuotas($cantidadCuotas){
    $this->cantidadCuotas = $cantidadCuotas;
  }
  public function setTazaInteres($tazaInteres){
    $this->tazaInteres = $tazaInteres;
  }
  public function setRefPersona($refPersona){
    $this->refPersona = $refPersona;
  }
  public function setColeccionDeCuotas($coleccionDeCuotas){
    $this->coleccionDeCuotas = $coleccionDeCuotas;
  }
  public function setIdentificacion($identificacion){
    $this->identificacion = $identificacion;
  }
  public function setCodigoElectrodomestico($codigoElectrodomestico){
    $this->codigoElectrodomestico = $codigoElectrodomestico;
  }
  public function setFechaOtorgamiento($fechaOtorgamiento){
    $this->fechaOtorgamiento = $fechaOtorgamiento;
  }

  private function calcularInteresPrestamo($numCuota){
    $interes = 0;

    if ($numCuota == 1){
      $interes = $this->getMonto()*0.01;
    }else{
      $interes = ($this->getMonto()-(($this->getMonto()/$this->getCantidadCuotas()*$numCuota))*$this->getTazaInteres())/0.01;
    }

    return $interes;
  }

  public function otorgarPrestamo(){
    $this->setFechaOtorgamiento(getdate("d/m/Y"));

    $capitalPorCuota = $this->monto / $this->cantidadCuotas;

    for ($i = 1; $i <= $this->cantidadCuotas; $i++) {
        $interes = $this->calcularInteresPrestamo($i);

        $cuota = [
            'numero' => $i,
            'capital' => $capitalPorCuota,
            'interes' => $interes,
            'total' => $capitalPorCuota + $interes
        ];

        $this->coleccionDeCuotas = $cuota;
    }
  }

  public function darSiguienteCuotaPagar() {
    $referencia = null;

    foreach ($this->coleccionDeCuotas as $cuota) {
        if (!$cuota->getCancelada()) {
            $referencia = $cuota;
        }
    }
    return $referencia;
  }
}