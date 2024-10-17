<!DOCTYPE html>
<html lang="en">
<?php
include 'conexion.php';



// Consulta para obtener las imágenes que tienen comentarios
$imagenID = $_GET['id'];

// Consulta para obtener los detalles de la imagen
$queryImagen = "SELECT * FROM imagenes WHERE id = $imagenID";
$resultadoImagen = mysqli_query($conn, $queryImagen);
$imagen = mysqli_fetch_object($resultadoImagen);

// Consulta para obtener los comentarios de la imagen
$queryComentarios = "SELECT * FROM comentarios WHERE imagen_id = $imagenID";
$resultadoComentarios = mysqli_query($conn, $queryComentarios);
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="deco.css">
    <title>Detalles</title>
</head>

<body style="background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);">
    <div>

        <header>
            <div class="px-4 mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <div class="flex-shrink-0">
                        <a href="Index.php" class="flex">
                            <img class="w-auto h-12"
                                src="uploads/_ea2fdc50-b705-493b-8677-abd035e03523-removebg-preview.png" alt="Logo" />
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
        <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
            <!-- Mostrar imagen seleccionada -->
            <div class="flex items-center justify-center mb-8">
                <img src="data:image/jpeg;base64,<?php echo $imagen->ruta; ?>" alt="Imagen seleccionada" class="max-w-sm rounded-lg shadow-lg">
            </div>

            <!-- Mostrar comentarios -->
            <h3 class="text-2xl font-semibold">Comentarios</h3>
            <div class="mt-6 bg-gray-800 p-6 sm:p-10 rounded-md">
                <?php
                // Mostrar cada comentario
                while ($comentario = mysqli_fetch_object($resultadoComentarios)) {
                ?>
                    <div class="flex items-center mt-8">
                        <div class="ml-4">
                            <p class="text-base font-semibold text-white"><?php echo $comentario->nombre_usuario; ?></p>
                            <p class="mt-px text-sm text-gray-400"><?php echo $comentario->fecha; ?></p>
                        </div>
                    </div>
                    <blockquote class="mt-6">
                        <p class="text-lg leading-relaxed text-white"><?php echo $comentario->comentario; ?></p>
                    </blockquote>
                    <hr class="my-4 border-gray-600">
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
include 'Componentes/Footer.php';
?>