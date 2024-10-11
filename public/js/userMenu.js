import "../components/dinamicContent.js";

document.addEventListener("DOMContentLoaded", async () => {
  const responseJson = await fetch("../../src/config/session.php");
  const response = JSON.parse(await responseJson.text());
  console.log(response);

  if (response.status !== "success")
    document.location.href = "../views/login.html";

  const nav = document.getElementById("user-options");
  const insertLink = document.createElement("a");
});
