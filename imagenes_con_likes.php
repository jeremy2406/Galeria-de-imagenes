

<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    include 'conexion.php';
   ?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="deco.css">
    <title>Categorías</title>
</head>

<body style="background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);">
<div>
      
        <header>
            <div class="px-4 mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <div class="flex-shrink-0">
                        <a href="Index.php" class="flex">
                            <img class="w-auto h-12" src="uploads/_ea2fdc50-b705-493b-8677-abd035e03523-removebg-preview.png" alt="Logo" />
                        </a>
                    </div>

                    <button id="menu-button" type="button"
                        class="inline-flex p-2 text-white transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">
                        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16">
                            </path>
                        </svg>

                        <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <div id="mobile-menu" class="hidden lg:flex lg:items-center lg:justify-center lg:space-x-10">
                    <a href="index.php" class="text-base text-black hover:text-opacity-80">
                            Inicio
                        </a>
                        <a href="Categorias.php" class="text-base text-black hover:text-opacity-80">
                            Categorías
                        </a>
                        <a href="imagenes_con_likes.php" class="text-base text-black hover:text-opacity-80">
                           Likes
                        </a>
                    </div>

                    <a href="agregar-imagen.php"
                        class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base hover:bg-yellow-300 hover:text-black focus:text-black focus:bg-yellow-300 font-semibold text-white bg-black rounded-full"
                        role="button">
                        Subir
                    </a>
                </div>
            </div>

        
        <!-- Menú móvil -->
        <div id="mobile-menu-container" class="hidden lg:hidden items-center justify-center">
            <div class="flex flex-col items-center space-y-4 py-4">
            <a href="index.php" class="text-base text-white hover:text-opacity-80">
                   Inicio
                </a>
                <a href="Categorias.php" class="text-base text-white hover:text-opacity-80">
                    Categorías
                </a>
                <a href="imagenes_con_likes.php" class="text-base text-white hover:text-opacity-80">
                   Likes
                </a>
                <a href="agregar-imagen.php"
                    class="inline-flex items-center justify-center px-5 py-2.5 text-base hover:bg-yellow-300 hover:text-black focus:text-black focus:bg-yellow-300 font-semibold text-white bg-black rounded-full"
                    role="button">
                    Subir
                </a>
            </div>
        </div>


        </header>
    </div>
    <section class="py-10 sm:py-16 lg:py-24">
<?php
// Obtener las imágenes que tienen "likes"
$query = "SELECT i.nombre, i.ruta, i.ID FROM imagenes i JOIN likes l ON i.ID = l.imagen_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<div class="grid grid-cols-3 gap-4">';
    while ($row = $result->fetch_assoc()) { 
        $imagenRuta = $row['ruta']; // Ruta de la imagen
        $imagenID = $row['ID']; // ID de la imagen

        ?>
  <div class="grid-item w-full max-w-lg mx-auto mb-6 rounded-lg shadow-lg overflow-hidden group relative" style="width: 90%;">
    <img src="data:image/jpeg;base64,<?php echo $imagenRuta; ?>" alt="Imagen" class="w-full h-64 object-cover">

    <!-- Botón de descarga -->
    <a href="descargar.php?ID=<?php echo $imagenID; ?>">
        <button id="download-btn" class="absolute bottom-4 right-4 bg-white rounded-full p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <svg class="w-5 h-5 text-gray-800 dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4" />
            </svg>
        </button>
    </a>
</div>





        <?php
    }
    echo '</div>';
   
} else {
    echo 'No has dado like a ninguna imagen.';
}

$conn->close();

?>
</section>
<?php
include 'Componentes/Footer.php';
?>
