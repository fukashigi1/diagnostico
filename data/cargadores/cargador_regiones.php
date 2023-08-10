<?php
//Este archivo PHP se encarga de cargar la tabla regiones.
include '../includes/conexion.php'; //Conexión a base de datos local.

$sqlNombresRegiones = "SELECT * from regiones"; //Sentencia SQL que descarta todas las comunas que no contentemplen la ID de la region.
$resultadoRegiones = $conn->query($sqlNombresRegiones);
$nombresRegiones = array(); // Lista para almacenar los nombres
if ($resultadoRegiones->num_rows > 0) { //Verificar si la tabla no está vacía.
    while ($row = $resultadoRegiones->fetch_assoc()) { //Recorrer el resultado de la query y almacenarlos en el array con formato especificado (id y nombre).
        $region = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"]
        );
        $regiones[] = $region;
    }
    echo json_encode($regiones); //Se manda el array en formato JSON.
}

$conn->close();
?>


