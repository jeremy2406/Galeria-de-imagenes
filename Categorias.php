<?php
include 'conexion.php';


// Obtenemos las categorías
$queryCategorias = "SELECT * FROM categoria";
$resultCategorias = $conn->query($queryCategorias);

if (!empty($_REQUEST["nume"])) {
    $nume = $_REQUEST["nume"];
} else {
    $nume = "1";
}

$Registros = 6;  // Número de imágenes por página
$Pagina = isset($_REQUEST['nume']) ? $_REQUEST['nume'] : 1;

if (is_numeric($Pagina)) {
    $inicio = ($Pagina - 1) * $Registros;
} else {
    $inicio = 0;
}
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

<body  style="background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);">
<div >
      
        <header class=""
          >
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
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <?php
        // Iterar sobre cada categoría
        while ($categoria = mysqli_fetch_assoc($resultCategorias)) {
            $categoriaID = $categoria['ID'];
            $categoriaNombre = $categoria['Nombre'];

            // Consultar las imágenes de cada categoría con paginación
            $queryImagenes = "SELECT * FROM imagenes WHERE id_categoria = $categoriaID LIMIT $inicio, $Registros";
            $resultImagenes = $conn->query($queryImagenes);
            $totalImagenes = $conn->query("SELECT COUNT(*) as total FROM imagenes WHERE id_categoria = $categoriaID");
            $totalImagenesCount = mysqli_fetch_assoc($totalImagenes)['total'];
            $paginas = ceil($totalImagenesCount / $Registros);
            ?>

            <!-- Título de la categoría -->
            <h2 class="text-center text-2xl font-bold mb-6 mt-6"><?php echo $categoriaNombre; ?></h2>
            
            <!-- Contenedor de la galería -->
            <div class="my-gallery grid" id="gallery">
                <!-- Definir el ancho de la columna -->
                <div class="grid-sizer" style="width: 33%;"></div> <!-- 3 columnas -->

                <?php
                if (mysqli_num_rows($resultImagenes) > 0) {
                    while ($Resultado = mysqli_fetch_assoc($resultImagenes)) {
                        $imagenID = $Resultado['ID'];
                        $imagenRuta = $Resultado['ruta'];
                        ?>

                        <div class="grid-item w-full max-w-sm mx-auto mb-6 rounded-lg shadow-lg overflow-hidden group" style="width: 33%;">
                            <img src="data:image/jpeg;base64,<?php echo $imagenRuta; ?>" alt="Imagen"
                                 class="w-full h-auto object-cover">

                            <!-- Botón de Like -->
                            <button id="like-btn"
                                    class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-6 h-6 text-gray-400 hover:text-red-500 fill-current"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </button>

                            <!-- Botón de descarga -->
                            <a href="descargar.php?ID=<?php echo $imagenID; ?>">
                                <button id="download-btn"
                                        class="absolute bottom-2 right-2 bg-white rounded-full p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-black" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4" />
                                    </svg>
                                </button>
                            </a>
                        </div>

                        <?php
                    }
                } else {
                    echo '<p class="text-center">No se encontraron imágenes para esta categoría.</p>';
                }
                ?>
            </div>
          


            <!-- Paginación para cada categoría -->
            <div class="mt-6 mb-6 flex justify-center">
                <nav aria-label="Page navigation example">
                    <ul class="flex items-center -space-x-px h-8 text-sm">
                        <li>
                            <?php if ($Pagina > 1): ?>
                                <!-- Botón anterior -->
                                <a href="categorias.php?nume=<?= $Pagina - 1; ?>&categoriaID=<?= $categoriaID; ?>"
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 1 1 5l4 4" />
                                    </svg>
                                </a>
                            <?php else: ?>
                                <!-- Si estamos en la primera página, deshabilitar el botón -->
                                <span
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-300 bg-gray-200 border border-e-0 border-gray-300 rounded-s-lg cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 1 1 5l4 4" />
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </li>

                        <!-- Números de página -->
                        <?php for ($i = 1; $i <= $paginas; $i++): ?>
                            <li>
                                <a href="categorias.php?nume=<?= $i; ?>&categoriaID=<?= $categoriaID; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight <?php if ($Pagina == $i): ?> text-blue-600 border border-blue-300 bg-blue-50 dark:border-gray-700 dark:bg-gray-700 dark:text-white <?php else: ?> text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php endif; ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li>
                            <?php if ($Pagina < $paginas): ?>
                                <!-- Botón siguiente -->
                                <a href="categorias.php?nume=<?= $Pagina + 1; ?>&categoriaID=<?= $categoriaID; ?>"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>
                            <?php else: ?>
                                <!-- Si estamos en la última página, deshabilitar el botón -->
                                <span
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-gray-200 border border-gray-300 rounded-e-lg cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </li>
                    </ul>
                </nav>
            </div>

        <?php
        }
        ?>
    </div>
</section>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar todas las galerías
    const galleries = document.querySelectorAll('.my-gallery');

    galleries.forEach(gallery => {
        // Inicializar Masonry para cada galería
        const msnry = new Masonry(gallery, {
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
            
        });

        // Esperar a que las imágenes se carguen antes de aplicar Masonry
        imagesLoaded(gallery, function () {
            msnry.layout();
        });
    });
});


</script>
<?php
include 'Componentes/Footer.php';
?>