// Previsualización de la imagen
function previewFile(file) {
    const reader = new FileReader();
    reader.onloadend = () => {
        const preview = document.getElementById('preview');
        preview.innerHTML = `<img src="${reader.result}" alt="Previsualización" class="w-full h-32 object-cover rounded-lg">`;
    };
    if (file) {
        reader.readAsDataURL(file);
    }
}

// Manejo del área de drag and drop
document.addEventListener('DOMContentLoaded', () => {
    let dropArea = document.getElementById('drop-area');
    if (dropArea) {
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('border-yellow-400');
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    let dropArea = document.getElementById('dropArea');
    if (dropArea) {
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-yellow-400');
        });
    }
});
const dropArea = document.getElementById('drop-area'); 

document.addEventListener('DOMContentLoaded', (event) => {
    const dropArea = document.getElementById('dropArea');
    if (dropArea) {
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('border-yellow-400');
            const file = event.dataTransfer.files[0];
            previewFile(file);
            document.getElementById('dropzone-file').files = event.dataTransfer.files; // Asignar el archivo al input
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const dropzoneFile = document.getElementById('dropzone-file');
    if (dropzoneFile) {
        dropzoneFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            previewFile(file);
        });
    } else {
        console.error('Elemento con ID "dropzone-file" no encontrado.');
    }
});


