

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imagen_id = $_POST['imagen_id'];

    // Verificar si ya existe un like para esa imagen
    $query = "SELECT * FROM likes WHERE imagen_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $imagen_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si ya existe, podemos ignorar o actualizar según sea necesario
        echo "Ya le has dado like a esta imagen.";
    } else {
        // Insertar nuevo like
        $stmt = $conn->prepare("INSERT INTO likes (imagen_id) VALUES (?)");
        $stmt->bind_param('i', $imagen_id);
        if ($stmt->execute()) {
            echo "Like registrado exitosamente.";
        } else {
            echo "Error al registrar el like: " . $conn->error;
        }
    }

    $stmt->close();
    header('Location: index.php');  // Volver a la galería
    exit();
}

$conn->close();
?>
