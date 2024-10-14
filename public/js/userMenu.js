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
  const citasBtn = document.createElement("a");
  citasBtn.setAttribute("href", "../views/menuCitas.html");

  const citasImg = document.createElement("img");
  citasImg.setAttribute("src", "../assets/icon/r.png");
  citasBtn.appendChild(citasImg);

  nav.appendChild(citasBtn);

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
