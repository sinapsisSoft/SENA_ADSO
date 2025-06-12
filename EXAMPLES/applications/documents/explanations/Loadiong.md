---
marp: true
theme: default
paginate: true
backgroundColor: #fff
backgroundImage: url('https://marp.app/assets/hero-background.svg')
---
![bg left:40% 80%](https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png)

# Explicación del Código de Pantalla de Carga

---

## `loading.css`

Este archivo CSS define los estilos para la pantalla de carga que se muestra mientras el contenido de la página se está cargando.

```css
#loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  flex-direction: column;
  color: white;
  display: none; /* Oculto por defecto */
}
```
---

## `app.js`

Este archivo JavaScript contiene la lógica para interactuar con la pantalla de carga, permitiendo mostrarla u ocultarla.

```js
const loadingScreen = document.getElementById('loading-screen');
// Function to show/hide the loader
function toggleLoading(show) {
  loadingScreen.style.display = show ? 'flex' : 'none';
}
```
---

## `app.js`

Esta función se invocaría en diferentes puntos de la aplicación JavaScript, por ejemplo, antes de realizar una solicitud de datos y después de que los datos se hayan cargado.
Para ocultar la pantalla de carga:
```js
toggleLoading(false);
```
Para mostrar la pantalla de carga:
```js
toggleLoading(true);
```

---

## `views.html`

La implementación de la pantalla de carga en el archivo `views.html` se realiza utilizando la etiqueta `<div>` con el id `loading-screen`.
```html
 <!--Loading -->
  <div id="loading-screen">
    <div class="spinner-border text-light spinner" role="status">
      <span class="visually-hidden">Loading ...</span>
    </div>
    <p class="mt-3">Data loading, please wait...</p>
  </div>
  <!--End Loading -->
```
---

## ✅ Conclusión

- const loadingScreen = document.getElementById('loading-screen');: Obtiene una referencia al elemento HTML con el ID loading-screen. Esta constante se utilizará para manipular el estilo de la pantalla de carga.
- toggleLoading(show): Esta función toma un parámetro show que indica si se debe mostrar o ocultar la pantalla de carga. Si show es true, se muestra la pantalla de carga; si es false, se oculta.
- toggleLoading(false): Llama a la función toggleLoading con el parámetro false, lo que oculta la pantalla de carga.
- toggleLoading(true): Llama a la función toggleLoading con el parámetro true, lo que muestra la pantalla de carga.

---

## ¡Gracias!

¿Preguntas?  
🤓