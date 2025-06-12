---
marp: true
theme: default
paginate: true
backgroundColor: #fff
backgroundImage: url('https://marp.app/assets/hero-background.svg')
---
![bg left:40% 80%](https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png)

# Explicación del archivo `documentType.controller.js`

Este documento presenta una explicación detallada del código contenido en el archivo `documentType.controller.js`, utilizado para gestionar la lógica de interacción con un formulario de tipo de documento.

---


## Inicialización de objetos

```js
const objForm = new Form('documentTypeForm', 'edit-input');
const objModal = new bootstrap.Modal(document.getElementById('appModal'));
const objTableBody = document.getElementById('app-table-body');
const myForm = objForm.getForm();
```

Se crean las referencias necesarias al formulario (`Form.js`), al modal de Bootstrap, al cuerpo de la tabla y se obtiene el formulario para la gestión de eventos.

---

## Variables globales

```js
let insertUpdate = true;
let data = "";
let method = "";
let url = "";
let keyId;
```

Se definen variables de control para manejar si se está insertando o actualizando, la data del formulario, el método HTTP a usar y la URL destino.

---

## Evento submit del formulario

```js
myForm.addEventListener('submit', (e) => { ... });
```

Se previene el comportamiento por defecto, se valida el formulario y se define el método HTTP (`POST` o `PUT`) y la URL. Luego se envían los datos con `getDataServices`.

---

## Función `add()`

```js
function add() {
  showHiddenModal(true);
  insertUpdate = true;
  objForm.resetForm();
  objForm.enabledForm();
  objForm.enabledButton();
  objForm.showButton();
}
```

Prepara el formulario para registrar un nuevo documento. Limpia, habilita y muestra los elementos del formulario.

---

## Función `showId(id)`

```js
function showId(id) { ... }
```

Carga los datos del documento en modo solo lectura. Deshabilita los campos y oculta los botones del formulario.

---

## Función `edit(id)`

```js
function edit(id) { ... }
```

Prepara el formulario para editar un documento existente. Carga los datos con `getDataId`, habilita los campos excepto los de solo lectura.

---

## Función `delete_(id)`

```js
function delete_(id) { ... }
```

Pregunta al usuario si desea eliminar el documento. Si acepta, envía la solicitud `DELETE` usando `getDataServices`.

---

## Función `getDataId(id)`

```js
function getDataId(id) { ... }
```

Hace una solicitud `GET` para obtener un documento específico y lo carga en el formulario con `setDataFormJson`.

---

## Función `getData()`

```js
function getData() { ... }
```

Carga todos los documentos y los muestra en una tabla HTML. Se utiliza la librería `DataTable` para mejor presentación.

---

## Función `createTable(data)`

```js
function createTable(data) { ... }
```

Construye dinámicamente las filas de la tabla con los datos obtenidos del backend. Cada fila incluye botones de acciones.

---

## Mostrar u ocultar modal

```js
function showHiddenModal(type) { ... }
```

Muestra o esconde el modal de Bootstrap según el parámetro recibido.

---

## Carga inicial de la vista

```js
window.addEventListener('load', () => { loadView(); });
```

Cuando la página carga, se llama a `loadView` que a su vez invoca `getData` para poblar la tabla inicial.

---

## Relación con la clase `Form`

El archivo depende de `Form.js`, una clase que abstrae la validación, lectura, escritura, habilitación y deshabilitación de elementos del formulario. Esto permite que `documentType.controller.js` se enfoque solo en la lógica de negocio y no en manipulación directa del DOM.

---

## ¡Gracias!

¿Preguntas?  
🤓

Gracias por su atención. Este módulo JavaScript permite una gestión completa de formularios con una estructura clara, reutilizable y mantenible.

