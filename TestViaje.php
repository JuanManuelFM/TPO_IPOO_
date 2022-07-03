<?php
include "Viaje.php";
include "Pasajero.php";
include "ResponsableV.php";
include "Empresa.php";
include "BaseDatos.php";

/**
 * Solicita al usuario un número en el rango [$min,$max]
 * @param int $min
 * @param int $max
 * @return int 
 */
function solicitarNumeroEntre($min, $max){
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/**
 * Función que muestra las opciones del menú en la pantalla
 * @return int
 */

function menuInicio() {
    $minimo = 1;
    $maximo = 4;
        echo"1) :----------Sobre la empresa----------: \n";
        echo"2) :--------Sobre un Responsable--------: \n";
        echo"3) :---------Sobre los pasajeros--------: \n";
        echo"4) :----------Sobre los viajes----------: \n";
        $opcionI = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcionI;
}

function menuCategoriasEmpresa(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :--------Agregar una empresa---------: \n";
        echo"2) :-------Modificar una empresa--------: \n";
        echo"3) :---------Buscar una empresa---------: \n";
        echo"4) :--------Listar una empresa----------: \n";
        echo"5) :--------Eliminar una empresa--------: \n";
        $opcionE = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcionE;
}

function menuCategoriasResponsable(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :-------Agregar un responsable-------: \n";
        echo"2) :------Modificar un responsable------: \n";
        echo"3) :-------Buscar un responsable--------: \n";
        echo"4) :-------Listar un responsable--------: \n";
        echo"5) :------Eliminar un responsable-------: \n";
        $opcionR = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcionR;
}

function menuCategoriasPasajero(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :--------Agregar un pasajero---------: \n";
        echo"2) :-------Modificar un pasajero--------: \n";
        echo"3) :--------Buscar un pasajero----------: \n";
        echo"4) :--------Listar un pasajero----------: \n";
        echo"5) :-------Eliminar un pasajero---------: \n";
        $opcionP = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcionP;
}

function menuCategoriasViaje(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :----------Agregar un viaje----------: \n";
        echo"2) :---------Modificar un viaje---------: \n";
        echo"3) :----------Buscar un viaje-----------: \n";
        echo"4) :----------Listar un viaje-----------: \n";
        echo"5) :---------Eliminar un viaje----------: \n";
        $opcionV = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcionV;
}

/* echo "****************************************** \n";
echo ">--Ingrese numero de codigo del viaje: ";
$unCodigo=strtoupper(trim(fgets(STDIN)));
echo ">--Ingrese el destino: ";
$unDestino=strtoupper(trim(fgets(STDIN)));
echo ">--Ingrese cantidad de pasajeros: ";
$pasajeros=trim(fgets(STDIN));
echo "****************************************** \n";
$viaje= new Viaje($unCodigo, $unDestino, $pasajeros);

for($j = 0; $j < $pasajeros; $j++){
    if ($j <= $pasajeros){
        echo "^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ \n";
        echo "ingrese nombre de nuevo pasajero: ";
        $nombrePasajero=strtoupper(trim(fgets(STDIN)));
        echo "Ingrese apellido de pasajero: ";
        $apellidoPasajero=strtoupper(trim(fgets(STDIN)));
        echo "Ingrese telefono de pasajero: ";
        $telefonoPasajero=strtoupper(trim(fgets(STDIN)));
        echo "Ingrese documento de pasajero: ";
        $numeroDocumento=strtoupper(trim(fgets(STDIN)));
        echo "^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ \n";
        $pasajero= new Pasajeros($nombrePasajero, $apellidoPasajero, $telefonoPasajero, $numeroDocumento);
        $pasajerosRegistrados[$j]=$pasajero;
    }
}
$viaje->setColeccionPasajeros($pasajerosRegistrados);
$nuevaPosicionViaje=count($viajesRealizados);
$viajesRealizados[$nuevaPosicionViaje]=$viaje;
 */
do{
    $opcion = menuInicio();
    switch ($opcion){
        case 1: 
                //Menu EMPRESAS
                $OpcionEmpresa= menuCategoriasEmpresa();
                switch ($OpcionEmpresa){
                    case 1: //Agregar una EMPRESA
                        echo "Ingrese el nombre de la empresa: ";
                        $
                }
        break;
        case 2: 
            $buscar= true;
            $i=0;
            $viajes1=$viajesRealizados;
            echo "****************************************** \n";
            echo "Ingrese el codigo del viaje cuyo destino y/o cantidad de pasajeros quiera modificar: ";
            $codigoViaje1=strtoupper(trim(fgets(STDIN)));
            while($i < count($viajesRealizados) && $buscar){
                $codigoEncontrar=$viajesRealizados[$i]->getCodigo();
                if($codigoEncontrar == $codigoViaje1){
                    $buscar= false;
                    echo "Ingrese nuevamente el destino del viaje: ";
                    $destinoViaje1=strtoupper(trim(fgets(STDIN)));
                    $viajesRealizados[$i]->setDestino($destinoViaje1);
                    echo "Ingrese nuevamente el número de pasajeros del viaje: ";
                    $pasajerosViaje1=strtoupper(trim(fgets(STDIN)));
                    $viajesRealizados[$i]->setCantidadMaxPasajeros($pasajerosViaje1);
                    echo "****************************************** \n";
                }
                $i++;
            }
        break;
        case 3: 
            $buscaViaje= true;
            $j=0;
            echo "****************************************** \n";
            echo "Ingrese el código del viaje en el que desea agregar un responsable: ";
            $codViajeGuardado=strtoupper(trim(fgets(STDIN)));
            while($j < count($viajesRealizados) && $buscaViaje){
                $codigoBuscado=$viajesRealizados[$j]->getCodigo();
                if($codViajeGuardado == $codigoBuscado){
                    $buscaViaje= false;
                    if($objResViaje == null){
                        echo "ingrese nombre del nuevo responsable: ";
                        $nombreResponsableV=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese apellido del responsable: ";
                        $apellidoResponsableV=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese numero de empleado del responsable: ";
                        $numEmpleadoV=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese numero de licencia del responsable: ";
                        $numlicenciaV=strtoupper(trim(fgets(STDIN)));
                        echo "****************************************** \n";
                        $responsableCargo= new ResponsableV($nombreResponsableV, $apellidoResponsableV, $numEmpleadoV, $numlicenciaV);
                        $viajesRealizados[$j]->setObjResponsableV($responsableCargo);
                    }
                    else{
                        echo "Ya existe un responsable a cargo \n";
                        echo "****************************************** \n";
                    }
                }
                else{
                    $p++;
                }
            }
        break;
        case 4: 
            $buscandoViaje= true;
            $p=0;
            echo "****************************************** \n";
            echo "Ingrese el código del viaje en el que desea agregar un pasajero: ";
            $codigoViajeGuardado=strtoupper(trim(fgets(STDIN)));
            while($p < count($viajesRealizados) && $buscandoViaje){
                $codigoBuscado=$viajesRealizados[$p]->getCodigo();
                if($codigoViajeGuardado == $codigoBuscado){
                    $buscandoViaje= false;
                    $pasajerosGuardados=$viajesRealizados[$p]->getCantidadMaxPasajeros();
                    $coleccionPasajerosGuardados=$viajesRealizados[$p]->getColeccionPasajeros();
                    
                    if($pasajerosGuardados >= count($coleccionPasajerosGuardados)){
                        echo "ingrese nombre de nuevo pasajero: ";
                        $nombrePasajero=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese apellido de pasajero: ";
                        $apellidoPasajero=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese telefono de pasajero: ";
                        $telefonoPasajero=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese documento de pasajero: ";
                        $numeroDocumento=strtoupper(trim(fgets(STDIN)));
                        echo "****************************************** \n";
                        $pasajero= new Pasajeros($nombrePasajero, $apellidoPasajero, $telefonoPasajero, $numeroDocumento);
                        $viajesRealizados[$p]->agregarPasajeros($pasajero);
                    }
                    else{
                        echo "No hay más lugares disponibles en este viaje";
                        echo "****************************************** \n";
                    }
                }
                else{
                    $p++;
                }
            }
        break;
    }
} while (($opcion <= 4) && ($opcion >= 1));