
<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imagenID = $_POST['imagen_id'];
    $nombre = $_POST['nombre'];
    $comentario = $_POST['comentario'];

    // Guardar comentario en la base de datos
    $query = "INSERT INTO comentarios (imagen_id, nombre_usuario, comentario) VALUES ('$imagenID', '$nombre', '$comentario')";
    if ($conn->query($query)) {
        echo "Comentario guardado exitosamente.";
    } else {
        echo "Error: " . $conn->error;
    }
    header('Location: index.php');
}
?>
