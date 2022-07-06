<?php

/*
CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/

class Empresa
{
    private $idempresa;
    private $nombreEmpresa;
    private $direccionEmpresa;
    private $mensajeFuncion;


    public function __construct()
    {
        $this->idempresa="";
        $this->nombreEmpresa="";
        $this->direccionEmpresa="";
    }

    public function cargar($idempresa, $nombreEmpresa, $direccionEmpresa){
        $this->setIdempresa($idempresa);
        $this->setNombreEmpresa($nombreEmpresa);
        $this->setDireccionEmpresa($direccionEmpresa);
    }

	public function setIdempresa($idempresa){
        $this->idempresa = $idempresa;
    }
    public function setNombreEmpresa($nombreEmpresa){
        $this->nombreEmpresa = $nombreEmpresa;
    }
    public function setDireccionEmpresa($direccionEmpresa){
        $this->direccionEmpresa = $direccionEmpresa;
    }
    public function setMensajeFuncion($mensajeFuncion){
        $this->mensajeFuncion = $mensajeFuncion;
    }

    public function getIdempresa(){
        return $this->idempresa;
    }
    public function getNombreEmpresa(){
        return $this->nombreEmpresa;
    }
    public function getDireccionEmpresa(){
        return $this->direccionEmpresa;
    }
    public function getMensajeFuncion(){
        return $this->mensajeFuncion;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consulta= "INSERT INTO empresa (enombre, edireccion) VALUES ('".$this->getNombreEmpresa()."',
		'".$this->getDireccionEmpresa()."')"; 
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
    private $idempresa;
    private $nombreEmpresa;
    private $direccionEmpresa;
    private $mensajeFuncion;
    */

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consulta="UPDATE empresa
         SET idempresa= '".$this->GetIdempresa()."',
         enombre= '".$this->GetNombreEmpresa()."',
         edireccion= '".$this->GetDireccionEmpresa()."' 
         WHERE idempresa= ". $this->GetIdempresa();
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
    private $idempresa;
    private $nombreEmpresa;
    private $direccionEmpresa;
    private $mensajeFuncion;
    
	 Función que busca una EMPRESA en base a un ID
	*/		
    public function Buscar($idempresa){
		$base=new BaseDatos();
		$consulta="SELECT * FROM empresa WHERE idempresa=" .$idempresa;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($empresa=$base->Registro()){					
				    $this->setIdempresa($idempresa);
					$this->setNombreEmpresa($empresa['enombre']);
					$this->setDireccionEmpresa($empresa['edireccion']);
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
    private $idempresa;
    private $nombreEmpresa;
    private $direccionEmpresa;
    private $mensajeFuncion;
    
	 Función que lista 
	*/	

    public function listar($condicion=""){
        $arregloEmpresas= null;
		$base=new BaseDatos();
		$consultaEmpresa="SELECT * FROM empresa ";
		if ($condicion != ""){
		    $consultaEmpresa=$consultaEmpresa.' WHERE '.$condicion;
		}
		$consultaEmpresa.=" ORDER BY idempresa ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){				
				$arregloEmpresas= array();
				while($empresa=$base->Registro()){
					$objEmpresa= new Empresa();
					$objEmpresa->Buscar($empresa['idempresa']);
					array_push($arregloEmpresas, $objEmpresa);
				}
		 	}
            else{
		 		$this->setMensajeFuncion($base->getError());	
			}
		}
        else{
		 	$this->setMensajeFuncion($base->getError());
		}	
		return $arregloEmpresas;
	}	

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consulta="DELETE FROM empresa WHERE idempresa= ".$this->GetIdempresa();
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
    private $idempresa;
    private $nombreEmpresa;
    private $direccionEmpresa;
    private $mensajeFuncion;
    
	 Función que lista 
	*/

    public function __toString(){
	    return( 
        "ID empresa: " . $this->GetIdempresa() . 
        "\n Nombre de la empresa: ". $this->getNombreEmpresa() . 
        "\n Dirección de la empresa: ". $this->getDireccionEmpresa() . "\n");
	}
}