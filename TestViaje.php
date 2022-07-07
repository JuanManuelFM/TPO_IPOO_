<?php
include "Viaje.php";
include "Pasajero.php";
include "ResponsableV.php";
include "Empresa.php";
include 'BaseDatos.php';

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
        echo"3) :--------Sobre los pasajeros---------: \n";
        echo"4) :----------Sobre los viajes----------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcion;
}

function menuCategoriasEmpresa(){
    $minimo = 1;
    $maximo = 6;
        echo"1) :---------Agregar una empresa--------: \n";
        echo"2) :--------Modificar una empresa-------: \n";
        echo"3) :---------Buscar una empresa---------: \n";
        echo"4) :-----------Listar empresas----------: \n";
        echo"5) :--------Eliminar una empresa--------: \n";
        echo"6) :----------------Salir---------------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcion;
}

function menuCategoriasResponsable(){
    $minimo = 1;
    $maximo = 6;
        echo"1) :-------Agregar un responsable-------: \n";
        echo"2) :------Modificar un responsable------: \n";
        echo"3) :-------Buscar un responsable--------: \n";
        echo"4) :--------Listar responsables---------: \n";
        echo"5) :------Eliminar un responsable-------: \n";
        echo"6) :---------------Salir----------------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcion;
}

function menuCategoriasPasajero(){
    $minimo = 1;
    $maximo = 6;
        echo"1) :--------Agregar un pasajero---------: \n";
        echo"2) :-------Modificar un pasajero--------: \n";
        echo"3) :--------Buscar un pasajero----------: \n";
        echo"4) :---------Listar pasajeros-----------: \n";
        echo"5) :-------Eliminar un pasajero---------: \n";
        echo"6) :---------------Salir----------------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcion;
}

function menuCategoriasViaje(){
    $minimo = 1;
    $maximo = 7;
        echo"1) :----------Agregar un viaje----------: \n";
        echo"2) :----Agregar pasajero a un viaje-----: \n";
        echo"3) :---------Modificar un viaje---------: \n";
        echo"4) :----------Buscar un viaje-----------: \n";
        echo"5) :-----------Listar viajes------------: \n";
        echo"6) :---------Eliminar un viaje----------: \n";
        echo"7) :---------------Salir----------------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcion;
}

//Función que verifica que el usuario responda correctamente a las confirmaciones SI o NO.
function verificadorSiNo($respuesta){
    $bandera= $respuesta == "SI" || $respuesta == "NO";
    while (!$bandera) {
        echo "Su respuesta solo puede ser un SI o NO. Por favor, vuelva a ingresar su respuesta: ";
        $respuesta = strtoupper(trim(fgets(STDIN)));
        $bandera= $respuesta == "SI" || $respuesta == "NO";
    }
    return $respuesta;
}

function PrimeraOEstandar($tipo){
    $bandera= $tipo == "PC" || $tipo == "CE";
    while (!$bandera) {
        echo "Su respuesta solo puede ser un PC para Primera Clase o CE para Clase Estandar. Por favor, vuelva a ingresar su respuesta: ";
        $tipo = strtoupper(trim(fgets(STDIN)));
        $bandera= $tipo == "PC" || $tipo == "CE";
    }
    return $tipo;
}

