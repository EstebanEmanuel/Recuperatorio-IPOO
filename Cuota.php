<?php

class Cuora{

  private $numero;
  private $montoCuota;
  private $montoInteres;
  private $cancelada;  // True o False, si la cuota esta paga y false en caso contrario

  //? Metodo constructor
  public function __construct($numero, $montoCuota, $montoInteres){
    $this->numero = $numero;
    $this->montoCuota = $montoCuota;
    $this->montoInteres = $montoInteres;
    $this->cancelada = false; // Por defecto la cuota no esta paga
  }

  //? Getters
  public function getNumero(){
    return $this->numero;
  }

  public function getMontoCuota(){
    return $this->montoCuota;
  }

  public function getMontoInteres(){
    return $this->montoInteres;
  }

  public function getCancelada(){
    return $this->cancelada;
  }

  //? Setters
  public function setNumero($numero){
    $this->numero = $numero;
  }
  public function setMontoCuota($montoCuota){
    $this->montoCuota = $montoCuota;
  }
  public function setMontoInteres($montoInteres){
    $this->montoInteres = $montoInteres;
  }
  public function setCancelada($cancelada){
    $this->cancelada = $cancelada;
  }


  public function darMontoFinalCuota(){
    $montoFinal = $this->getMontoCuota() + $this->getMontoInteres();

    return $montoFinal;
  }



}