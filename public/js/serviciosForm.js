import "../components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", () => {
  const alert = document.getElementById("modal-alert");
  const nombreInput = document.getElementById("service-name");
  const precioInput = document.getElementById("service-price");
  const btnAceptar = document.getElementById("aceptar-btn");

  btnAceptar.addEventListener("click", async () => {
    const servicio = {
      servicio: nombreInput.value,
      precio: precioInput.value,
    };

    console.log(`Objeto JS:`);
    console.log(servicio);

    if (servicio.servicio === "") {
      nombreInput.focus();
      return;
    }

    if (servicio.precio === "") {
      precioInput.focus();
      return;
    }

    if (isNaN(servicio.precio)) {
      precioInput.focus();
      alert.classList.remove("d-none");
      alert.innerText = "El precio debe ser un número";
      return;
    }

    const responseJSON = await fetch("../../src/routes/serviceRoutes.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ servicio }),
    });

    const resText = await responseJSON.text();
    console.log(resText);
    const res = JSON.parse(resText);

    if (res.success === false) {
      console.error(res.error);
    }

    if (res.success === false) {
      console.error(res);
      alert.classList.remove("d-none");
      alert.innerText = res.error.message ?? res.error;
    } else {
      alert.classList.add("d-none");
      document.location.href = "../views/serviciosMenu.html";
    }
  });
});
