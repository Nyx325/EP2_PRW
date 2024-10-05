import { NavBar } from "navBar.js";

export default class Header {
    constructor(headerContainerId, navBar) {
        this.container = document.getElementById(containerId);
        this.navBar = new NavBar();
    }

    render() {

    }

    createTitle(title) {
        const title = document.createElement('h1');
        title.innerHTML = title;
        this.container.appendChild(title);
        this.navBar.render();
    }
}