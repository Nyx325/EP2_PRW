function insertHeaderOrFooter(htmlFile, containerName){
    const placeholder = document.getElementById(containerName);
    if(placeholder === null){
        console.error(`No se encontró el elemento ${containerName}`);
        return;
    }
    
    // Obtener el contenido del html 
    fetch(htmlFile)
    // Obtener esa respuesta como texto 
    .then(response => response.text())
    //Insertar el html en el placeholder
    .then(data => {
        placeholder.innerHTML = data;
    });
}

function injectCSS(cssFile) {
    const head = document.head;
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = cssFile;
    head.appendChild(link);
}

document.addEventListener("DOMContentLoaded", () => {
    injectCSS("../css/header-footer.css");

    insertHeaderOrFooter('../partials/header.html', 'header-placeholder');
    insertHeaderOrFooter('../partials/footer.html', 'footer-placeholder');
})