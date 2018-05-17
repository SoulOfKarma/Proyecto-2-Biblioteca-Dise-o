<?php
$conn = new mysqli("127.0.0.1", "prueba", "123456", "prueba", 3306);
if ($conn->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

echo "Conexión Exitosa a BD pruebadb ".$conn->host_info . "\n";
echo "<br />";
?>