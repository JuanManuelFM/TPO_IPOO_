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
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcion;
}

do{
    $opcion = menuInicio();
    switch ($opcion) {
        case 1: 
                echo "****************************************** \n";
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
        case 5: 
            echo "****************************************** \n";
            echo "Ingrese el documento de la persona cuyos datos quiera modificar: ";
            $dniPasajeroPrevio=strtoupper(trim(fgets(STDIN)));
            $listaDePasajeros= $viajeEjemplo->getColeccionPasajeros();
            //BUSCA SI EL PASAJERO EXISTE
            $posColPasajero= $viajeEjemplo->buscarPasajero($dniPasajeroPrevio);
            if($posColPasajero== -1){
                 echo "No se encontró al pasajero";
            }
            else{
            echo "ingrese nuevamente el nombre del pasajero: ";
            $nombrePasajero1=strtoupper(trim(fgets(STDIN)));
            echo "Ingrese nuevamente el apellido del pasajero: ";
            $apellidoPasajero1=strtoupper(trim(fgets(STDIN)));
            echo "Ingrese nuevamente el telefono del pasajero: ";
            $telefonoPasajero1=strtoupper(trim(fgets(STDIN)));
            echo "Ingrese nuevamente el DNI del pasajero: ";
            $dniPasajeroNuevo=strtoupper(trim(fgets(STDIN)));
            echo "****************************************** \n";
            
            $viajeEjemplo->modificarPasajero($posColPasajero, $nombrePasajero1, $apellidoPasajero1, $telefonoPasajero1);
            echo "Los datos se modificaron con exito";
            echo $viajeEjemplo;
            }
            
            //Modificar datos de un pasajero (VIEJO QUE HABIA CREADO)
            /* $buscar= true;
             * $i=0;
             * $pasajeros=$pasajerosRegistrados;
             * echo "****************************************** \n";
             * echo "Ingrese el documento de la persona cuyo nombre,  * apellido y/o telefono quiera modificar: ";
             * $documentoPasajero1=strtoupper(trim(fgets(STDIN)));
             * while($i < count($pasajerosRegistrados) && $buscar){
             *     $documentoEncontrar=$pasajerosRegistrados[$i]->getDocumento();
             *     if($documentoEncontrar == $documentoPasajero1){
             *         $buscar= false;
             *         echo "ingrese nuevamente el nombre del pasajero: ";
             *         $nombrePasajero1=strtoupper(trim(fgets(STDIN)));
             *         $pasajerosRegistrados[$i]->setNombre($nombrePasajero1);
             *         echo "Ingrese nuevamente el apellido del pasajero: ";
             *         $apellidoPasajero1=strtoupper(trim(fgets(STDIN)));
             *         $pasajerosRegistrados[$i]->setApellido($apellidoPasajero1);
             *         echo "Ingrese nuevamente el telefono del pasajero: ";
             *         $telefonoPasajero1=strtoupper(trim(fgets(STDIN)));
             *         $pasajerosRegistrados[$i]->setTelefono($telefonoPasajero1);
             *         echo "****************************************** \n";
             *      }
             *      $i++;
             * }
            */
        break;

        case 6: 
            echo "****************************************** \n";
            /**for ($i=0; $i < count($viajesRealizados); $i++){
                //$miViaje= $viajesRealizados[$i];
                echo $viajesRealizados[$i];
            }
            */
            $viajesRealizados; 
            $datosViajes="";
            foreach($viajesRealizados as $objViajes){
                //$viajesString=$viajes->__toString();
                $datosViajes=$datosViajes . "\n" . $objViajes . "\n";
        }
            echo $datosViajes;
            echo "****************************************** \n";
        break;
        case 7: 
            echo "****************************************** \n";
            echo "Clases creadas pero aún no implementadas \n";
            echo "****************************************** \n";
        break;
    }
} while (($opcion <= 7) && ($opcion >= 1));