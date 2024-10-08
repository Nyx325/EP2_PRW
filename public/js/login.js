import "../components/dinamicContent.js";
document.addEventListener("DOMContentLoaded", () => {
  const alert = document.getElementById("modal-alert");
  const loginBtn = document.getElementById("login-button");
  const usrInput = document.getElementById("user-input");
  const pwdInput = document.getElementById("pwd-input");
  const form = document.getElementById("login-form");

  form.addEventListener("submit", (event) => event.preventDefault());

  loginBtn.addEventListener("click", async () => {
    const user = { userName: usrInput.value, password: pwdInput.value };
    console.log(user);

    if (user.userName === "") {
      usrInput.focus();
      return;
    }

    if (user.password === "") {
      pwdInput.focus();
      return;
    }

    console.log("solicitando respuesta");
    fetch("../../src/config/session.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ user }),
    })
      .then((response) => {
        return response.text();
      })
      .then((data) => {
        console.log("Respuesta del servidor:", data); // Mostrar respuesta
        // Intenta convertir la respuesta a JSON solo si es válida
        try {
          const jsonData = JSON.parse(data);
          console.log(jsonData);
          if (jsonData.status === "error") {
            alert.classList.remove("d-none");
            alert.innerText = jsonData.message;
          } else {
            alert.classList.add("d-none");
            document.location.href = "../views/menuRandom.html";
          }
        } catch (e) {
          console.error("Error al analizar JSON:", e);
        }
      })
      .catch((error) => console.error(error));
  });
});
