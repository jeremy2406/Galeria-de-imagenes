

<footer class="bg-white dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="index.php" class="flex items-center">
                  <img src="uploads/_ea2fdc50-b705-493b-8677-abd035e03523-removebg-preview.png" class="h-12 me-6" alt=" Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">InstaStock</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Menu</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="index.php" class="hover:underline">Inicio</a>
                      </li>
                      <li>
                          <a href="Categorias.php" class="hover:underline">Categorías</a>
                      </li>
                      <li>
                          <a href="imagenes_con_likes.php.php" class="hover:underline">Like</a>
                      </li>
                      <li>
                          <a href="agregar-imagen.php" class="hover:underline">Subir</a>
                      </li>
                  </ul>
              </div>
              
             
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="index.php" class="hover:underline">InstaStock™</a>.Todos los derechos reservados.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
             
            
           
              <a href="https://github.com/jeremy2406" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                  </svg>
                  <span class="sr-only">GitHub account</span>
              </a>
             
          </div>
      </div>
    </div>
</footer>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () { 
    var gallery = document.querySelector('#gallery');

    // Usamos imagesLoaded para asegurarnos de que todas las imágenes estén completamente cargadas
    imagesLoaded(gallery, function () {
        // Inicializamos Masonry después de que las imágenes estén cargadas
        var msnry = new Masonry(gallery, {
            itemSelector: '.grid-item',  // Seleccionamos los ítems de la galería
            columnWidth: '.grid-item',    // Define el ancho de las columnas usando el mismo item
            gutter: 20,                   // Espacio entre las imágenes
            percentPosition: true         // Ajuste basado en porcentajes
        });
    });
});
const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu-container');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
            mobileMenu.classList.toggle('animate-slide-down');
        });
</script>

<script src="index.js">
</script>
 




</body>

</html>