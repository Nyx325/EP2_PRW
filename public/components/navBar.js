/**
 * Clase NavBar para generar y renderizar un menú de navegación dinámico.
 * 
 * Esta clase permite agregar opciones a un menú de navegación
 * y renderizarlo dinámicamente dentro de un contenedor especificado.
 */
export default class NavBar {
    /**
     * Crea una instancia de la clase NavBar.
     * 
     * @param {string} navContainerId - El ID del contenedor donde se renderizará el <nav>.
     */
    constructor(navContainerId) {
        /**
         * @property {HTMLElement} container - El 
         * contenedor HTML donde se insertará el <nav>.
         */
        this.container = document.getElementById(navContainerId); // Obtener el contenedor por su ID

        /**
         * @property {object[]} options - Lista de 
         * opciones del navbar. Cada opción contiene 
         * un título y un destino.
         * @property {string} options[].optTitle - 
         * Título de la opción a mostrar en el navbar.
         * @property {string} options[].destity - 
         * Dirección URL a la que redirige la opción.
         */
        this.options = [];
    }

    /**
     * Renderiza el menú de navegación (<nav>) con las opciones configuradas.
     * 
     * Crea dinámicamente los elementos <ul> y <li> dentro de un <nav>
     * y los inserta en el contenedor HTML especificado.
     */
    render() {
        // Limpiar el contenido previo del contenedor antes de renderizar el nuevo <nav>
        this.container.innerHTML = "";

        // Crear el elemento <nav>
        const nav = document.createElement("nav");

        // Crear la lista de opciones <ul>
        const list = document.createElement("ul");

        // Iterar sobre las opciones configuradas y crear los elementos <li> y <a>
        this.options.forEach((option) => {
            const item = document.createElement("li");
            const href = document.createElement("a");
            href.innerText = option.optTitle;
            href.setAttribute("href", option.destity);

            // Añadir el enlace <a> al elemento <li>
            item.appendChild(href);

            // Añadir el elemento <li> a la lista <ul>
            list.appendChild(item);
        });

        // Añadir la lista <ul> al elemento <nav>
        nav.appendChild(list);

        // Añadir el <nav> al contenedor HTML
        this.container.appendChild(nav);
    }

    /**
     * Establece una lista de opciones para el navbar.
     * 
     * @param {object[]} options - Lista de opciones donde cada opción tiene un título y un destino.
     * @param {string} options[].optTitle - El título de la opción que se mostrará en el menú.
     * @param {string} options[].destity - La URL o lugar al que redirige la opción del menú.
     */
    setOptions(options) {
        this.options = options; // Almacenar las nuevas opciones en la instancia
    }

    /**
     * Agrega una opción adicional al navbar.
     * 
     * @param {object} option - Un objeto que representa una opción del menú.
     * @param {string} option.optTitle - El título de la opción.
     * @param {string} option.destity - La URL o lugar al que redirige la opción.
     */
    addOption(option) {
        this.options.push(option); // Añadir la nueva opción al array de opciones
    }
}
