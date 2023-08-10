<?php
//Este archivo PHP se encarga de cargar la tabla candidatos.
include '../includes/conexion.php'; //Conexión a base de datos local.

$nuevaComunaId = $_POST["nuevaComunaId"]; //Se recibe la variable ID de comuna.
$sqlNombresCandidatos = "SELECT id, nombre FROM candidatos WHERE comuna_id = $nuevaComunaId"; //Sentencia SQL que descarta todos los candidatos que no contentemplen la ID de la comuna.
$resultadoCandidatos = $conn->query($sqlNombresCandidatos);

$candidatos = array(); //Se crea un array para almacenar todos los candidatos.

if ($resultadoCandidatos->num_rows > 0) { //Verificar si la tabla no está vacía.
    while ($row = $resultadoCandidatos->fetch_assoc()) { //Recorrer el resultado de la query y almacenarlos en el array con formato especificado (id y nombre).
        $candidato = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"]
        );
        $candidatos[] = $candidato;
    }
    echo json_encode($candidatos); //Se manda el array en formato JSON.
}

$conn->close();
?>