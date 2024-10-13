class DinamicContent extends HTMLElement {
  constructor() {
    super();

    /* El Shadow DOM es una tecnología del desarrollo
     * web que permite a los desarrolladores encapsular
     * el estilo y la estructura de los elementos
     * dentro de un componente.
     *
     * Cuando llamas a attachShadow, estás creando un
     * nuevo árbol de DOM que está "encapsulado" dentro
     * del elemento que lo llama. Este árbol de Shadow
     * DOM se comporta como un DOM independiente,
     * permitiendo que su contenido y estilo no se
     * filtren al documento principal.
     */
    this.attachShadow({ mode: "open" });
  }

  /* El método connectedCallback() es un ciclo de vida
   * que forma parte de la API de los Custom Elements en
   * JavaScript, que es parte de la especificación de
   * Web Components. Este método se invoca automáticamente
   * cada vez que una instancia de un elemento
   * personalizado se agrega al DOM (Document Object Model).
   */
  connectedCallback() {
    this.render();
  }

  render() {
    // Obtener el path del header especificado en el
    // componente
    const path = this.getAttribute("path");
    // Obtener el path del estilo especificado en el
    // componente
    const stylePath = this.getAttribute("style-path");

    // Validar que debe existir un path del header
    if (!path) {
      console.error('Atributo "path" requerido');
      return;
    }

    // Fetch para cargar el HTML
    fetch(path)
      .then((response) => response.text()) // Obtener el contenido del html como texto
      .then((html) => {
        if (stylePath) {
          fetch(stylePath)
            .then((styleResponse) => styleResponse.text())
            .then((styles) => {
              this.shadowRoot.innerHTML = `
            <style>${styles}</style>
            ${html}`;
            })
            .catch((error) => console.error("Error cargando estilos:", error));
        } else {
          this.shadowRoot.innerHTML = html;
        }
      })
      .catch((error) => console.error("Error cargando header:", error));
  }
}
fetch('', {
  method: 'POST',
  headers: {
      'Content-Type': 'application/json'
  },
  body: JSON.stringify(cita)
})
.then(response => response.json())
.then(data => {
  console.log(data);
})
.catch(error => {
  console.error('Error:', error);
});

// Hacer que nuestro componente pueda ser usado
// en el html
customElements.define("dinamic-content", DinamicContent);
