<!DOCTYPE html>
<html lang="en">
<?php
include 'conexion.php';
$imagenID = $_GET['imagen_id'];

// Consultar los detalles de la imagen
$query = "SELECT nombre, ruta FROM imagenes WHERE ID = $imagenID";
$result = $conn->query($query);
$imagen = mysqli_fetch_assoc($result);
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="deco.css">
    <title>Comentarios</title>
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
    <section class="py-10 bg-gray-900 sm:py-16 lg:py-24">
    <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 lg:gap-x-20 gap-y-10">
            <!-- Imagen seleccionada -->
            <div class="flex items-center justify-center mb-4 lg:mb-0 lg:order-1">
                <img src="data:image/jpeg;base64,<?php echo $imagen['ruta']; ?>" alt="Imagen seleccionada" class="max-w-sm rounded-lg shadow-lg">
            </div>

            <!-- Formulario de comentarios -->
            <div class="lg:order-2">
                <div class="overflow-hidden bg-white rounded-md">
                    <div class="p-6 sm:p-10">
                        <h3 class="text-3xl font-semibold text-black">Deja tu comentario</h3>
                        <form action="guardar_comentario.php" method="POST">
                            <input type="hidden" name="imagen_id" value="<?php echo $imagenID; ?>">
                            <div class="space-y-6">
                                <div>
                                    <label for="nombre" class="text-base font-medium text-gray-900">Nombre</label>
                                    <div class="mt-2.5">
                                        <input type="text" name="nombre" id="nombre" placeholder="Tu nombre"
                                            class="block w-full px-4 py-4 text-black bg-white border border-gray-200 rounded-md">
                                    </div>
                                </div>

                                <div>
                                    <label for="comentario" class="text-base font-medium text-gray-900">Comentario</label>
                                    <div class="mt-2.5">
                                        <textarea name="comentario" id="comentario" placeholder="Escribe tu comentario"
                                            class="block w-full px-4 py-4 text-black bg-white border border-gray-200 rounded-md"></textarea>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full px-4 py-4 text-white bg-orange-500 rounded-md">Enviar comentario</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección para mostrar comentarios -->
        <div class="mt-12 bg-gray-800 p-6 sm:p-10 rounded-md">
            <h3 class="text-2xl font-semibold text-white">Comentarios anteriores</h3>
            <?php
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "galeria_imagenes");

            // Consulta para obtener los comentarios asociados a la imagen actual
            $resultado = mysqli_query($conexion, "SELECT * FROM comentarios WHERE imagen_id = $imagenID");

            // Bucle para mostrar los comentarios
            while ($comentario = mysqli_fetch_object($resultado)) {
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