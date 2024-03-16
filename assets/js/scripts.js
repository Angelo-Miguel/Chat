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


/* 
OUTRA OPÇAO PARA ABRI O MENU
document.getElementById("open-modal").addEventListener("click", function () {
  document.getElementById("myModal").style.display = "block";
});

document.querySelector(".close").addEventListener("click", function () {
  document.getElementById("myModal").style.display = "none";
});

window.addEventListener("click", function (event) {
  if (event.target == document.getElementById("myModal")) {
    document.getElementById("myModal").style.display = "none";
  }
}); */
