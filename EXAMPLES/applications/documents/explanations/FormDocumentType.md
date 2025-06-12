---

theme: default
paginate: true
---

# Formulario de Tipo de Documento

Explicación detallada del formulario HTML proporcionado.  
Incluye estructura, componentes visuales, y validaciones con JavaScript.
El formulario tiene tres entradas de datos, dos inputs uno de tipo numérico y otro de tipo texto. Adicionalmente, tiene un texarea con elemento de captura de datos. .

---

## Estructura General del HTML
#### Configuración de metadatos, importación de librerías, título de la página.
```html
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Tipo de Documento</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
```

#### Contenedor del sitio y del formulario. Este contenedor tiene un formulario, el cual tiene tres cajas de texto y dos botones.
```html
<div class="container">
    <div class="form-container bg-white">
      <h2 class="text-center mb-4">Formulario de Tipo de Documento</h2>
      <form id="documentTypeForm">
        <div class="mb-3">
          <label for="name" class="form-label required"></label>
          <div class="form-floating">
            <input type="text" class="form-control" placeholder="Name" id="name" name="name" required value="">
            <label for="name">Name</label>
          </div>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label required"></label>
          <div class="form-floating">
            <input type="number" class="form-control edit-input" placeholder="Name" id="name2" name="name2" required
              value=>
            <label for="name2">Name</label>
          </div>
        </div>
        <div class="mb-3">
          <div class="form-floating">
            <textarea class="form-control" placeholder="Description" id="description" name="description"
              style="height: 100px" required> </textarea>
            <label for="description">Description</label>
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
          <button type="reset" onclick="enabledForm()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Limpiar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
   <!-- Bootstrap 5 JS Bundle con Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

```
---
#### Funciones en JavaScript para el manejo del formulario, funciones para la gestión de todos los aspectos del formulario, limpiar, tomar información, limpiar información, bloquear cajas de texto desbloquear, cargar datos al formulario. 
```js
const objForm = document.getElementById('documentTypeForm');
    const classEdit = 'edit-input';
# File: frontend/views/documentType/index.html
    
    
    const objForm = document.getElementById('documentTypeForm');
    const classEdit = 'edit-input';

    function validateForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');
      let validate = true;
      for (let i = 0; i < elementInput.length; i++) {
        if (!validateInputs(elementInput[i])) {
          validate = false;
          break;
        }
      }
      if (validate) {
        for (let j = 0; j < elementTextarea.length; j++) {
          if (!validateTextarea(elementTextarea[j])) {
            validate = false;
            break;
          }
        }
      }
      return validate;
    };
    function validateTextarea(objTextarea) {
      let getValue = objTextarea.value;
      if (getValue === "" || getValue.trim === "" || getValue.length < 3) {
        return false;
      }
      return true;

    };
    function validateInputs(objInput) {

      switch (objInput.type) {
        case "text":
          return validateText(objInput);
          break;
        case "number":
          return validateNumber(objInput);
          break;
      }

    };
    function validateText(objInput) {
      let getValue = objInput.value;
      if (getValue === "" || getValue.trim === "" || getValue.length < 2) {
        return false;
      }
      return true;
    }
    function validateNumber(objInput) {
      let getValue = objInput.value;

      if (isNaN(getValue) || getValue === "" || getValue.trim === "") {
        return false;
      }
      return true;
    }
    function getDataFormData() {
      var elementsForm = objForm.querySelectorAll('input, select, textarea');
      let fromData = new FormData();

      elementsForm.forEach(function (element) {
        if (element.id) {
          if (element.tagName === 'INPUT') {
            if (element.type === 'checkbox') {
              fromData.append(element.id, element.checked);
            } else {
              fromData.append(element.id, element.value.trim());
            }
          } else if (element.tagName === 'SELECT') {
            fromData.append(element.id, element.value.trim());
          }
          else if (element.tagName === 'TEXTAREA') {
            fromData.append(element.id, element.value.trim());
          }
        }
      });
      return fromData;
    }
    function setDataFormJson(json) {
      
      let elements = objForm.querySelectorAll("input,select");
      let jsonKeys = Object.keys(json);
      for (let i = 0; i < elements.length; i++) {
        if (elements[i].type == "checkbox") {
          if (jsonKeys.includes(elements[i].id)) {
            elements[i].checked = (json[elements[i].id] == 0) ? false : true;
          }
        } else if (elements[i].tagName === 'SELECT') {
          if (jsonKeys.includes(elements[i].id)) {
            elements[i].value = json[elements[i].id];
            elements[i].selected = true;
          }
        } else {
          if (jsonKeys.includes(elements[i].id)) {
            elements[i].value = json[elements[i].id];
          }
        }

      }
    }
    function getDataForm() {
      var elementsForm = objForm.querySelectorAll('input, select, textarea');
      let getJson = {};
      elementsForm.forEach(function (element) {
        if (element.id) {
          if (element.tagName === 'INPUT') {
            if (element.type === 'checkbox') {
              getJson[element.id] = element.checked;
            } else {
              getJson[element.id] = element.value.trim();
            }
          } else if (element.tagName === 'SELECT') {
            getJson[element.id] = element.value.trim();
          } else if (element.tagName === 'TEXTAREA') {
            getJson[element.id] = element.value.trim();
          }

        }
      });
      return getJson;

    }
    function resetForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        elementInput[i].value = "";
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].value = "";
      }
      objForm.reset();

    }
    function disabledForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        elementInput[i].disabled = true;
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].disabled = true;
      }
      objForm.reset();
    }
    function enabledForm() {

      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        elementInput[i].disabled = false;
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].disabled = false;
      }
      objForm.reset();
    }
    function enabledEditForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        if (elementInput[i].classList.contains(classEdit)) {
          elementInput[i].disabled = true;
        } else {
          elementInput[i].disabled = false;
        }
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].disabled = false;
        if (elementTextarea[j].classList.contains(classEdit)) {
          elementTextarea[j].disabled = true;
        } else {
          elementTextarea[j].disabled = false;
        }
      }
      objForm.reset();
    }
    function disabledButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].disabled = true;
      }
    }
    function enabledButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].disabled = false;
      }
    }
    function hiddenButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].style.display = "none";
      }
    }
   function showButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].style.display = "block";
      }
    }
```
---

