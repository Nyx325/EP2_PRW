function insertHeaderOrFooter(htmlFile, containerName) {
  const placeholder = document.getElementById(containerName);
  if (placeholder === null) {
    console.error(`No se encontró el elemento ${containerName}`);
    return;
  }

  // Obtener el contenido del html
  fetch(htmlFile)
    .then((response) => response.text())
    .then((data) => {
      placeholder.innerHTML = data;
    })
    .catch((error) => console.error(`Error al cargar ${htmlFile}: `, error));
}

function injectCSS(cssFile) {
  const head = document.head;
  const link = document.createElement("link");
  link.rel = "stylesheet";
  link.type = "text/css";
  link.href = cssFile;
  head.appendChild(link);
}

document.addEventListener("DOMContentLoaded", () => {
  // Obtener el path del archivo actual
  const currentPath = window.location.pathname;

  // Calcular el nivel de profundidad (cuántas carpetas hay entre el archivo actual y la raíz)
  const depth = currentPath.split("/").length - 2;

  // Generar una ruta relativa a la carpeta "public/partials/"
  const relativePath = "../".repeat(depth) + "public/partials/";

  // Cargar los CSS y las partes del header y footer
  injectCSS(`${relativePath}../css/header-footer.css`);
  insertHeaderOrFooter(`${relativePath}header.html`, "header-placeholder");
  insertHeaderOrFooter(`${relativePath}footer.html`, "footer-placeholder");
});
