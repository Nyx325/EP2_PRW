import "../components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("cu-cita-modal");
    const modalTitle = document.getElementById("modal-title");
    const volverBtn = document.getElementById("volver-btn");
    const agregarBtn = document.getElementById("agregar-cita");
    const btnAceptar = document.getElementById("aceptar-btn");
    const clienteInput = document.getElementById("cita-cliente");
    const servicioInput = document.getElementById("cita-servicio");
    const fechaInput = document.getElementById("cita-fecha");

    agregarBtn.addEventListener("click", () => {
        modalTitle.textContent = "Agregar Cita";
        modal.style.display = "block";
        modal.setAttribute("operation", "add");
        modal.setAttribute("cita-id", 0);
    });

    volverBtn.addEventListener("click", () => {
        modal.style.display = "none";
        clienteInput.value = "";
        servicioInput.value = "";
        fechaInput.value = "";
    });

    btnAceptar.addEventListener("click", () => {
        const operation = modal.getAttribute("operation");
        const cita = {
            id: modal.getAttribute("cita-id"),
            cliente: clienteInput.value.trim(),
            servicio: servicioInput.value.trim(),
            fecha: fechaInput.value.trim(),
        };

        switch (operation) {
            case "add":
                agregarCita(cita).then();
                printTable().then();
                break;

            case "modify":
                modificarCita(cita).then();
                printTable().then();
                break;

            default:
                console.error(`Operación no válida: ${operation}`);
                break;
        }
    });

    printTable().then();
});

const createModifyBtn = (citaId) => {
    const modal = document.getElementById("cu-cita-modal");
    const modalTitle = document.getElementById("modal-title");
    const modifyBtn = document.createElement("button");

    modifyBtn.innerText = "Modificar";
    modifyBtn.setAttribute("key", citaId);
    modifyBtn.classList.add("btn", "btn-primary");

    modifyBtn.addEventListener("click", async () => {
        modal.setAttribute("operation", "modify");
        modalTitle.textContent = "Modificar Cita";
        modal.style.display = "block";
        modal.setAttribute("cita-id", citaId);

        const resJSON = await fetch(`../../src/routes/citaRoutes.php?id=${citaId}`);
        const res = JSON.parse(await resJSON.text());

        if (res.success === false) {
            console.error(res.error.message ?? res.error);
            return;
        }

        const cita = res.data[0];
        clienteInput.value = cita.cliente;
        servicioInput.value = cita.servicio;
        fechaInput.value = cita.fecha;
    });

    return modifyBtn;
};

const createDeleteBtn = (citaId) => {
    const deleteBtn = document.createElement("button");
    deleteBtn.innerText = "Eliminar";
    deleteBtn.setAttribute("key", citaId);
    deleteBtn.classList.add("btn", "btn-danger");

    deleteBtn.addEventListener("click", async () => {
        const resJSON = await fetch(`../../src/routes/citaRoutes.php?id=${citaId}`, {
            method: "DELETE",
        });
        const res = JSON.parse(await resJSON.text());
        if (res.success === true) {
            printTable();
        } else {
            console.error(res);
        }
    });

    return deleteBtn;
};

const printTable = async () => {
    const container = document.getElementById("table-container");
    container.innerHTML = "";
    const resJSON = await fetch("../../src/routes/citaRoutes.php");
    const res = JSON.parse(await resJSON.text());
    if (res.success === false) {
        console.error(res.error.message ?? res.error);
        return;
    }

    const table = document.createElement("table");
    table.classList.add("table", "table-bordered");
    table.innerHTML = `
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
    `;

    const tbody = document.createElement("tbody");

    res.data.forEach((cita) => {
        const row = document.createElement("tr");

        const idCell = document.createElement("td");
        idCell.textContent = cita.id;
        row.appendChild(idCell);

        const clienteCell = document.createElement("td");
        clienteCell.textContent = cita.cliente;
        row.appendChild(clienteCell);

        const servicioCell = document.createElement("td");
        servicioCell.textContent = cita.servicio;
        row.appendChild(servicioCell);

        const fechaCell = document.createElement("td");
        fechaCell.textContent = cita.fecha;
        row.appendChild(fechaCell);

        const actionCell = document.createElement("td");
        row.appendChild(actionCell);

        const modifyBtn = createModifyBtn(cita.id);
        const deleteBtn = createDeleteBtn(cita.id);

        actionCell.appendChild(modifyBtn);
        actionCell.appendChild(deleteBtn);

        tbody.appendChild(row);
    });

    table.appendChild(tbody);
    container.appendChild(table);
};

const agregarCita = async (cita) => {
    const modal = document.getElementById("cu-cita-modal");
    const alert = document.getElementById("modal-alert");
    const clienteInput = document.getElementById("cita-cliente");
    const servicioInput = document.getElementById("cita-servicio");
    const fechaInput = document.getElementById("cita-fecha");

    if (cita.cliente === "") {
        clienteInput.focus();
        return;
    }

    if (cita.servicio === "") {
        servicioInput.focus();
        return;
    }

    if (cita.fecha === "") {
        fechaInput.focus();
        return;
    }

    const responseJSON = await fetch("../../src/routes/citaRoutes.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ cita }),
    });

    const res = await responseJSON.json();

    if (res.success === false) {
        alert.classList.remove("d-none");
        alert.innerText = res.error.message ?? res.error;
    } else {
        modal.style.display = "none";
        alert.classList.add("d-none");
        clienteInput.value = "";
        servicioInput.value = "";
        fechaInput.value = "";
    }
};

const modificarCita = async (cita) => {
    const modal = document.getElementById("cu-cita-modal");
    const alert = document.getElementById("modal-alert");
    const clienteInput = document.getElementById("cita-cliente");
    const servicioInput = document.getElementById("cita-servicio");
    const fechaInput = document.getElementById("cita-fecha");

    if (cita.cliente === "") {
        clienteInput.focus();
        return;
    }

    if (cita.servicio === "") {
        servicioInput.focus();
        return;
    }

    if (cita.fecha === "") {
        fechaInput.focus();
        return;
    }

    const responseJSON = await fetch("../../src/routes/citaRoutes.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ cita }),
    });

    const res = await responseJSON.json();

    if (res.success === false) {
        alert.classList.remove("d-none");
        alert.innerText = res.error.message ?? res.error;
    } else {
        modal.style.display ="none";
        alert.classList.add("d-none");
        clienteInput.value = "";
        servicioInput.value = "";
        fechaInput.value = "";
    }
};
  // Cargar servicios al iniciar
  async function cargarServicios() {
      const responseJSON = await fetch("../../src/routes/serviceRoutes.php?method=GET");
      const res = await responseJSON.json();
      
      if (res.success) {
          res.data.forEach(servicio => {
              const option = document.createElement("option");
              option.value = servicio.id; // Asegúrate de que el ID esté disponible
              option.textContent = servicio.servicio; // Asegúrate de que el nombre del servicio esté disponible
              servicioInput.appendChild(option);
          });
      } else {
          console.error("Error al cargar servicios:", res.error);
      }
  }

  // Llama a cargarServicios al cargar la página
  cargarServicios();

 
