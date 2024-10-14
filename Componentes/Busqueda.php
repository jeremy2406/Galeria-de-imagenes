<!-- Barra de búsqueda unida al header -->
<section class="py-5 sm:py-10 lg:py-15">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col items-center py-12 sm:py-24">
            <div class="w-11/12 sm:w-2/3 lg:flex justify-center items-center flex-col mb-5 sm:mb-10">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl text-center text-white font-black leading-10">
                    Las mejores imágenes
                    <span class="text-yellow-400">gratuitas</span> y libres de derechos.
                </h1>
                <p class="mt-5 sm:mt-10 lg:w-10/12 text-gray-300 text-center text-xl">
                    Listas para descargar y compartir. Encuentra la inspiración perfecta en nuestra biblioteca de fotos
                    seleccionadas.
                </p>
            </div>

            <!-- Formulario de búsqueda -->
            <div class="flex w-11/12 md:w-8/12 xl:w-6/12">
                <div class="flex rounded-md w-full">
                    <form action="index.php" method="GET" class="flex w-full">
                        <!-- Campo de búsqueda -->
                        <input type="text" name="q" 
                            class="w-full p-3 rounded-l-md border border-gray-300 placeholder-gray-400" 
                            placeholder="Categoría" />

                        <!-- Botón de búsqueda -->
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-yellow-400 text-black text-lg font-semibold py-3 px-6 rounded-r-md">
                            <span>Buscar</span>
                            <svg class="text-black h-5 w-5 p-0 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 56.966 56.966">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
                                        s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                                        c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</header>
