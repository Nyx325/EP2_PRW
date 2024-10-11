import "./public/components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", () => {
  const userMenu = document.getElementById("user-menu");

  userMenu.addEventListener("click", async (event) => {
    event.preventDefault();

    console.log("Se hizo click");
    const responseJSON = await fetch("./src/config/session.php");
    const responseText = await responseJSON.text(); // Cambiar a .text() para ver la respuesta sin parsear
    console.log(responseText);
    const response = JSON.parse(responseText); // Intenta convertir a JSON después

    if (response.status === "success") {
      document.location.href = "./public/views/userMenu.html";
    } else {
      document.location.href = "./public/views/login.html";
    }
  });
});
