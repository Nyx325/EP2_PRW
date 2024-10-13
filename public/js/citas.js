document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-cita");
    const mensaje = document.getElementById("mensaje");
  
    form.addEventListener("submit", async (event) => {
      event.preventDefault();
  
      const cita = {
        nombre: document.getElementById("nombre").value,
        apellido: document.getElementById("apellido").value,
        hora: document.getElementById("hora").value,
        fecha: document.getElementById("fecha").value,
        servicios: document.getElementById("servicios").value, 
      };
  
      console.log("Datos enviados:", cita);
  
      try {
        const response = await fetch("../../src/config/session.php?action=crearCita", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(cita),
        });
  
        const result = await response.json();
        console.log("Respuesta del servidor:", result);
  
        mensaje.innerText = result.message;
  
        if (result.status === "success") {
          mensaje.classList.remove("alert-danger");
          form.reset();
        }
      } catch (error) {
        console.error("Error:", error);
        mensaje.innerText = "Hubo un error al crear la cita.";
      }
    });
  });