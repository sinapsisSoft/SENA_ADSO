---
marp: true
theme: default
paginate: true
backgroundColor: #fff
backgroundImage: url('https://marp.app/assets/hero-background.svg')
---
![bg left:40% 80%](https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png)
# Explicación del Código HTML  
## Formulario de Tipo de Documento

---

## 🧩 Estructura básica del documento

```html
<!DOCTYPE html>
<html lang="en">
```

- `<!DOCTYPE html>`: Indica que el documento sigue el estándar HTML5.
- `<html lang="en">`: Define el idioma principal como inglés.

---

## 🔧 Encabezado `<head>`

```html
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
```

- `charset`: Codificación UTF-8.
- `viewport`: Adaptación a dispositivos móviles.

---

## 📚 Recursos externos - CSS

```html
  <link href="...bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="...font-awesome.min.css">
  <link rel="stylesheet" href="...dataTables.dataTables.css">
  <link rel="stylesheet" href="...loading.css">
```

- Bootstrap: Estilos base.
- Font Awesome: Iconos.
- DataTables: Tablas dinámicas.
- loading.css: Pantalla de carga personalizada.

---

## 🧭 Navegación y Estructura

```html
<body>
  <!--Nav-->
  <nav></nav>

  <!--Container -->
  <div class="container">
    <!--Sidebar-->
    <aside></aside>
```

- `nav`: Sección para navegación (vacía).
- `aside`: Espacio para panel lateral (vacío).
- `container`: Contenedor principal de Bootstrap.

---

## 📝 Contenido principal

```html
<main>
  <h1 class="text-center">Formulario...</h1>
  <button onclick="add()">...</button>
```

- `main`: Sección principal.
- Título centrado.
- Botón que dispara la función `add()`.

---

## 📊 Tabla de Tipos de Documento

```html
<table id="app-table" class="table table-dark table-hover">
  <thead>...</thead>
  <tbody id="app-table-body">...</tbody>
  <tfoot>...</tfoot>
</table>
```

- Tabla con Bootstrap oscura.
- Cabecera (`thead`) y pie (`tfoot`) con etiquetas.
- Cuerpo (`tbody`) dinámico.

---

## 💬 Modal de Formulario

```html
<div class="modal fade" id="appModal" ...>
  <div class="modal-dialog">
    <div class="modal-content">...</div>
  </div>
</div>
```

- Modal de Bootstrap para insertar/editar datos.
- Contiene formulario con campos `Name` y `Description`.

---

## 🧾 Formulario dentro del Modal

```html
<form id="documentTypeForm">
  <input id="name" name="name" ...>
  <textarea id="description" name="description" ...></textarea>
```

- Formulario con campos obligatorios.
- Botones para **Reset** y **Enviar**.
- Utiliza clases `form-floating` para diseño.

---

## ⏳ Pantalla de Carga

```html
<div id="loading-screen">
  <div class="spinner-border">...</div>
  <p>Data loading...</p>
</div>
```

- Spinner de Bootstrap.
- Se muestra al cargar datos.

---

## 🧠 Scripts JavaScript

```html
<script src="...bootstrap.bundle.min.js"></script>
<script src="...jquery-3.7.1.js"></script>
<script src="...dataTables.js"></script>
<script src="...app.js"></script>
...
```

- Librerías esenciales.
- Scripts personalizados:
  - `app.js`: Lógica general.
  - `services.js`: Llamadas a servicios.
  - `Form.js`: Utilidades del formulario.
  - `documentType.controller.js`: Controlador de lógica principal.

---

## ✅ Conclusión

- Página estructurada con HTML5 y Bootstrap.
- Tabla dinámica gestionada por DataTables y JS personalizado.
- Modal reutilizable para entrada de datos.
- Estilo limpio y responsive.

---

# ¡Gracias!

¿Preguntas?  
🤓
