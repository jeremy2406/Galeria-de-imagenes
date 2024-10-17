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
    <title>Subir Imagen</title>
</head>

<body  style="background-image: linear-gradient(to right, #1a2a6c 0%, #000000 100%);">
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
                    <a href="index.php" class="text-base text-white hover:text-opacity-80">
                            Inicio
                        </a>
                        <a href="Categorias.php" class="text-base text-white hover:text-opacity-80">
                            Categorías
                        </a>
                        <a href="imagenes_con_likes.php" class="text-base text-white hover:text-opacity-80">
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
            <a href="Index.php" class="text-base text-white hover:text-opacity-80">
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

    <!-- Contenedor principal -->
  
    <form action="subir_imagen.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-center w-full px-4 py-10 sm:px-6 lg:px-8 space-y-10">
    <!-- Drag and Drop zone -->
    <label for="dropzone-file"
        id="drop-area"
        class="flex flex-col items-center justify-center w-full max-w-xl h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
            <p class="text-xs text-gray-500">SVG, PNG, JPG o GIF (MAX. 800x400px)</p>
        </div>
        <input id="dropzone-file" type="file" class="hidden" name="imagen" />  
        
    </label>

    <select id="categoria" name="categoria" class="mt-4 block w-60 px-3 py-1.5 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-yellow-300 focus:border-yellow-500 transition duration-150 ease-in-out">
    <option value="" disabled selected>Selecciona una categoría</option>
    <?php
    $query = "SELECT * FROM categoria";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['ID']}'>{$row['Nombre']}</option>";
    }
    ?>
</select>



    <!-- Preview -->
    <div id="preview" class="mt-4"></div>

    <!-- Botón de acción -->
    <button type="submit" id="uploadBtn"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
        Subir Imagen
    </button>
</form>



    <?php include 'Componentes/Footer.php'; 
   
    ?>

