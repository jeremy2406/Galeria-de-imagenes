<?php
include 'conexion.php';
include 'Componentes/NavBar.php';
include 'Componentes/Busqueda.php';

// Obtener el valor de la búsqueda si existe
$categoria = isset($_GET['q']) ? $_GET['q'] : '';

// Modificar la consulta para filtrar por categoría si se ha ingresado una
if (!empty($categoria)) {
    $query = "SELECT imagenes.ID, imagenes.nombre, imagenes.ruta 
              FROM imagenes
              INNER JOIN categoria ON imagenes.id_categoria = categoria.ID
              WHERE categoria.nombre LIKE '%$categoria%'";
} else {
    $query = "SELECT ID, nombre, ruta FROM imagenes";
}

// Ejecutar la consulta para contar las imágenes
$result = $conn->query($query);
$Num_Categoria = mysqli_num_rows($result);

$Registros = 9;  // Número de imágenes por página
$Pagina = isset($_REQUEST['nume']) ? $_REQUEST['nume'] : 1;

if (is_numeric($Pagina)) {
    $inicio = ($Pagina - 1) * $Registros;
} else {
    $inicio = 0;
}

// Modificar la consulta para incluir la paginación
$query .= " LIMIT $inicio, $Registros";
$busqueda = $conn->query($query);  // Ejecutar la consulta con paginación
$paginas = ceil($Num_Categoria / $Registros);
?>

<!-- Cards imágenes -->
<section class="py-10 sm:py-16 lg:py-24">
    <!-- Título de la galería -->
    <h1 class="text-3xl sm:text-4xl lg:text-5xl text-center text-gray-800 font-bold mb-8">
        Fotos de stock gratuitas
    </h1>

    <!-- Mostrar número de resultados -->
    <h5 class="text-lg sm:text-xl lg:text-2xl text-center text-gray-600 font-semibold mb-6">
        Resultados: <?php echo $Num_Categoria; ?>
    </h5>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Contenedor de la galería -->
        <!-- Contenedor de la galería -->
<div class="my-gallery grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mx-auto" id="gallery">
    <!-- Definir el ancho de la columna -->
    <div class="grid-sizer" style="width: 33%;"></div> <!-- 3 columnas -->

    <?php
    // Mostrar las imágenes obtenidas con paginación
    if ($busqueda->num_rows > 0) {
        while ($Resultado = mysqli_fetch_assoc($busqueda)) {
            $imagenID = $Resultado['ID'];
            $imagenRuta = $Resultado['ruta'];
            ?>

            <div class="grid-item w-full max-w-sm mx-auto mb-6 rounded-lg shadow-lg overflow-hidden group">
            <a href="Comentar.php?imagen_id=<?php echo $imagenID; ?>">
    <img src="data:image/jpeg;base64,<?php echo $imagenRuta; ?>" alt="Imagen" class="w-full h-auto object-cover">
</a>

                <!-- Botón de Like -->
                <form action="like.php" method="POST">
                    <input type="hidden" name="imagen_id" value="<?php echo $imagenID; ?>">
                    <button type="submit"
                        class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-6 h-6 text-gray-400 hover:text-red-500 fill-current"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>
                </form>

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
                echo 'No se ha encontrado ninguna imagen en esta categoría.';
            }
            ?>
        </div>
    </div>
</section>





<!-- Paginación -->
<div class="mt-6 mb-10 flex justify-center">
    <nav aria-label="Page navigation example">
        <ul class="flex items-center -space-x-px h-8 text-sm">
            <li>
                <?php if ($Pagina > 1): ?>
                    <!-- Botón anterior con parámetro 'q' para mantener la búsqueda -->
                    <a href="index.php?nume=<?= $Pagina - 1; ?>&q=<?= urlencode($categoria); ?>"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                    </a>
                <?php endif; ?>
            </li>

            <!-- Números de página con 'q' -->
            <?php for ($i = 1; $i <= $paginas; $i++): ?>
                <li>
                    <a href="index.php?nume=<?= $i; ?>&q=<?= urlencode($categoria); ?>"
                        class="flex items-center justify-center px-3 h-8 leading-tight <?php if ($Pagina == $i): ?> text-blue-600 border border-blue-300 bg-blue-50 dark:border-gray-700 dark:bg-gray-700 dark:text-white <?php else: ?> text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php endif; ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <li>
                <?php if ($Pagina < $paginas): ?>
                    <!-- Botón siguiente con parámetro 'q' -->
                    <a href="index.php?nume=<?= $Pagina + 1; ?>&q=<?= urlencode($categoria); ?>"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</div>

</section>

<?php
include 'Componentes/Footer.php';
?>