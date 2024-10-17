
<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria_id = $_POST['categoria'];
    $file = $_FILES['imagen'];

    if ($file['error'] == 0 && !empty($categoria_id) && !empty($file['name'])) {
        $imagenContenido = file_get_contents($file['tmp_name']);
        $imagenBase64 = base64_encode($imagenContenido);
    
        if ($imagenBase64 === false) {
            echo "Error al codificar la imagen.";
        }
        
        // Guardar en la base de datos
        $stmt = $conn->prepare("INSERT INTO imagenes (nombre, ruta, id_categoria) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $file['name'], $imagenBase64, $categoria_id);
        
        if ($stmt->execute()) {
            echo "Imagen subida exitosamente.";
        } else {
            echo "Error al subir la imagen: " . $conn->error;
        }
    
        $stmt->close();
<<<<<<< HEAD
        header('Location: agregar-imagen.php');
=======
        header('Location: index.php');
>>>>>>> e66e921653e605bb3a1b2cea49ae52259312f606
        exit();
    } else {
        echo "Error al subir la imagen o seleccionar la categoría.";
    }
    
}


$conn->close();
?>

