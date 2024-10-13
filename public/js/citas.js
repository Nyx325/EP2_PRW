import "../components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("form-cita");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    const cita = {
      nombre: document.getElementById("nombre").value,
      apellido: document.getElementById("apellido").value,
      hora: document.getElementById("hora").value,
      fecha: document.getElementById("fecha").value,
      servicio: document.getElementById("servicios").value,
    };

    fetch("../../src/routes/citaRoutes.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(cita), // Convertimos el objeto a JSON
    })
      .then((response) => response.json()) // Parseamos la respuesta a JSON
      .then((res) => {
        console.log("Respuesta del servidor:", res);
        if (res.success === true) {
          console.log("Todo bien");
          form.reset(); // Limpiamos el formulario si todo está bien
        } else {
          console.error("Error en la respuesta del servidor:", res);
        }
      })
      .catch((e) => {
        console.error("Error en la petición:", e);
      });
  });
});
