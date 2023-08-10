<?php
//Este archivo PHP se encarga de establecer la conexión con la base de datos.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>