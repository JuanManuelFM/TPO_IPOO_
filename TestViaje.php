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
        echo"3) :--------Sobre los pasajeros---------: \n";
        echo"4) :----------Sobre los viajes----------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcion;
}

function menuCategoriasEmpresa(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :--------Agregar una empresa---------: \n";
        echo"2) :-------Modificar una empresa--------: \n";
        echo"3) :---------Buscar una empresa---------: \n";
        echo"4) :--------Listar una empresa----------: \n";
        echo"5) :--------Eliminar una empresa--------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcion;
}

function menuCategoriasResponsable(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :-------Agregar un responsable-------: \n";
        echo"2) :------Modificar un responsable------: \n";
        echo"3) :-------Buscar un responsable--------: \n";
        echo"4) :-------Listar un responsable--------: \n";
        echo"5) :------Eliminar un responsable-------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max)
    return $opcion;
}

function menuCategoriasPasajero(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :--------Agregar un pasajero---------: \n";
        echo"2) :-------Modificar un pasajero--------: \n";
        echo"3) :--------Buscar un pasajero----------: \n";
        echo"4) :--------Listar un pasajero----------: \n";
        echo"5) :-------Eliminar un pasajero---------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcion;
}

function menuCategoriasViaje(){
    $minimo = 1;
    $maximo = 5;
        echo"1) :----------Agregar un viaje----------: \n";
        echo"2) :---------Modificar un viaje---------: \n";
        echo"3) :----------Buscar un viaje-----------: \n";
        echo"4) :----------Listar un viaje-----------: \n";
        echo"5) :---------Eliminar un viaje----------: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcion;
}

//Función que verifica que el usuario responda correctamente a las confirmaciones SI o NO.
function verificadorSiNo($unaRespuesta){
    while ($unaRespuesta !== "SI" && $unaRespuesta !== "NO") {
        echo "Su respuesta solo puede ser un SI o NO. Por favor, vuelva a ingresar su respuesta: ";
        $unaRespuesta = strtoupper(trim(fgets(STDIN)));
    }
    return $unaRespuesta;
}

