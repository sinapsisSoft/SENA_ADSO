
const ObjImgForm = document.getElementById("uploadForm");
const fileInput = document.getElementById('fileInput');
const messageDiv = document.getElementById('message');
const fileInfoDiv = document.getElementById('fileInfo');
const imagePreview = document.getElementById('imagePreview');
const progressContainer = document.getElementById('progressContainer');
const progressBarFill = document.getElementById('progressBarFill');
const progressPercent = document.getElementById('progressPercent');
const clearButton = document.getElementById('clearButton');

/* The constants `URL`, `URL_IMG`, and `URL_UPLOAD` are defining the base URLs and endpoints for making
API requests related to file uploads. Here is what each constant represents: */
const URL_APP = "http://localhost:3000/api_v1/";
const URL_IMG = "../backend/data/uploads/";
const URL_UPLOAD = "upload";

ObjImgForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const url = URL_APP + URL_UPLOAD;
    if (fileInput.files.length === 0) {
        messageDiv.textContent = 'Please select a file';
        return;
    }

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('file', file);
    clearAll();
    // Show progress bar
    progressContainer.style.display = 'block';
    progressBarFill.style.width = '0%';
    progressPercent.textContent = '0';

    try {
        const xhr = new XMLHttpRequest();
        xhr.upload.addEventListener('progress', (event) => {
            if (event.lengthComputable) {
                const percentComplete = Math.round((event.loaded / event.total) * 100);
                progressBarFill.style.width = percentComplete + '%';
                progressPercent.textContent = percentComplete;
            }
        });

        
        xhr.onload = function () {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
               
                handleSuccess(data);
            } else {
                handleError(xhr.statusText);
            }
        };
        xhr.onerror = function () {
            handleError('Connection error');
        };

        
        xhr.open('POST', url, true);
        xhr.send(formData);

    } catch (error) {
        handleError(error.message);
    }

    

});
function handleSuccess(data) {
        messageDiv.textContent = data.message;
        messageDiv.style.color = 'green';

        fileInfoDiv.innerHTML = `
            <h3>Información del archivo:</h3>
            <p><strong>Nombre:</strong> ${data.file.filename}</p>
            <p><strong>Tamaño:</strong> ${(data.file.size / 1024).toFixed(2)} KB</p>
            <p><strong>Tipo:</strong> ${data.file.mimetype}</p>
        `;

        if (data.file.mimetype.startsWith('image/')) {
            const previewUrl = URL_IMG + data.file.filename;
            console.log(previewUrl);
        // imagePreview.innerHTML = `
        //     <h3>Vista previa:</h3>
        //     <img src="${previewUrl}"
        //          alt="Imagen de subida"
        //          class="img-fluid mb-5 mx-auto d-block"
        //          style="max-width: 100%; height: auto;"
        //          onerror="this.onerror=null;this.src='${URL.createObjectURL(fileInput.files[0])}'">
        // `;

        } else {
            imagePreview.innerHTML = '<p>No es una imagen, no se puede mostrar vista previa</p>';
        }
        
    }

    function handleError(errorMessage) {
        messageDiv.textContent = 'Error: ' + errorMessage;
        messageDiv.style.color = 'red';
        imagePreview.innerHTML = '';
        progressBarFill.style.backgroundColor = '#f44336';
    }

    // Function to clear everything
    function clearAll() {
        // Clear the file input
        fileInput.value = '';

        // Clear messages and information
        messageDiv.textContent = '';
        fileInfoDiv.innerHTML = '';
        imagePreview.innerHTML = '';

        // Reset the progress bar
        progressContainer.style.display = 'none';
        progressBarFill.style.width = '0%';
        progressPercent.textContent = '0';
        progressBarFill.style.backgroundColor = '#4CAF50'; // Volver al color original
    }
    // Event for the clear button
    clearButton.addEventListener('click', clearAll);


