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

class ResponsableV{
    private $nombre;
    private $apellido;
    private $numEmpleado;
    private $numLicencia;
    private $mensajeFuncion;


    public function __construct()
    {
        $this->numEmpleado=0;
        $this->numLicencia="";
        $this->nombre="";
        $this->apellido="";
    }

    public function cargar($numEmpleado, $numLicencia, $nombre, $apellido){
        $this->setNumEmpleado($numEmpleado);
        $this->setNumLicencia($numLicencia);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
    }

    public function setNumEmpleado($numEmpleado){
        $this->numEmpleado = $numEmpleado;
    }
    public function setNumLicencia($numLicencia){
        $this->numLicencia = $numLicencia;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setMensajeFuncion($mensajeFuncion){
        $this->mensajeFuncion = $mensajeFuncion;
    }

    public function getNumEmpleado(){
        return $this->numEmpleado;
    }
    public function getNumLicencia(){
        return $this->numLicencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getMensajeFuncion(){
        $this->mensajeFuncion;
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
					$objResponsable->Buscar($responsable['rnumeroempleado']);
					array_push($arregloResponsables, $objResponsable);
				}
		 	}
            else{
		 		$this->setMensajeFuncion($base->getError());	
			}
		}
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