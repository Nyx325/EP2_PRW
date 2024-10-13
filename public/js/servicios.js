import "../components/dinamicContent.js";

const printTable = async () => {
  const main = document.getElementsByTagName("main")[0];
  main.innerHTML = "";
  const resJSON = await fetch("../../src/routes/serviceRoutes.php");
  const res = JSON.parse(await resJSON.text());

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

    const modifyBtn = document.createElement("button");
    modifyBtn.innerText = "Modificar";
    modifyBtn.setAttribute("key", servicio.id);
    modifyBtn.classList.add("btn");
    modifyBtn.classList.add("btn-primary");
    modifyBtn.addEventListener("click", async () => {
      console.log("Modificar elemento de id: " + modifyBtn.getAttribute("key"));
      const resJSON = await fetch("../../src/routes/serviceRoutes.php", {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          id: modifyBtn.getAttribute("key"),
          servicio: "si",
          precio: 13.3,
        }),
      });

      const res = await JSON.parse(await resJSON.text());
      if (res.success === true) {
        console.log("To ok");
        printTable();
      } else {
        console.error(res);
      }
    });

    const deleteBtn = document.createElement("button");
    deleteBtn.innerText = "Eliminar";
    deleteBtn.setAttribute("key", servicio.id);
    deleteBtn.classList.add("btn");
    deleteBtn.classList.add("btn-danger");
    deleteBtn.addEventListener("click", async () => {
      const id = modifyBtn.getAttribute("key");
      const resJSON = await fetch(
        `../../src/routes/serviceRoutes.php?id=${id}`,
        {
          method: "DELETE",
        },
      );
      const res = JSON.parse(await resJSON.text());
      if (res.success === true) {
        console.log(res);
        printTable();
      } else {
        console.error(res);
      }
    });

    actionCell.appendChild(modifyBtn);
    actionCell.appendChild(deleteBtn);

    tbody.appendChild(row);
  });

  table.appendChild(tbody);
  main.appendChild(table);
};

document.addEventListener("DOMContentLoaded", () => {
  printTable().then();
});
