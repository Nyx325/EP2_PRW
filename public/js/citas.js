import "../components/dinamicContent.js";

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('form-cita');
  
  // Verifica si el formulario se ha encontrado
  if (!form) {
      console.error("Formulario no encontrado");
      return; // Salir si no existe el formulario
  }

  form.addEventListener('submit', (event) => {
      event.preventDefault();

      const cita = {
          nombre: document.getElementById("nombre").value,
          apellido: document.getElementById("apellido").value,
          fecha: document.getElementById("fecha").value,
          hora: document.getElementById("hora").value,
          servicio: document.getElementById("servicios").value,
      };

      console.log("Datos enviados:", JSON.stringify(cita)); // Verifica el formato del JSON

      fetch("../../src/routes/citaRoutes.php", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
          },
          body: JSON.stringify(cita),
      })
      .then((response) => response.json())
      .then((res) => {
          console.log("Respuesta del servidor:", res);
          if (res.success) {
              console.log("Cita guardada correctamente");
              cargarCitas();
              form.reset();
          } else {
              console.error("Error en la respuesta del servidor:", res.error);
          }
      })
      .catch((e) => {
          console.error("Error en la petición:", e);
      });
  });
});

async function cargarCitas() {
  try {
      const response = await fetch('../../src/routes/citaRoutes.php');
      const data = await response.json();

      if (data.success) {
          const citas = data.citas;
          const tablaCitas = document.querySelector("#tabla-citas tbody");
          tablaCitas.innerHTML = ''; // Limpiar tabla

          citas.forEach(cita => {
              const row = document.createElement('tr');
              row.innerHTML = `
                  <td>${cita.idcitas}</td>
                  <td>${cita.nombre}</td>
                  <td>${cita.apellido}</td>
                  <td>${cita.fecha}</td>
                  <td>${cita.hora}</td>
                  <td>${cita.servicio}</td>
                  <td>
                      <button class="btn btn-primary" onclick="editarCita(${cita.idcitas}, '${cita.nombre}', '${cita.apellido}', '${cita.fecha}', '${cita.hora}', '${cita.servicio}')">Editar</button>
                  </td>
                  <td>
                      <button class="btn btn-danger eliminar-cita" data-id="${cita.idcitas}">Eliminar</button>
                  </td>
              `;
              tablaCitas.appendChild(row);
          });

          // Agregar listeners a los botones de eliminación
          document.querySelectorAll('.eliminar-cita').forEach(boton => {
              boton.addEventListener('click', (event) => {
                  const idCita = event.target.getAttribute('idcitas');
                  eliminarCita(idCita);
              });
          });

      } else {
          console.error("Error en la respuesta del servidor:", data.error);
      }
  } catch (error) {
      console.error('Error al cargar citas:', error);
  }
}

// Llamar a cargarCitas al cargar el documento
document.addEventListener('DOMContentLoaded', () => {
  cargarCitas(); // Cargar las citas al inicio
  
});


async function eliminarCita(id) {
  const confirmar = confirm("¿Estás seguro de que deseas eliminar esta cita?");
  if (!confirmar) return;

  try {
      const response = await fetch(`../../src/routes/citaRoutes.php?id=${id}`, {
          method: 'DELETE',
      });

      if (!response.ok) {
          throw new Error(`Error: ${response.statusText}`);
      }

      const result = await response.json(); // Intentar parsear JSON

      if (result.success) {
          alert('Cita eliminada correctamente');
          cargarCitas(); // Recargar citas
      } else {
          console.error('Error en la eliminación:', result.error);
      }
  } catch (error) {
      console.error('Error al eliminar la cita:', error);
  }
}


