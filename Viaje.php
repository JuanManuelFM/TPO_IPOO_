<?php

/*
CREATE TABLE responsable (
    rnumeroempleado bigint,
    rnumerolicencia bigint,
	rnombre varchar(150), 
    rapellido  varchar(150), 
    PRIMARY KEY (rnumeroempleado)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/

class Viaje{
    private $idviaje;
    private $destino;
    private $cantMaxPasajeros;
    private $objEmpresa;
    private $objResponsable;
    private $importe;
    private $tipoAsiento;
    private $idayvuelta;
    private $coleccionPasajeros;
    private $mensajeFuncion;


    public function __construct()
    {
        $this->idviaje= 0;
        $this->destino="";
        $this->cantMaxPasajeros="";
        $this->objEmpresa='';
        $this->objResponsable='';
        $this->importe="";
        $this->tipoAsiento="";
        $this->idayvuelta="";
        $this->coleccionPasajeros=[];
    }

    public function cargar($idviaje, $destino, $cantMaxPasajeros, $objEmpresa, $objResponsable, $importe, $tipoAsiento, $idayvuelta){
        $this->setIdviaje($idviaje);
        $this->setDestino($destino);
        $this->setCantMaxPasajeros($cantMaxPasajeros);
        $this->setObjEmpresa($objEmpresa);
        $this->setObjResponsable($objResponsable);
        $this->setImporte($importe);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdayvuelta($idayvuelta);
    }

    public function SetIdviaje($idviaje){
        $this->idviaje = $idviaje;
    }
    public function setDestino($destino){
        $this->destino = $destino;
    }
    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }
    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }
    public function setobjResponsable($objResponsable){
        $this->objResponsable = $objResponsable;
    }
    public function setImporte($importe){
        $this->importe = $importe;
    }
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }
    public function setIdayvuelta($idayvuelta){
        $this->idayvuelta = $idayvuelta;
    }
    public function setColeccionPasajeros($coleccionPasajeros){
        $this->coleccionPasajeros = $coleccionPasajeros;
    }
    public function setMensajeFuncion($mensajeFuncion){
        $this->mensajeFuncion = $mensajeFuncion;
    }

    public function getIdviaje(){
        return $this->idviaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getObjEmpresa(){
        return $this->objEmpresa;
    }
    public function getObjResponsable(){
        return $this->objResponsable;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }
    public function getIdayvuelta(){
        $this->idayvuelta;
    }
    public function getColeccionPasajeros(){
        $this->coleccionPasajeros;
    }
    public function getMensajeFuncion(){
        $this->mensajeFuncion;
    }
    /*
    idviaje-vdestino-vcantmaxpasajeros-idempresa
    rnumeroempleado-vimporte-tipoAsiento-idayvuelta

    getIdviaje-getDestino-getCantMaxPasajeros-getObjEmpresa
    getobjResponsable-getImporte-getTipoAsiento-getIdayvuelta
    getColeccionPasajeros
    getMensajeFuncion
    */
    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consulta= "INSERT INTO viaje VALUES (
        '".$this->getIdviaje()."', 
        '".$this->getDestino()."',
        '".$this->getCantMaxPasajeros()."',
        '".$this->getObjEmpresa()->getIdempresa()."',
        '".$this->getObjResponsable()->getNumEmpleado()."', 
        '".$this->getImporte()."',
        '".$this->getTipoAsiento()."',
        '".$this->getIdayvuelta()."')"; 
		if($base->Iniciar()){
			    if($base->Ejecutar($consulta)){
			        $resp=  true;
			    }	
                else{
				    $this->setMensajeFuncion($base->getError());		
			    }
		    } 
            else{
				$this->setMensajeFuncion($base->getError());
		    }
		return $resp;
	}
    
    /*
    idviaje-vdestino-vcantmaxpasajeros-idempresa
    rnumeroempleado-vimporte-tipoAsiento-idayvuelta

    getIdviaje-getDestino-getCantMaxPasajeros-getObjEmpresa
    getobjResponsable-getImporte-getTipoAsiento-getIdayvuelta
    getColeccionPasajeros
    getMensajeFuncion
    */

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consulta="UPDATE viaje
         SET idviaje= '".$this->getIdviaje()."',
         vdestino= '".$this->getDestino()."',
         vcantmaxpasajeros= '".$this->getCantMaxPasajeros()."',
         idempresa= '".$this->getObjEmpresa()->getIdempresa()."',
         rnumeroempleado= '".$this->getObjResponsable()->getNumEmpleado()."',
         vimporte= '".$this->getImporte()."',
         tipoAsiento= '".$this->getTipoAsiento()."',
         idayvuelta= '".$this->getIdayvuelta()."'  
         WHERE idviaje= ". $this->getIdviaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
			    $resp=  true;
			}
            else{
				$this->setMensajeFuncion($base->getError());
			}
		}
        else{
			$this->setMensajeFuncion($base->getError());	
		}
		return $resp;
	}

     /*
    idviaje-vdestino-vcantmaxpasajeros-idempresa
    rnumeroempleado-vimporte-tipoAsiento-idayvuelta

    getIdviaje-getDestino-getCantMaxPasajeros-getObjEmpresa
    getobjResponsable-getImporte-getTipoAsiento-getIdayvuelta
    getColeccionPasajeros
    getMensajeFuncion
    */		
    public function Buscar($idviaje){
		$base=new BaseDatos();
		$consulta="SELECT * FROM viaje WHERE idviaje=" .$idviaje;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($viaje=$base->Registro()){	
				    $this->setIdviaje($viaje['idviaje']);
					$this->setDestino($viaje['vdestino']);
					$this->setCantMaxPasajeros($viaje['vcantmaxpasajeros']);
                    $objEmpresa= new Empresa();
                    $objEmpresa->Buscar($viaje['idempresa']);
                    $objResponsable= new ResponsableV();
                    $objResponsable->Buscar($viaje['rnumeroempleado']);
                    $this->setObjEmpresa($objEmpresa);
                    $this->setObjEmpresa($objResponsable);
                    $this->setImporte($viaje['vimporte']);
					$this->setTipoAsiento($viaje['tipoAsiento']);
					$this->setIdayvuelta($viaje['idayvuelta']);
					$resp= true;
				}				
		 	}
            else{
		 		$this->setMensajeFuncion($base->getError());
			}
		}	
        else{
		 	$this->setMensajeFuncion($base->getError());
		}		
	return $resp;
	}	

    /*
    idviaje-vdestino-vcantmaxpasajeros-idempresa
    rnumeroempleado-vimporte-tipoAsiento-idayvuelta

    getIdviaje-getDestino-getCantMaxPasajeros-getObjEmpresa
    getobjResponsable-getImporte-getTipoAsiento-getIdayvuelta
    getColeccionPasajeros
    getMensajeFuncion
    */		
    public function listar($condicion= ""){
        $arrayViajes= null;
		$base=new BaseDatos();
		$consultaViaje="SELECT * FROM viaje ";
		if ($condicion != ""){
		    $consultaViaje=$consultaViaje.' WHERE '.$condicion;
		}
		$consultaViaje.=" ORDER BY idviaje ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViaje)){				
				$arrayViajes= array();
				while($viaje=$base->Registro()){
					$objViaje= new Viaje();
					$objViaje->Buscar($viaje['idviaje']);
					array_push($arrayViajes, $objViaje);
				}
		 	}
            else{
		 		$this->setMensajeFuncion($base->getError());	
			}
		}
        else{
		 	$this->setMensajeFuncion($base->getError());
		}	
		return $arrayViajes;
	}	

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consulta="DELETE FROM viaje WHERE idviaje= ".$this->getIdviaje();
				if($base->Ejecutar($consulta)){
				    $resp=  true;
				}
                else{
					$this->setMensajeFuncion($base->getError());	
				}
		}
        else{
			$this->setMensajeFuncion($base->getError());	
		}
		return $resp; 
	}

    public function hayPasajesDisponible(){
        $lugar = false;
        if(count($this->getCollecionPasajeros) < $this->getCantMaxPasajeros()){
           $lugar = true;
        }
        return $lugar;
    }
    /*
    idviaje-vdestino-vcantmaxpasajeros-idempresa
    rnumeroempleado-vimporte-tipoAsiento-idayvuelta

    getIdviaje-getDestino-getCantMaxPasajeros-getObjEmpresa
    getobjResponsable-getImporte-getTipoAsiento-getIdayvuelta
    getColeccionPasajeros
    getMensajeFuncion
    */	

    public function __toString(){
	    return( 
        "ID del viaje: " . $this->getIdviaje() . 
        "\n Destino del viaje: ". $this->getDestino() . 
        "\n Cantidad máxima de pasajeros permitidos en el viaje: ". $this->getCantMaxPasajeros() .
        "\n ID de la empresa encargada del viaje: ". $this->getObjEmpresa()->getIdempresa() . 
        "\n Numero de empleado del responsable: ". $this->getobjResponsable()->getNumEmpleado() .
        "\n Importe del viaje: ". $this->getImporte() . 
        "\n Tipo de asiento del viaje: ". $this->getTipoAsiento() .
        "\n Es ida y vuelta: ". $this->getIdayvuelta() . "\n");
	}
}