do{
    $opcionMenu = menuInicio();
    switch ($opcionMenu){
        case 1: 
            //Menu EMPRESAS
            $OpcionEmpresa= menuCategoriasEmpresa();
            switch ($OpcionEmpresa){
                case 1: //AGREGAR una empresa
                    $objNuevaEmpresa= new Empresa();
                    //CHEQUEAR QUE PASA CON EL ID
                    echo "Ingrese el nombre de la empresa: ";
                    $nombre= strtoupper(trim(fgets(STDIN)));
                    echo "Ingrese la dirección de la empresa: ";
                    $direccion= strtoupper(trim(fgets(STDIN)));
                    $objNuevaEmpresa->cargar("", $nombre, $direccion);
                    if($objNuevaEmpresa->insertar()){
                        echo "La empresa se ha agregado con exito \n";
                    }
                    else{
                        echo "Ocurrió algún error al agregar la empresa :(";
                    }                        
                break;
                case 2: //MODIFICAR una empresa
                    echo "Ingrese el ID de la empresa que deséa modificar: ";
                    $id= strtoupper(trim(fgets(STDIN)));
                    $objEmpresa= new Empresa();
                    if($objEmpresa->Buscar($id)){
                        echo "************************** \n";
                        echo $objEmpresa->__toString();
                        echo "************************** \n";
                        echo "Ingrese nuevamente el nombre de la empresa";
                        $nombreE= strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese nuevamente la dirección de la empresa";
                        $direccionE= strtoupper(trim(fgets(STDIN)));
                        //$objEmpresa->cargar($id, $nombreE, $direccionE);
                        $objEmpresa->setNombreEmpresa($nombreE);
                        $objEmpresa->setDireccionEmpresa($direccionE);
                            if($objEmpresa->modificar()){
                                echo "La empresa se ha modificado con exito \n";
                            }
                            else{
                            echo "Ocurrió algún error al modificar la empresa :(";
                            }   
                    }
                    else{
                        echo "No se encontró una empresa con el ID indicado...";
                    }
                break;
                case 3: //BUSCAR una empresa
                    echo "Ingrese el ID de la empresa que desea buscar: ";
                    $id= strtoupper(trim(fgets(STDIN)));
                    $objEmpresa= new Empresa();
                    if($objEmpresa->Buscar($id)){
                        echo "Se encontró la empresa del ID " . $id . ". Los datos registrados de la empresa son: \n";
                        echo "************************** \n";
                        echo $objEmpresa->__toString();
                        echo "************************** \n";
                    }
                    else{
                        echo "No se encontró una empresa con el ID indicado...";
                    }
                break;
                case 4: //LISTAR empresas
                    echo "¿Desea listar con algúna condición en específico? si/no";
                    $respuesta= strtoupper(trim(fgets(STDIN)));
                    $laRespuesta= verificadorSiNo($respuesta);
                    $objEmpresa= new Empresa();
                    if($laRespuesta == "NO"){
                        $arrayEmpresas= $objEmpresa->listar();
                        $datosEmpresas="";
                        foreach($arrayEmpresas as $datosEmpresas){
                            $datosEmpresas= $datosEmpresas . "\n" . $datosEmpresas . "\n";
                        }
                        echo $datosEmpresas;
                        echo "****************************************** \n";
                    }
                    else{
                        echo "Escriba la condición de listado en formato SQL, el WHERE ya está incluido: ";
                        $condicion= strtoupper(trim(fgets(STDIN)));
                        $arrayEmpresas= $objEmpresa->listar($condicion);
                        $datosEmpresas="";
                        foreach($arrayEmpresas as $datosEmpresas){
                            $datosEmpresas= $datosEmpresas . "\n" . $datosEmpresas . "\n";
                        }
                        echo $datosEmpresas;
                        echo "****************************************** \n";
                    }
                    break;
                    case 5: //ELIMINAR una empresa
                        echo "Ingrese el ID de la empresa que desea borrar: ";
                        $id= strtoupper(trim(fgets(STDIN)));
                        $objEmpresa= new Empresa();
                        if($objEmpresa->buscar($id)){
                            echo "************************** \n";
                            echo $objEmpresa->__toString();
                            echo "************************** \n";
                            echo "¿Esta es la empresa que usted desea eliminar? si/no";
                            $respuesta= strtoupper(trim(fgets(STDIN)));
                            $laRespuesta= verificadorSiNo($respuesta);
                            if($laRespuesta == "NO"){
                                echo "Usted ha decidido no borrar esta empresa...";
                            }
                            else{
                                $objEmpresa->eliminar();
                                echo "La empresa se ha eliminado con exito...";
                            }
                        }
                        else{
                            echo "No se encontró una empresa con el ID indicado...";
                        }
            }while (($OpcionEmpresa <= 5) && ($OpcionEmpresa >= 1));
        break;
        case 2: 
            //Menu RESPONSABLE
            $OpcionResponsable= menuCategoriasResponsable();
            switch ($OpcionResponsable){
                case 1: //AGREGAR un responsable
                    $objNuevaEmpresa= new Empresa();
                    //CHEQUEAR QUE PASA CON EL ID
                    echo "Ingrese el nombre de la empresa: ";
                    $nombre= strtoupper(trim(fgets(STDIN)));
                    echo "Ingrese la dirección de la empresa: ";
                    $direccion= strtoupper(trim(fgets(STDIN)));
                    $objNuevaEmpresa->cargar("", $nombre, $direccion);
                    if($objNuevaEmpresa->insertar()){
                        echo "La empresa se ha agregado con exito \n";
                    }
                    else{
                        echo "Ocurrió algún error al agregar la empresa :(";
                    }                        
                break;
                case 2: //MODIFICAR una empresa
                    echo "Ingrese el ID de la empresa que deséa modificar: ";
                    $id= strtoupper(trim(fgets(STDIN)));
                    $objEmpresa= new Empresa();
                    if($objEmpresa->Buscar($id)){
                        echo "************************** \n";
                        echo $objEmpresa->__toString();
                        echo "************************** \n";
                        echo "Ingrese nuevamente el nombre de la empresa";
                        $nombreE= strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese nuevamente la dirección de la empresa";
                        $direccionE= strtoupper(trim(fgets(STDIN)));
                        //$objEmpresa->cargar($id, $nombreE, $direccionE);
                        $objEmpresa->setNombreEmpresa($nombreE);
                        $objEmpresa->setDireccionEmpresa($direccionE);
                            if($objEmpresa->modificar()){
                                echo "La empresa se ha modificado con exito \n";
                            }
                            else{
                            echo "Ocurrió algún error al modificar la empresa :(";
                            }   
                    }
                    else{
                        echo "No se encontró una empresa con el ID indicado...";
                    }
                break;
                case 3: //BUSCAR una empresa
                    echo "Ingrese el ID de la empresa que desea buscar: ";
                    $id= strtoupper(trim(fgets(STDIN)));
                    $objEmpresa= new Empresa();
                    if($objEmpresa->Buscar($id)){
                        echo "Se encontró la empresa del ID " . $id . ". Los datos registrados de la empresa son: \n";
                        echo "************************** \n";
                        echo $objEmpresa->__toString();
                        echo "************************** \n";
                    }
                    else{
                        echo "No se encontró una empresa con el ID indicado...";
                    }
                break;
                case 4: //LISTAR empresas
                    echo "¿Desea listar con algúna condición en específico? si/no";
                    $respuesta= strtoupper(trim(fgets(STDIN)));
                    $laRespuesta= verificadorSiNo($respuesta);
                    $objEmpresa= new Empresa();
                    if($laRespuesta == "NO"){
                        $arrayEmpresas= $objEmpresa->listar();
                        $datosEmpresas="";
                        foreach($arrayEmpresas as $datosEmpresas){
                            $datosEmpresas= $datosEmpresas . "\n" . $datosEmpresas . "\n";
                        }
                        echo $datosEmpresas;
                        echo "****************************************** \n";
                    }
                    else{
                        echo "Escriba la condición de listado en formato SQL, el WHERE ya está incluido: ";
                        $condicion= strtoupper(trim(fgets(STDIN)));
                        $arrayEmpresas= $objEmpresa->listar($condicion);
                        $datosEmpresas="";
                        foreach($arrayEmpresas as $datosEmpresas){
                            $datosEmpresas= $datosEmpresas . "\n" . $datosEmpresas . "\n";
                        }
                        echo $datosEmpresas;
                        echo "****************************************** \n";
                    }
                    break;
                    case 5: //ELIMINAR una empresa
                        echo "Ingrese el ID de la empresa que desea borrar: ";
                        $id= strtoupper(trim(fgets(STDIN)));
                        $objEmpresa= new Empresa();
                        if($objEmpresa->buscar($id)){
                            echo "************************** \n";
                            echo $objEmpresa->__toString();
                            echo "************************** \n";
                            echo "¿Esta es la empresa que usted desea eliminar? si/no";
                            $respuesta= strtoupper(trim(fgets(STDIN)));
                            $laRespuesta= verificadorSiNo($respuesta);
                            if($laRespuesta == "NO"){
                                echo "Usted ha decidido no borrar esta empresa...";
                            }
                            else{
                                $objEmpresa->eliminar();
                                echo "La empresa se ha eliminado con exito...";
                            }
                        }
                        else{
                            echo "No se encontró una empresa con el ID indicado...";
                        }
            }while (($OpcionEmpresa <= 5) && ($OpcionEmpresa >= 1));
        break;
        case 3: 
            
        break;
        case 4: 
            
        break;
    }
} while (($opcionMenu <= 4) && ($opcionMenu >= 1));