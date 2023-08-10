<?php
//Este archivo PHP se encarga de cargar la tabla comunas.
include '../includes/conexion.php'; //Conexión a base de datos local.

$nuevaRegionId = $_POST["nuevaRegionId"]; //Se recibe la variable ID de region.
$sqlNombresComunas = "SELECT id, nombre FROM comunas WHERE region_id = $nuevaRegionId"; //Sentencia SQL que descarta todas las comunas que no contentemplen la ID de la region.
$resultadoComunas = $conn->query($sqlNombresComunas);

$nombresComunas = array(); //Se crea un array para almacenar todas las comunas.
if ($resultadoComunas->num_rows > 0) { //Verificar si la tabla no está vacía.
    while ($row = $resultadoComunas->fetch_assoc()) { //Recorrer el resultado de la query y almacenarlos en el array con formato especificado (id y nombre).
        $comuna = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"]
        );
        $comunas[] = $comuna;
    }
    echo json_encode($comunas); //Se manda el array en formato JSON.
}

$conn->close();
?>