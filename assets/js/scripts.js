/* Modal amigos */
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal.style.display = "block";
}
span.onclick = function () {
  modal.style.display = "none";
}
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

/* Coloca a barra de scroll da div msg para baixo */
var objDiv = document.getElementById("msg");
objDiv.scrollTop = objDiv.scrollHeight;