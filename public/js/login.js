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
    const responseJSON = await fetch("../../src/config/session.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ user }),
    });

    console.log(`responseJSON: ${responseJSON}`);

    const responseText = await responseJSON.text();
    console.log(`responseText: ${responseText}`);
    const response = JSON.parse(responseText);
    console.log(response);

    if (response.status === "error") {
      alert.classList.remove("d-none");
      alert.innerText = response.message;
    } else {
      alert.classList.add("d-none");
      document.location.href = "../views/userMenu.html";
    }
  });
});
