
<?php
$servername = "localhost";
$username = "root";  // Usuario por defecto de XAMPP
$password = "";  // XAMPP no tiene contraseña por defecto
$dbname = "galeria_imagenes";  // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
//echo "Conexión exitosa";

?>
