
<?php
include 'conexion.php';  // Incluir conexión a la base de datos

if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);  // Obtener el ID de la imagen

    // Preparar la consulta para obtener la imagen
    $stmt = $conn->prepare("SELECT nombre, ruta FROM imagenes WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreImagen = $row['nombre'];
        $rutaImagen = $row['ruta'];

        // Asegúrate de que la ruta de la imagen esté en base64
        $contenidoImagen = base64_decode($rutaImagen);
        
        // Verifica que la decodificación sea exitosa
        if ($contenidoImagen === false) {
            die("Error al decodificar la imagen.");
        }

        // Obtener la extensión de la imagen a partir del nombre
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);

        // Configurar las cabeceras para la descarga
        header('Content-Description: File Transfer');
        
        // Ajusta el Content-Type según la extensión
        if ($extension === 'png') {
            header('Content-Type: image/png');
        } elseif ($extension === 'gif') {
            header('Content-Type: image/gif');
        } else {
            header('Content-Type: image/jpeg');  // Predeterminado a JPEG
        }
        
        header('Content-Disposition: attachment; filename="' . basename($nombreImagen) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($contenidoImagen));

        // Salida del contenido de la imagen
        echo $contenidoImagen;
        exit();
    } else {
        echo "Imagen no encontrada.";
    }
} else {
    echo "ID no válido.";
}
?>

