import "../components/dinamicContent.js";
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("cu-service-modal");
  const modalTitle = document.getElementById("modal-title");
  const volverBtn = document.getElementById("volver-btn");
  const agregarBtn = document.getElementById("agregar-servicio");
  const btnAceptar = document.getElementById("aceptar-btn");
  const nombreServicioInput = document.getElementById("service-name");
  const precioServicioInput = document.getElementById("service-price");

  agregarBtn.addEventListener("click", () => {
    modalTitle.textContent = "Agregar servicio";
    modal.style.display = "block";
    modal.setAttribute("operation", "add");
    modal.setAttribute("service-id", 0);
  });

  volverBtn.addEventListener("click", () => {
    modal.style.display = "none";
    nombreServicioInput.value = "";
    precioServicioInput.value = "";
  });

  btnAceptar.addEventListener("click", () => {
    const operation = modal.getAttribute("operation");
    const servicio = {
      id: modal.getAttribute("service-id"),
      servicio: nombreServicioInput.value.trim(),
      precio: precioServicioInput.value.trim(),
    };

    switch (operation) {
      case "add":
        agregarServicio(servicio).then();
        console.log("Fin metodo agregar");
        printTable().then();
        break;

      case "modify":
        user.id = console.log("Modificando");
        break;

      default:
        console.error(`invalid operation ${operation}`);
        break;
    }
  });

  printTable().then();
});

const createModifyBtn = (serviceId) => {
  const modal = document.getElementById("cu-service-modal");
  const modalTitle = document.getElementById("modal-title");
  const modifyBtn = document.createElement("button");
  const nombreInput = document.getElementById("service-name");
  const precioInput = document.getElementById("service-price");

  modifyBtn.innerText = "Modificar";
  modifyBtn.setAttribute("key", serviceId);
  modifyBtn.classList.add("btn");
  modifyBtn.classList.add("btn-primary");

  modifyBtn.addEventListener("click", async () => {
    modal.setAttribute("operation", "modify");
    modalTitle.textContent = "Modificar servicio";
    modal.style.display = "block";
    modal.setAttribute("service-id", serviceId);

    const resJSON = await fetch(
      `../../src/routes/serviceRoutes.php?id=${serviceId}`,
    );
    const res = JSON.parse(await resJSON.text());

    if (res.success === false) {
      console.error(res.error.message ?? res.error);
      return;
    }

    const servicio = res.data[0];
    console.log(servicio);
    nombreInput.value = servicio.servicio;
    precioInput.value = servicio.precio;
    /*
    const resJSON = await fetch("../../src/routes/serviceRoutes.php", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id: serviceId,
        servicio: "si",
        precio: 13.3,
      }),
    });

    const res = await JSON.parse(await resJSON.text());
    if (res.success === true) {
      printTable();
    } else {
      console.error(res);
    }
    */
  });

  return modifyBtn;
};

const createDeleteBtn = (serviceId) => {
  const deleteBtn = document.createElement("button");
  deleteBtn.innerText = "Eliminar";
  deleteBtn.setAttribute("key", serviceId);
  deleteBtn.classList.add("btn");
  deleteBtn.classList.add("btn-danger");

  deleteBtn.addEventListener("click", async () => {
    const resJSON = await fetch(
      `../../src/routes/serviceRoutes.php?id=${serviceId}`,
      {
        method: "DELETE",
      },
    );
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
  const resJSON = await fetch("../../src/routes/serviceRoutes.php");
  const res = JSON.parse(await resJSON.text());
  if (res.success === false) {
    console.error(res.error.message ?? res.error);
    return;
  }

  const table = document.createElement("table");
  table.classList.add("table");
  table.classList.add("table-bordered");
  table.innerHTML = `
        <thead>
          <tr>
            <th>ID</th>
            <th>Servicio</th>
            <th>Precio</th>
          </tr>
        </thead>
      `;

  const tbody = document.createElement("tbody");

  res.data.forEach((servicio) => {
    const row = document.createElement("tr");

    const idCell = document.createElement("td");
    idCell.textContent = servicio.id;
    row.appendChild(idCell);

    const servicioCell = document.createElement("td");
    servicioCell.textContent = servicio.servicio;
    row.appendChild(servicioCell);

    const precioCell = document.createElement("td");
    precioCell.textContent = servicio.precio;
    row.appendChild(precioCell);

    const actionCell = document.createElement("td");
    row.appendChild(actionCell);

    const modifyBtn = createModifyBtn(servicio.id);
    const deleteBtn = createDeleteBtn(servicio.id);

    actionCell.appendChild(modifyBtn);
    actionCell.appendChild(deleteBtn);

    tbody.appendChild(row);
  });

  table.appendChild(tbody);
  container.appendChild(table);
};

const configForm = async () => {
  const alert = document.getElementById("modal-alert");
  const nombreInput = document.getElementById("service-name");
  const precioInput = document.getElementById("service-price");
  const btnAceptar = document.getElementById("aceptar-btn");

  btnAceptar.addEventListener("click", async () => {
    const servicio = {
      servicio: nombreInput.value,
      precio: precioInput.value,
    };

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
};

const agregarServicio = async (servicio) => {
  const modal = document.getElementById("cu-service-modal");
  const alert = document.getElementById("modal-alert");
  const nombreInput = document.getElementById("service-name");
  const precioInput = document.getElementById("service-price");

  console.log("Agregando");

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

  console.log(responseJSON);
  const resText = await responseJSON.text();
  console.log(resText);
  const res = JSON.parse(resText);

  if (res.success === false) {
    console.error(res);
    alert.classList.remove("d-none");
    alert.innerText = res.error.message ?? res.error;
  } else {
    modal.style.display = "none";
    alert.classList.add("d-none");
    precioInput.value = "";
    nombreInput.value = "";
  }
};
