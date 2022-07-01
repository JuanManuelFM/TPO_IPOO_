<?php
include 'BaseDatos.php';

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

    public function cargar($idviaje, $destino, $cantMaxPasajeros, $objEmpresa, $objResponsable, $importe, $tipoAsiento, $idayvuelta, $coleccionPasajeros){
        $this->setNumEmpleado($idviaje);
        $this->setNumLicencia($destino);
        $this->setNombre($cantMaxPasajeros);
        $this->setApellido($objEmpresa);
        $this->setObjResponsable($objResponsable);
        $this->setObjResponsable($importe);
        $this->setObjResponsable($tipoAsiento);
        $this->setObjResponsable($idayvuelta);
        $this->setObjResponsable($coleccionPasajeros);
    }

    public function getNumEmpleado(){
        return $this->idviaje;
    }
    public function getNumLicencia(){
        return $this->destino;
    }
    public function getNombre(){
        return $this->cantMaxPasajeros;
    }
    public function getApellido(){
        return $this->objEmpresa;
    }
    public function getMensajeFuncion(){
        $this->objResponsable;
    }
    public function getNumLicencia(){
        return $this->importe;
    }
    public function getNombre(){
        return $this->tipoAsiento;
    }
    public function getApellido(){
        return $this->idayvuelta;
    }
    public function getMensajeFuncion(){
        $this->coleccionPasajeros;
    }

    public function setNumEmpleado($idviaje){
        $this->idviaje = $idviaje;
    }
    public function setNumLicencia($destino){
        $this->destino = $destino;
    }
    public function setNombre($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }
    public function setApellido($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }
    public function setMensajeFuncion($objResponsable){
        $this->objResponsable = $objResponsable;
    }
    public function setNumLicencia($importe){
        $this->importe = $importe;
    }
    public function setNombre($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }
    public function setApellido($idayvuelta){
        $this->idayvuelta = $idayvuelta;
    }
    public function setMensajeFuncion($coleccionPasajeros){
        $this->coleccionPasajeros = $coleccionPasajeros;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consulta= "INSERT INTO responsable VALUES ('".
        $this->getNumEmpleado()."', 
        '".$this->getNumLicencia()."',
        '".$this->getNombre()."',
        '".$this->getApellido()."')"; 
		if($base->Iniciar()){
			    if($base->Ejecutar($consulta)){
			        $resp=  true;
			    }	
                else {
				    $this->setMensajeFuncion($base->getError());		
			    }
		    } 
            else {
				$this->setMensajeFuncion($base->getError());
		    }
		return $resp;
	}
    
    /*
    rnombre
    rapellido
    rnumEmpleado
    rnumLicencia
    mensajeFuncion

    getNumEmpleado
    getNumLicencia
    getNombre
    getApellido
    getMensajeFuncion
    */

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consulta="UPDATE responsable
         SET rnumerolicencia= '".$this->getNumLicencia()."',
         rnombre= '".$this->getNombre()."',
         rapellido= '".$this->getApellido()."' 
         WHERE rnumeroempleado= ". $this->getNumEmpleado();
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
			    $resp=  true;
			}else{
				$this->setMensajeFuncion($base->getError());
				
			}
		}else{
				$this->setMensajeFuncion($base->getError());
			
		}
		return $resp;
	}

    /*
    rnombre
    rapellido
    rnumEmpleado
    rnumLicencia
    mensajeFuncion

    getNumEmpleado
    getNumLicencia
    getNombre
    getApellido
    getMensajeFuncion
    */		
    public function Buscar($numEmpleado){
		$base=new BaseDatos();
		$consulta="SELECT * FROM responsable WHERE rnumeroempleado=" .$numEmpleado;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($responsable=$base->Registro()){					
				    $this->setNombre($responsable['nombre']);
					$this->setApellido($responsable['enombre']);
					$this->setNumEmpleado($responsable['edireccion']);
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
    rnombre
    rapellido
    rnumEmpleado
    rnumLicencia
    mensajeFuncion

    getNumEmpleado
    getNumLicencia
    getNombre
    getApellido
    getMensajeFuncion
    */		

    public function listar($condicion= ""){
        $arregloResponsables= null;
		$base=new BaseDatos();
		$consultaResponsable="SELECT * FROM responsable ";
		if ($condicion != ""){
		    $consultaResponsable=$consultaResponsable.' WHERE '.$condicion;
		}
		$consultaResponsable.=" ORDER BY rnombre ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){				
				$arregloResponsables= array();
				while($responsable=$base->Registro()){
					$objResponsable= new ResponsableV();
					$objResponsable->buscar($responsable['rnumeroempleado']);
					array_push($arregloResponsables, $objResponsable);
				}
		 	}
            else{
		 		$this->setMensajeFuncion($base->getError());	
			}
		}A
        else{
		 	$this->setMensajeFuncion($base->getError());
		}	
		return $arregloResponsables;
	}	

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consulta="DELETE FROM rnumeroempleado WHERE nombre= ".$this->getNumEmpleado();
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
    rnombre
    rapellido
    rnumEmpleado
    rnumLicencia
    mensajeFuncion

    getNumEmpleado
    getNumLicencia
    getNombre
    getApellido
    getMensajeFuncion
    */		

    public function __toString(){
	    return( 
        "Nombre del responsable: " . $this->getNombre() . 
        "\n Apellido del responsable: ". $this->getApellido() . 
        "\n Numero de empleado del responsable: ". $this->getNumEmpleado() .
        "\n Numero de licencia del responsable: ". $this->getNumLicencia() . "\n");
	}
}