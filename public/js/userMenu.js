import "../components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", async () => {
  const responseJson = await fetch("../../src/config/session.php");
  const response = JSON.parse(await responseJson.text());
  console.log(response);

  if (response.status !== "success")
    document.location.href = "../views/login.html";

  console.log(response);

  // Inicializamos el objeto user como null y luego asignamos response.user
  const username = response.username;
  console.log(`usermane: ${username}`);
  const nav = document.getElementById("user-options");

  // Botón que siempre debe generarse y redirige a index.html
  const homeButton = document.createElement("a");
  homeButton.setAttribute("href", "../views/index.html");
  homeButton.textContent = "Home";
  nav.appendChild(homeButton);

  // Verificamos si el usuario es "admin"
  if (username === "admin") {
    const crudServiceLink = document.createElement("a");
    crudServiceLink.setAttribute("href", "../views/serviciosMenu.html");
    console.log(crudServiceLink.getAttribute("href"));

    const crudServiceImg = document.createElement("img");
    crudServiceImg.setAttribute("src", "../assets/icon/c.png");
    crudServiceLink.appendChild(crudServiceImg);

    nav.appendChild(crudServiceLink);
  }
});
