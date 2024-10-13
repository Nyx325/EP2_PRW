import "../components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", async () => {
  const responseJson = await fetch("../../src/config/session.php");
  const response = JSON.parse(await responseJson.text());
  console.log(response);

  if (response.status !== "success")
    document.location.href = "../views/login.html";

  const nav = document.getElementById("user-options");
  const insertServiceLink = document.createElement("a");
  const insertServiceImg = document.createElement("img");
  insertServiceImg.setAttribute("src", "../assets/icon/c.png");

  insertServiceLink.appendChild(insertServiceImg);
  nav.appendChild(insertServiceLink);

  // todo lo demás del crud sin el insert xd
  const cudServiceLink = document.createElement("a");
  const cudServiceImg = document.createElement("img");
  cudServiceImg.setAttribute("src", "../assets/icon/");
});