do{
    $opcionMenu = menuInicio();
    switch ($opcionMenu) {
        case 1:
            do{//Menu EMPRESAS
                $OpcionEmpresa= menuCategoriasEmpresa();
                switch ($OpcionEmpresa) {
                case 1: //AGREGAR una empresa
                    $objNuevaEmpresa= new Empresa();
                    $arrayEmpresas= $objNuevaEmpresa->Listar();
                    foreach ($arrayEmpresas as $datosEmpresas) {
                        echo "******************************************** \n";
                        echo $datosEmpresas;
                        echo "******************************************** \n";
                    }
                    echo "Ingrese el nombre de la empresa: ";
                    $nombre= trim(fgets(STDIN));
                    echo "Ingrese la dirección de la empresa: ";
                    $direccion= trim(fgets(STDIN));
                    $objNuevaEmpresa->cargar("", $nombre, $direccion); //Direccion no funciona si hay numero
                    if ($objNuevaEmpresa->insertar()) {
                        echo "La empresa se ha creado con exito \n";
                    } else {
                        echo "Ocurrió algún error al crear la empresa... \n";
                    }
                break;
                case 2: //MODIFICAR una empresa
                    $objEmpresa= new Empresa();
                    $arrayEmpresas= $objEmpresa->Listar();
                    foreach ($arrayEmpresas as $datosEmpresas) {
                        echo "******************************************** \n";
                        echo $datosEmpresas;
                        echo "******************************************** \n";
                    }
                    echo "Ingrese el ID de la empresa que deséa modificar: ";
                    $id= trim(fgets(STDIN));
                    while (!$objEmpresa->Buscar($id)) {
                        echo "No hay una empresa con ese ID, por favor intentelo con otro ID valido: ";
                        $id= trim(fgets(STDIN));
                    }
                    echo "************************** \n";
                    echo $objEmpresa->__toString();
                    echo "************************** \n";
                        //$idE= $objEmpresa->getIdempresa();
                    echo "Ingrese nuevamente el nombre de la empresa: ";
                    $nombreE= strtoupper(trim(fgets(STDIN)));
                    $objEmpresa->setNombreEmpresa($nombreE);
                    echo "Ingrese nuevamente la dirección de la empresa: ";
                    $direccionE= strtoupper(trim(fgets(STDIN)));
                    $objEmpresa->setDireccionEmpresa($direccionE);
                        if ($objEmpresa->modificar()) {
                            echo "La empresa se ha modificado con exito... \n";
                        } else {
                            echo "Ocurrió algún error al modificar la empresa... \n";
                        }
                break;
                case 3: //BUSCAR una empresa
                    echo "Ingrese el ID de la empresa que desea buscar: ";
                    $id= trim(fgets(STDIN));
                    $objEmpresa= new Empresa();
                    while (!$objEmpresa->Buscar($id)) {
                        echo "No hay una empresa con ese ID, por favor intentelo con otro ID valido: ";
                        $id= trim(fgets(STDIN));
                    }
                    echo "Se encontró la empresa del ID " . $id . ". Los datos registrados de la empresa son: \n";
                    echo "******************************************** \n";
                    echo $objEmpresa->__toString();
                    echo "******************************************** \n";
                break;
                case 4: //LISTAR empresas
                    echo "¿Desea listar con algúna condición en específico? si/no: ";
                    $respuesta= strtoupper(trim(fgets(STDIN)));
                    $laRespuesta= verificadorSiNo($respuesta);
                    $objEmpresa= new Empresa();
                    if ($laRespuesta == "NO") {
                        $arrayEmpresas= $objEmpresa->listar();
                        $datosEmpresas="";
                        $cantidadEmpresas= count($arrayEmpresas);
                        if ($cantidadEmpresas !== 0) {
                            foreach ($arrayEmpresas as $datosEmpresas) {
                                echo "******************************************** \n";
                                echo $datosEmpresas;
                                echo "****************************************** \n";
                            }
                        } else {
                            echo "No hay ninguna empresa creada... \n";
                        }
                    } else {
                        echo "Escriba la condición de listado en formato SQL, el WHERE ya está incluido: ";
                        $condicion= strtoupper(trim(fgets(STDIN)));
                        $arrayEmpresas= $objEmpresa->listar($condicion);
                        $datosEmpresas="";
                        $cantidadEmpresas= count($arrayEmpresas);
                        if ($cantidadEmpresas !== 0) {
                            foreach ($arrayEmpresas as $datosEmpresas) {
                                echo "******************************************** \n";
                                echo $datosEmpresas;
                                echo "****************************************** \n";
                            }
                        } else {
                            echo "No hay ninguna empresa creada WHERE " . $condicion . "... \n";
                        }
                    }
                break;
                case 5: //ELIMINAR una empresa
                    echo "Ingrese el ID de la empresa que desea borrar: ";
                    $id= trim(fgets(STDIN));
                    $objEmpresa= new Empresa();
                    if ($objEmpresa->buscar($id)) {
                        echo "******************************************** \n";
                        echo $objEmpresa->__toString();
                        echo "******************************************** \n";
                        echo "¿Esta es la empresa que usted desea eliminar? si/no: ";
                        $respuesta= strtoupper(trim(fgets(STDIN)));
                        $laRespuesta= verificadorSiNo($respuesta);
                        if ($laRespuesta == "NO") {
                            echo "Usted ha decidido no borrar esta empresa... \n";
                        } else {
                            if ($objEmpresa->eliminar()) {
                                echo "La empresa se ha eliminado con exito... \n";
                            } else {
                                echo "La empresa esta siendo utilizado con muchos datos... \n";
                            }
                        }
                    } else {
                        echo "No se encontró una empresa con el ID indicado... \n";
                    }
                break;
                case 6:
                break;
        }
            } while (($OpcionEmpresa <= 5) && ($OpcionEmpresa >= 1));
            break;
        case 2:
            do{//Menu RESPONSABLE
            $OpcionResponsable= menuCategoriasResponsable();
            switch ($OpcionResponsable) {
                case 1: //AGREGAR un responsable
                    $objNuevoResponsable= new ResponsableV();
                    $arrayResponsables= $objNuevoResponsable->Listar();
                    foreach ($arrayEmpresas as $datosResponsables) {
                        echo "******************************************** \n";
                        echo $datosResponsables;
                        echo "******************************************** \n";
                    }
                    //CHEQUEAR QUE PASA CON EL ID
                    echo "Ingrese el numero de licencia del responsable: ";
                    $licencia= trim(fgets(STDIN));
                    echo "Ingrese el nombre del responsable: ";
                    $nombreR= strtoupper(trim(fgets(STDIN)));
                    echo "Ingrese el apellido del responsable: ";
                    $apellidoR= strtoupper(trim(fgets(STDIN)));
                    $objNuevoResponsable->cargar("", $licencia, $nombreR, $apellidoR);
                    if ($objNuevoResponsable->insertar()) {
                        echo "El responsable se ha creado con exito... \n";
                    } else {
                        echo "Ocurrió algún error al crear el responsable... \n";
                    }
                break;
                case 2: //MODIFICAR una responsable
                    $objPruebaResponsable= new ResponsableV();
                    $arrayResponsables= $objPruebaResponsable->Listar();
                    foreach ($arrayResponsables as $datosResponsables){
                        echo "******************************************** \n";
                        echo $datosResponsables;
                        echo "******************************************** \n";
                    }
                    echo "Ingrese el Nº de empleado del responsable que deséa modificar: ";
                    $numR= trim(fgets(STDIN));
                    if ($objPruebaResponsable->Buscar($numR)) {
                        echo "************************** \n";
                        echo $objPruebaResponsable->__toString();
                        echo "************************** \n";
                        //$numEmpleado= $objPruebaResponsable->getNumEmpleado();
                        echo "Ingrese nuevamente de licencia del responsable: ";
                        $licencia= trim(fgets(STDIN));
                        $objPruebaResponsable->setNumLicencia($licencia);
                        echo "Ingrese nuevamente el nombre del responsable: ";
                        $nombreR= strtoupper(trim(fgets(STDIN)));
                        $objPruebaResponsable->setNombre($nombreR);
                        echo "Ingrese nuevamente el apellido del responsable: ";
                        $apellidoR= strtoupper(trim(fgets(STDIN)));
                        $objPruebaResponsable->setApellido($apellidoR);
                        if ($objPruebaResponsable->modificar()) {
                            echo "El responsable se ha modificado con exito... \n";
                        } else {
                            echo "Ocurrió algún error al modificar el responsable... \n";
                        }
                    } else {
                        echo "No se encontró un responsable con el Nº de empleado indicado... \n";
                    }
                break;
                case 3: //BUSCAR un responsable
                    echo "Ingrese el Nº de empleado que desea buscar: ";
                    $numE= trim(fgets(STDIN));
                    $objPruebaResponsable= new ResponsableV();
                    if ($objPruebaResponsable->Buscar($numE)) {
                        echo "Se encontró el responsable del Nº de empleado " . $numE . ". Los datos registrados del mismo son: \n";
                        echo "******************************************** \n";
                        echo $objPruebaResponsable->__toString();
                        echo "******************************************** \n";
                    } else {
                        echo "No se encontró un responsable con el Nº de empleado indicado... \n";
                    }
                break;
                case 4: //LISTAR responsable
                    echo "¿Desea listar con algúna condición en específico? si/no: ";
                    $respuesta= strtoupper(trim(fgets(STDIN)));
                    $laRespuesta= verificadorSiNo($respuesta);
                    $objPruebaResponsable= new ResponsableV();
                    if ($laRespuesta == "NO") {
                        $arrayResponsables= $objPruebaResponsable->listar();
                        $datosResponsables="";
                        $cantidadResponsables= count($arrayResponsables);
                        if ($cantidadResponsables !== 0) {
                            foreach ($arrayResponsables as $datosResponsables) {
                                echo "******************************************** \n";
                                echo $datosResponsables;
                                echo "******************************************** \n";
                            }
                        } else {
                            echo "No hay ningún responsable creado... \n";
                        }
                    } else {
                        echo "Escriba la condición de listado en formato SQL, el WHERE ya está incluido: ";
                        $condicion= strtoupper(trim(fgets(STDIN)));
                        $arrayResponsables= $objPruebaResponsable->listar($condicion);
                        $datosResponsables="";
                        $cantidadResponsables= count($arrayResponsables);
                        if ($cantidadResponsables !== 0) {
                            foreach ($arrayResponsables as $datosResponsables) {
                                echo "******************************************** \n";
                                echo $datosResponsables;
                                echo "******************************************** \n";
                            }
                        } else {
                            echo "No hay ningún responsable creado WHERE " . $condicion . "... \n";
                        }
                    }
                break;
                case 5: //ELIMINAR un responsable
                    echo "Ingrese el Nº de empleado del responsable que desea borrar: ";
                    $numE= trim(fgets(STDIN));
                    $objPruebaResponsable= new ResponsableV();
                    if ($objPruebaResponsable->buscar($numE)) {
                        echo "******************************************** \n";
                        echo $objPruebaResponsable->__toString();
                        echo "******************************************** \n";
                        echo "¿Este es el responsable que usted desea eliminar? si/no: ";
                        $respuesta= strtoupper(trim(fgets(STDIN)));
                        $laRespuesta= verificadorSiNo($respuesta);
                        if ($laRespuesta == "NO") {
                            echo "Usted ha decidido no borrar esta empresa... \n";
                        } else {
                            if ($objPruebaResponsable->eliminar()) {
                                echo "El responsable se ha eliminado con exito... \n";
                            } else {
                                echo "El responsable esta siendo utilizado en algún viaje... \n";
                            }
                        }
                    } else {
                        echo "No se encontró una empresa con el ID indicado... \n";
                    }
                case 6:
                break;
            }
        } while (($OpcionResponsable <= 5) && ($OpcionResponsable >= 1));
        break;
        case 3:
            do{//Menu PASAJEROS
            $OpcionPasajeros= menuCategoriasPasajero();
            switch ($OpcionPasajeros) {
                case 1: //AGREGAR un pasajero
                    $objNuevoPasajero= new Pasajero();
                    $arrayPasajeros= $objNuevoPasajero->Listar();
                    foreach ($arrayPasajeros as $datosPasajeros){
                        echo "******************************************** \n";
                        echo $datosPasajeros;
                        echo "******************************************** \n";
                    }
                    $objPruebaViaje= new Viaje();
                    echo "Ingrese el nombre del pasajero: ";
                    $nombreP= trim(fgets(STDIN));
                    echo "Ingrese el apellido del pasajero: ";
                    $apellidoP= trim(fgets(STDIN));
                    echo "Ingrese el documento del pasajero: ";
                    $documentoP= trim(fgets(STDIN));
                    while ($objNuevoPasajero->Buscar($documentoP)) {
                        echo "Ya existe un pasajero con el documento ingresado, ingrese otro: ";
                        $documentoP= trim(fgets(STDIN));
                    }
                    echo "Ingrese el telefono del pasajero: ";
                    $telefono= trim(fgets(STDIN));
                    echo "Ingrese el ID del viaje al que pertenecerá este pasajero: ";
                    $id= trim(fgets(STDIN));
                    while (!$objPruebaViaje->buscar($id)) {
                        echo "No hay un viaje con ese ID, por favor intentelo con otro ID valido: ";
                        $id= trim(fgets(STDIN));
                    }    
                    $objNuevoPasajero->cargar($nombreP, $apellidoP, $documentoP, $telefono, $objPruebaViaje);
                        if ($objNuevoPasajero->insertar()) {
                            echo "El pasajero se ha creado con exito... \n";
                        } else {
                            echo "Ocurrió algún error al crear al pasajero... \n";
                        }
                break;
                case 2: //MODIFICAR un pasajero
                    $objPasajeroPrueba= new Pasajero();
                    $arrayPasajeros= $objPasajeroPrueba->Listar();
                    foreach ($arrayPasajeros as $datosPasajeros){
                        echo "******************************************** \n";
                        echo $datosPasajeros;
                        echo "******************************************** \n";
                    }
                    echo "Ingrese el N° de documento del pasajero que deséa modificar: ";
                    $doc= trim(fgets(STDIN));
                    $objPruebaViaje= new Viaje();
                    if ($objPasajeroPrueba->Buscar($doc)) {
                        echo "******************************************** \n";
                        echo $objPasajeroPrueba->__toString();
                        echo "******************************************** \n";
                        echo "Ingrese nuevamente el nombre del pasajero: ";
                        $nombreP= trim(fgets(STDIN));
                        $objPasajeroPrueba->setNombre($nombreP);
                        echo "Ingrese nuevamente el apellido del pasajero: ";
                        $apellidoP= trim(fgets(STDIN));
                        $objPasajeroPrueba->setApellido($apellidoP);
                        echo "Ingrese nuevamente el telefono del pasajero: ";
                        $telefono= trim(fgets(STDIN));
                        $objPasajeroPrueba->setTelefono($telefono);
                        echo "Ingrese nuevamente el ID del viaje al que pertenecerá este pasajero: ";
                        $id= trim(fgets(STDIN));
                        while (!$objPruebaViaje->Buscar($id)) {
                            echo "No hay un viaje con ese ID, por favor intentelo con otro ID valido: ";
                            $id= trim(fgets(STDIN));
                        }
                        $objPruebaViaje->setIdviaje($id);
                        $objPasajeroPrueba->setObjViaje($objPruebaViaje);
                        if ($objPasajeroPrueba->modificar()) {
                            echo "El pasajero se ha modificado con exito... \n";
                        } else {
                            echo "Ocurrió algún error al modificar el pasajero... \n";
                        }
                    } else {
                        echo "No se encontró un pasajero con el N° de documento indicado... \n";
                    }
                break;
                case 3: //BUSCAR un pasajero
                    echo "Ingrese el N° de documento del pasajero que desea buscar: ";
                    $doc= trim(fgets(STDIN));
                    $objPasajeroPrueba= new Pasajero();
                    while (!$objPasajeroPrueba->Buscar($doc)) {
                        echo "No hay un pasajero con ese N° de documento, por favor intentelo con otro documento valido: ";
                        $doc= trim(fgets(STDIN));
                    }
                    echo "Se encontró el pasajero con el N° de documento  " . $doc . ". Los datos registrados del pasajero son: \n";
                    echo "******************************************** \n";
                    echo $objPasajeroPrueba->__toString();
                    echo "******************************************** \n";
                break;
                case 4: //LISTAR pasajeros
                    echo "¿Desea listar con algúna condición en específico? si/no: ";
                    $respuesta= strtoupper(trim(fgets(STDIN)));
                    $laRespuesta= verificadorSiNo($respuesta);
                    $objPasajeroPrueba= new Pasajero();
                    if ($laRespuesta == "NO") {
                        $arrayPasajeros= $objPasajeroPrueba->listar();
                        $datosPasajeros="";
                        $cantidadPasajeros= count($arrayPasajeros);
                        if ($cantidadPasajeros !== 0) {
                            foreach ($arrayPasajeros as $datosPasajeros) {
                                echo "******************************************** \n";
                                echo $datosPasajeros;
                                echo "******************************************** \n";
                            }
                        }
                        else{
                            echo "No hay ningún pasajero creado... \n";
                        }
                    } 
                    else {
                        echo "Escriba la condición de listado en formato SQL, el WHERE ya está incluido: ";
                        $condicion= strtoupper(trim(fgets(STDIN)));
                        $arrayPasajeros= $objPasajeroPrueba->listar($condicion);
                        $datosPasajeros="";
                        $cantidadPasajeros= count($arrayPasajeros);
                        if ($cantidadPasajeros !== 0) {
                            foreach ($arrayPasajeros as $datosPasajeros) {
                                echo "******************************************** \n";
                                echo $datosPasajeros;
                                echo "******************************************** \n";
                            }
                        }
                        else{
                            echo "No hay ningún pasajero creado WHERE ". $condicion . "...\n";
                        }
                    }
                    break;
                    case 5: //ELIMINAR un pasajero
                        echo "Ingrese el N° de documento de la empresa que desea borrar: ";
                        $doc= trim(fgets(STDIN));
                        $objPasajeroPrueba= new Pasajero();
                        if ($objPasajeroPrueba->buscar($doc)) {
                            echo "******************************************** \n";
                            echo $objPasajeroPrueba->__toString();
                            echo "******************************************** \n";
                            echo "¿Este es el pasajero que usted desea eliminar? si/no: ";
                            $respuesta= strtoupper(trim(fgets(STDIN)));
                            $laRespuesta= verificadorSiNo($respuesta);
                            if ($laRespuesta == "NO") {
                                echo "Usted ha decidido no borrar esta empresa... \n";
                            } else {
                                if ($objPasajeroPrueba->eliminar()) {
                                    echo "El pasajero se ha eliminado con exito... \n";
                                } else {
                                    echo "El pasajero esta siendo utilizado en algún viaje... \n";
                                }
                            }
                        } else {
                            echo "No se encontró un pasajero con el N° de documento ingresado... \n";
                        }
                    case 6:
                    break;
            }
        } while (($OpcionPasajeros <= 5) && ($OpcionPasajeros >= 1));       
        break;
        case 4:
            do{ 
            $opcionViajes= menuCategoriasViaje();
            switch ($opcionViajes) {
                case 1: //CREAR un viaje
                    $objNuevoViaje= new Viaje();
                    $arrayViajes= $objNuevoViaje->Listar();
                    foreach ($arrayViajes as $datosViajes){
                        echo "******************************************** \n";
                        echo $datosViajes;
                        echo "******************************************** \n";
                    }
                    $objResponsablePrueba= new ResponsableV();
                    $objEmpresaPrueba= new Empresa();
                    //CHEQUEAR QUE PASA CON EL ID
                    echo "Ingrese el destino del viaje: ";
                    do {
                        $destinoV= strtoupper(trim(fgets(STDIN)));
                        $arrayViajes= $objNuevoViaje->Listar("vdestino= '$destinoV'");
                        $numeroViajesDestino= count($arrayViajes);
                        if ($numeroViajesDestino > 0) {
                            echo "Ya hay un viaje creado hacia el mismo destino, ingrese otro destino: ";
                        }
                    } while ($numeroViajesDestino > 0);
                        echo "Ingrese cantidad máxima de pasajeros del viaje: ";
                        $cantMaxPasajeros= trim(fgets(STDIN));
                        echo "Ingrese el ID de la empresa que organiza el viaje: ";
                        $idE= trim(fgets(STDIN));
                        while (!$objEmpresaPrueba->Buscar($idE)) {
                            echo "No hay una empresa con el ID ingresado, por favor intentelo con otro ID valido: ";
                            $idE= trim(fgets(STDIN));
                        }
                        echo "Ingrese el N° de empleado del responsable a cargo: ";
                        $numEmpleado= trim(fgets(STDIN));
                        while (!$objResponsablePrueba->Buscar($numEmpleado)) {
                            echo "No hay responsable con ese N° de empleado, por favor intentelo con otro numero valido: ";
                            $numEmpleado= trim(fgets(STDIN));
                        }
                        echo "Ingrese el importe del viaje: ";
                        $importe= trim(fgets(STDIN));
                        echo "Tipo de asiento del viaje PC(Primera clase)/CE(Clase estandar): ";
                        $tipoAsiento= strtoupper(trim(fgets(STDIN)));
                        $tipoDeAsiento= PrimeraOEstandar($tipoAsiento);
                        echo "Ingrese si/no dependiendo si el viaje es ida y vuelta: ";
                        $idaVuelta= strtoupper(trim(fgets(STDIN)));
                        $idaYVuelta= verificadorSiNo($idaVuelta);
                        $objNuevoViaje->cargar("", $destinoV, $cantMaxPasajeros, $objEmpresaPrueba, $objResponsablePrueba, $importe, $tipoDeAsiento, $idaYVuelta);
                        if ($objNuevoViaje->insertar()) {
                            echo "El viaje se ha creado con exito... \n";
                        } else {
                            echo "Ocurrió algún error al crear el viaje... \n";
                        }
                break;
                case 2: //AGREGA pasajeros
                    $objViajePrueba= new Viaje();
                    $arrayPasajeros= $objViajePrueba->Listar();
                    foreach ($arrayPasajeros as $datosViajes) {
                        echo "******************************************** \n";
                        echo $datosViajes;
                        echo "******************************************** \n";
                    }
                    $objNuevoPasajero= new Pasajero();
                    echo "Ingrese el ID del viaje al que desea agregar un pasajero: ";
                    $id= trim(fgets(STDIN));
                    while (!$objViajePrueba->Buscar($id)) {
                        echo "No hay un viaje con ese ID, por favor intentelo con otro ID valido: ";
                        $id= trim(fgets(STDIN));
                    }
                    $lugar= $objViajePrueba->hayPasajesDisponible();
                    //echo $lugar;
                    if ($lugar) {
                        $objViajePrueba->obtenerPasajeros();
                        $arrayPasajerosV= $objViajePrueba->getColeccionPasajeros();
                        $datosPasajerosV="";
                        $cantidadPasajerosV= count($arrayPasajerosV);
                            foreach ($arrayPasajerosV as $datosPasajerosV) {
                                echo "******************************************** \n";
                                echo $datosPasajerosV . "\n";
                                echo "******************************************** \n";
                            }
                        echo "Ingrese el nombre del pasajero: ";
                        $nombreP= trim(fgets(STDIN));
                        echo "Ingrese el apellido del pasajero: ";
                        $apellidoP= trim(fgets(STDIN));
                        echo "Ingrese el documento del pasajero: ";
                        $documentoP= trim(fgets(STDIN));
                        while ($objNuevoPasajero->Buscar($documentoP)){
                            echo "Ya existe un pasajero con el documento ingresado, ingrese otro: ";
                            $documentoP= trim(fgets(STDIN));
                        }
                        echo "Ingrese el telefono del pasajero: ";
                        $telefono= trim(fgets(STDIN));    
                        $objNuevoPasajero->cargar($nombreP, $apellidoP, $documentoP, $telefono, $objViajePrueba);
                        if ($objNuevoPasajero->insertar()) {
                            $objViajePrueba->agregarPasajero($objNuevoPasajero);
                            echo "El pasajero se ha creado y añadido al viaje con exito... \n";
                        }
                        else{
                            echo "Ocurrió un error al agregar el nuevo pasajero... \n";
                        }
                    } 
                    else{
                        echo "No hay más lugares disponibles en este viaje... \n";
                    }
                    echo "¿Desea ver las personas registradas en este viaje? si/no: ";
                        $respuesta= strtoupper(trim(fgets(STDIN)));
                        $laRespuesta= verificadorSiNo($respuesta);
                        if($laRespuesta == "SI"){
                            $objViajePrueba->obtenerPasajeros();
                            $arrayPasajerosV= $objViajePrueba->getColeccionPasajeros();
                            $datosPasajerosV="";
                            $cantidadPasajerosV= count($arrayPasajerosV);
                            if ($cantidadPasajerosV !== 0){
                                foreach ($arrayPasajerosV as $datosPasajerosV) {
                                    echo "******************************************** \n";
                                    echo $datosPasajerosV . "\n";
                                    echo "******************************************** \n";
                                }
                            } 
                            else {
                            echo "No hay ningún pasajero creado en este viaje... \n";
                            }
                        } 
                        else{
                            break;
                        }
                break;
                case 3: //MODIFICAR un viaje
                    $objViajePrueba= new Viaje();
                    $arrayPasajeros= $objViajePrueba->Listar();
                    foreach ($arrayPasajeros as $datosViajes) {
                        echo "******************************************** \n";
                        echo $datosViajes;
                        echo "******************************************** \n";
                    }
                    echo "Ingrese el ID del viaje que desea modificar: ";
                    $id= trim(fgets(STDIN));
                    $objResponsablePrueba= new ResponsableV();
                    $objEmpresaPrueba= new Empresa();
                    while (!$objViajePrueba->Buscar($id)) {
                        echo "No hay un viaje con ese ID, por favor intentelo con otro ID valido: ";
                        $id= trim(fgets(STDIN));
                    }
                    echo "******************************************** \n";
                    echo $objViajePrueba->__toString();
                    echo "******************************************** \n";
                    echo "Ingrese nuevamente el destino del viaje: ";
                    do{
                        $destinoV= strtoupper(trim(fgets(STDIN)));
                        $arrayViajes= $objViajePrueba->Listar("vdestino= '$destinoV'");
                        $numeroViajesDestino= count($arrayViajes);
                        if ($numeroViajesDestino > 0) {
                            echo "Ya hay un viaje creado hacia el mismo destino, ingrese otro: ";
                        }
                    } while ($numeroViajesDestino > 0);
                    $objViajePrueba->setDestino($destinoV);
                    echo "Ingrese nuevamente cantidad máxima de pasajeros del viaje: ";
                    $cantMaxPasajeros= trim(fgets(STDIN));
                    $objViajePrueba->setCantMaxPasajeros($cantMaxPasajeros);
                    echo "Ingrese nuevamente el ID de la empresa que organiza el viaje: ";
                    $idE= trim(fgets(STDIN));
                    while (!$objEmpresaPrueba->Buscar($idE)) {
                        echo "No hay una empresa con el ID ingresado, por favor intentelo con otro ID valido: ";
                        $idE= trim(fgets(STDIN));
                    }
                    $objViajePrueba->setObjEmpresa($objEmpresaPrueba);
                    echo "Ingrese nuevamente el N° de empleado del responsable a cargo: ";
                    $numEmpleado= trim(fgets(STDIN));
                    while (!$objResponsablePrueba->Buscar($numEmpleado)) {
                        echo "No hay responsable con ese N° de empleado, por favor intentelo con otro numero valido: ";
                        $numEmpleado= trim(fgets(STDIN));
                    }
                    $objViajePrueba->setObjResponsable($objResponsablePrueba);
                    echo "Ingrese nuevamente el importe del viaje: ";
                    $importe= trim(fgets(STDIN));
                    $objViajePrueba->setImporte($importe);
                    echo "Ingrese nuevamente el tipo de asiento del viaje PC(Primera clase)/CE(Clase estandar): ";
                    $tipoAsiento= strtoupper(trim(fgets(STDIN)));
                    $tipoDeAsiento= PrimeraOEstandar($tipoAsiento);
                    $objViajePrueba->setTipoAsiento($tipoDeAsiento);
                    echo "Ingrese nuevamente si/no dependiendo si el viaje es ida y vuelta: ";
                    $idaVuelta= strtoupper(trim(fgets(STDIN)));
                    $idaYVuelta= verificadorSiNo($idaVuelta);
                    $objViajePrueba->setIdayvuelta($idaYVuelta);
                        if ($objViajePrueba->modificar()) {
                            echo "El viaje se ha modificado con exito... \n";
                        } else {
                            echo "Ocurrió algún error al modificar el viaje... \n";
                        }
                break;
                case 4:
                    echo "Ingrese el ID del viaje que desea buscar: ";
                    $id= trim(fgets(STDIN));
                    $objViajePrueba= new Viaje();
                    if ($objViajePrueba->Buscar($id)) {
                        echo "Se encontró el viaje con el ID " . $id . "\n . Los datos registrados en el viaje son: \n";
                        echo "******************************************** \n";
                        echo $objViajePrueba->__toString();
                        echo "******************************************** \n";
                    } else {
                        echo "No se encontró un viaje con el ID indicado... \n";
                    }
                break;
                case 5://LISTAR viajes
                    echo "¿Desea listar con algúna condición en específico? si/no: ";
                    $respuesta= strtoupper(trim(fgets(STDIN)));
                    $laRespuesta= verificadorSiNo($respuesta);
                    $objViajePrueba= new Viaje();
                    if ($laRespuesta == "NO") {
                        $arrayViajes= $objViajePrueba->listar();
                        $datosViajes="";
                        $cantidadViajes= count($arrayViajes);
                        if ($cantidadViajes !== 0) {
                            foreach ($arrayViajes as $datosViajes) {
                                echo "******************************************** \n";
                                echo $datosViajes;
                                echo "******************************************** \n";
                            }
                        } 
                        else {
                            echo "No hay ningún viaje creado... \n";
                        }
                    } else {
                        echo "Escriba la condición de listado en formato SQL, el WHERE ya está incluido: ";
                        $condicion= strtoupper(trim(fgets(STDIN)));
                        $arrayViajes= $objViajePrueba->listar($condicion);
                        $datosViajes="";
                        $cantidadViajes= count($arrayViajes);
                        if ($cantidadViajes !== 0) {
                            foreach ($arrayViajes as $datosViajes) {
                                echo "******************************************** \n";
                                echo $datosViajes;
                                echo "******************************************** \n";
                            }
                        } else {
                            echo "No hay ningún viaje creado a " . $destinoV . "... \n";
                        }
                    }
                break;
                case 6: //BORRAR un viaje
                    echo "Ingrese el ID del viaje que desea borrar: ";
                    $id= trim(fgets(STDIN));
                    $objViajePrueba= new Viaje();
                    if ($objViajePrueba->buscar($id)) {
                        echo "******************************************** \n";
                        echo $objViajePrueba->__toString();
                        echo "******************************************** \n";
                        echo "¿Este es el viaje que usted desea eliminar? si/no: ";
                        $respuesta= strtoupper(trim(fgets(STDIN)));
                        $laRespuesta= verificadorSiNo($respuesta);
                        if ($laRespuesta == "NO"){
                            echo "Usted ha decidido no borrar este viaje... \n";
                        }
                        else{
                            $objViajePrueba->obtenerPasajeros();
                            $cantidadPasajerosDentro= count($objViajePrueba->getColeccionPasajeros());
                            if ($cantidadPasajerosDentro == 0) {
                                if ($objViajePrueba->eliminar()) {
                                    echo "La empresa se ha eliminado con exito... \n";
                                } else {
                                    echo "No se logró eliminar el viaje... \n";
                                }
                            } else {
                                echo "Este viaje cuenta con pasajeros dentro, no puede ser borrada... \n";
                            }
                        }
                    } else {
                        echo "No se encontró una empresa con el ID indicado... \n";
                    }    
                break;
                case 7:
                break;
            }
        } while (($opcionViajes <= 6) && ($opcionViajes >= 1));  
        break;
    }    
} while (($opcionMenu <= 4) && ($opcionMenu >= 1));