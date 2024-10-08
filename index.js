import "./public/components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", () => {
  const userMenu = document.getElementById("user-menu");

  userMenu.addEventListener("click", (event) => {
    event.preventDefault();

    fetch("./src/config/session.php")
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.status === "success") {
          document.location.href = "./public/views/menuRandom.html";
        } else {
          document.location.href = "./public/views/login.html";
        }
      });
  });
});