## Configuración de metadatos, importación de librerías, título de la página.
#### Configuración de metadatos, importación de librerías, título de la página.
```html
<!DOCTYPE html>
<html lang="en">
```
#Resultado del formulario

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Tipo de Documento</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
  <div class="container">
    <div class="form-container bg-white">
      <h2 class="text-center mb-4">Formulario de Tipo de Documento</h2>
      <form id="documentTypeForm">
        <div class="mb-3">
          <label for="name" class="form-label required"></label>
          <div class="form-floating">
            <input type="text" class="form-control" placeholder="Name" id="name" name="name" required value="">
            <label for="name">Name</label>
          </div>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label required"></label>
          <div class="form-floating">
            <input type="number" class="form-control edit-input" placeholder="Name" id="name2" name="name2" required
              value=>
            <label for="name2">Name</label>
          </div>
        </div>
        <div class="mb-3">
          <div class="form-floating">
            <textarea class="form-control edit-input" placeholder="Description" id="description" name="description"
              style="height: 100px" required> </textarea>
            <label for="description">Description</label>
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
          <button type="reset" onclick="resetForm()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Reset Form
          </button>
          <button type="reset" onclick="disabledForm()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Disabled Form
          </button>
          <button type="reset" onclick="enabledForm()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Enabled Form
          </button>
          <button type="reset" onclick="enabledEditForm()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Enabled Edit Form
          </button>
          <button type="reset" onclick="disabledButton()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Disabled Button
          </button>
          <button type="reset" onclick="enabledButton()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Enabled Button
          </button>
          <button type="reset" onclick="hiddenButton()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Hidden Button
          </button>
          <button type="reset" onclick="showButton()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Show Button
          </button>
          <button type="reset" onclick="console.log(getDataForm())" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Get Data Form
          </button>
          <button type="reset" onclick="console.log(getDataFormData())" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Get Data Form-Data
          </button>
          <button type="reset" onclick="setDataFormJson()" class="btn btn-outline-secondary me-md-2">
            <i class="fas fa-undo me-1"></i> Set Data Form Json
          </button>
        </div>
      </form>
    </div>
  </div>


  <!-- Bootstrap 5 JS Bundle con Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JS personalizado -->
  <script>

    const objForm = document.getElementById('documentTypeForm');
    const classEdit = 'edit-input';

    function validateForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');
      let validate = true;
      for (let i = 0; i < elementInput.length; i++) {
        if (!validateInputs(elementInput[i])) {
          validate = false;
          break;
        }
      }
      if (validate) {
        for (let j = 0; j < elementTextarea.length; j++) {
          if (!validateTextarea(elementTextarea[j])) {
            validate = false;
            break;
          }
        }
      }
      return validate;
    };
    function validateTextarea(objTextarea) {
      let getValue = objTextarea.value;
      if (getValue === "" || getValue.trim === "" || getValue.length < 3) {
        return false;
      }
      return true;

    };
    function validateInputs(objInput) {

      switch (objInput.type) {
        case "text":
          return validateText(objInput);
          break;
        case "number":
          return validateNumber(objInput);
          break;
      }

    };
    function validateText(objInput) {
      let getValue = objInput.value;
      if (getValue === "" || getValue.trim === "" || getValue.length < 2) {
        return false;
      }
      return true;
    }
    function validateNumber(objInput) {
      let getValue = objInput.value;

      if (isNaN(getValue) || getValue === "" || getValue.trim === "") {
        return false;
      }
      return true;
    }
    function getDataFormData() {
      var elementsForm = objForm.querySelectorAll('input, select, textarea');
      let fromData = new FormData();

      elementsForm.forEach(function (element) {
        if (element.id) {
          if (element.tagName === 'INPUT') {
            if (element.type === 'checkbox') {
              fromData.append(element.id, element.checked);
            } else {
              fromData.append(element.id, element.value.trim());
            }
          } else if (element.tagName === 'SELECT') {
            fromData.append(element.id, element.value.trim());
          }
          else if (element.tagName === 'TEXTAREA') {
            fromData.append(element.id, element.value.trim());
          }
        }
      });
      return fromData;
    }
    function setDataFormJson(json) {
      
      let elements = objForm.querySelectorAll("input,select");
      let jsonKeys = Object.keys(json);
      for (let i = 0; i < elements.length; i++) {
        if (elements[i].type == "checkbox") {
          if (jsonKeys.includes(elements[i].id)) {
            elements[i].checked = (json[elements[i].id] == 0) ? false : true;
          }
        } else if (elements[i].tagName === 'SELECT') {
          if (jsonKeys.includes(elements[i].id)) {
            elements[i].value = json[elements[i].id];
            elements[i].selected = true;
          }
        } else {
          if (jsonKeys.includes(elements[i].id)) {
            elements[i].value = json[elements[i].id];
          }
        }

      }
    }
    function getDataForm() {
      var elementsForm = objForm.querySelectorAll('input, select, textarea');
      let getJson = {};
      elementsForm.forEach(function (element) {
        if (element.id) {
          if (element.tagName === 'INPUT') {
            if (element.type === 'checkbox') {
              getJson[element.id] = element.checked;
            } else {
              getJson[element.id] = element.value.trim();
            }
          } else if (element.tagName === 'SELECT') {
            getJson[element.id] = element.value.trim();
          } else if (element.tagName === 'TEXTAREA') {
            getJson[element.id] = element.value.trim();
          }

        }
      });
      return getJson;

    }
    function resetForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        elementInput[i].value = "";
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].value = "";
      }
      objForm.reset();

    }
    function disabledForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        elementInput[i].disabled = true;
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].disabled = true;
      }
      objForm.reset();
    }
    function enabledForm() {

      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        elementInput[i].disabled = false;
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].disabled = false;
      }
      objForm.reset();
    }
    function enabledEditForm() {
      let elementInput = objForm.querySelectorAll('input');
      let elementTextarea = objForm.querySelectorAll('textarea');

      for (let i = 0; i < elementInput.length; i++) {
        if (elementInput[i].classList.contains(classEdit)) {
          elementInput[i].disabled = true;
        } else {
          elementInput[i].disabled = false;
        }
      }
      for (let j = 0; j < elementTextarea.length; j++) {
        elementTextarea[j].disabled = false;
        if (elementTextarea[j].classList.contains(classEdit)) {
          elementTextarea[j].disabled = true;
        } else {
          elementTextarea[j].disabled = false;
        }
      }
      objForm.reset();
    }
    function disabledButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].disabled = true;
      }
    }
    function enabledButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].disabled = false;
      }
    }
    function hiddenButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].style.display = "none";
      }
    }
    function showButton() {
      let elementButton = objForm.querySelectorAll('button');
      for (let i = 0; i < elementButton.length; i++) {
        elementButton[i].style.display = "block";
      }
    }
  </script>
</body>

</html>
