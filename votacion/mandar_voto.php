<?php
//Este archivo PHP se encarga de ejecutar la funcionalidad y las validaciones del formulario.
include '../data/includes/conexion.php'; //Conexión a base de datos local.

$nombreApellido = $_POST["nombreApellido"];
$alias = $_POST["alias"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$region = $_POST["region"];
$comuna = $_POST["comuna"];
$candidato = $_POST["candidato"];
$web = $_POST["web"];
$tv = $_POST["tv"];
$redesSociales = $_POST["redesSociales"];
$amigo = $_POST["amigo"];

function validarFormatoEmail($email) { //Método para validar correo electrónico.
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarRut($rut) { //Método para validar el rut con formato Chileno.
    $rut = preg_replace('/[^k0-9]/i', '', $rut); //Se eliminan caracteres invalidos.
    $dv  = substr($rut, -1); //dv Es el último dígito verificador.
    $numero = substr($rut, 0, strlen($rut) - 1); //Esta variable es el número del rut.
    $suma = 0;
    $factor = 2;
    
    //Aquí se calcula el digito verificador.
    for ($i = strlen($numero) - 1; $i >= 0; $i--) {
        $suma += $factor * $numero[$i];
        $factor = $factor == 7 ? 2 : $factor + 1;
    }
    $dvEsperado = 11 - ($suma % 11);
    //Si el digito verificador esperado es 11 se cambia a 0.
    if ($dvEsperado == 11) {
        $dvEsperado = 0;
    } elseif ($dvEsperado == 10) {//Si el digito verificador esperado es 10, se cambia por k.
        $dvEsperado = 'k';
    }

    return strtoupper($dv) == strtoupper($dvEsperado);
}

//Se eliminan los puntos y guiones del rut.
$rut = preg_replace('/[.-]/', '', $rut);


//Bloque de verificaciónes.
if (empty($region) || empty($comuna) || empty($candidato)) { //Verificar los campos tipo <select>.
    echo "Los campos Región, Comuna y Candidato son obligatorios.";
} else {
    if (empty($nombreApellido)) { //Verificar Que el campo nombre y apellido esté siendo rellenado.
        echo "El campo Nombre y Apellido es obligatorio.";
    } else {
        if (strlen($alias) <= 5 || !preg_match('/[A-Za-z]/', $alias) || !preg_match('/[0-9]/', $alias)) { //Comprobar si el alias tiene más de 6 caracteres y tenga números.
            echo "El campo Alias debe tener al menos 6 caracteres y contener letras y números.";
        } else {
            if (strlen($rut) < 7 || strlen($rut) > 10 || !validarRut($rut)) { //Verificar la longitud del rut.
                echo "El RUT ingresado no es válido.";
            } else {//Aquí se verifica si el rut ya está en la tabla 'votantes'.
                $sqlVerificarRut = "SELECT id FROM votantes WHERE rut = '$rut'"; 
                $resultadoVerificarRut = $conn->query($sqlVerificarRut);
                
                if ($resultadoVerificarRut->num_rows > 0) {
                    echo "El RUT ya ha votado.";
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Se verifica el correo.
                        echo "El formato del correo electrónico no es válido.";
                    } else {
                        $numCheckboxesMarcados = $web + $tv + $redesSociales + $amigo;
                        if ($numCheckboxesMarcados < 2) { //Se verifica que al menos dos combobox están marcados.
                            echo "Debe marcar al menos 2 casillas de cómo nos encontró.";
                        } else {//Query y consulta.
                            $sql = "INSERT INTO votantes (nombre_apellido, alias, rut, email, region_id, comuna_id, candidato, web, tv, redes_sociales, amigo) VALUES ('$nombreApellido', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$web', '$tv', '$redesSociales', '$amigo')";

                            if ($conn->query($sql) === TRUE) {
                                echo "¡Voto registrado con éxito!";
                            } else {
                                echo "Error al registrar el voto: " . $conn->error;
                            }
                        }
                    }
                }
            }
        }
    }
}

$conn->close();
?>