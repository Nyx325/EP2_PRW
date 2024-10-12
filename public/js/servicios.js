document.addEventListener("DOMContentLoaded", async () => {
  const responseJSON = await fetch("../../src/routes/serviceRoutes.php");
  console.log(responseJSON);
  const responseText = await responseJSON.text();
  console.log(responseText);
  const response = JSON.parse(responseText);
  console.log(response);
});
