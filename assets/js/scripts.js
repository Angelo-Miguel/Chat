/* Modal amigos */
// Função para abrir o modal com o ID especificado
function openModal(id) {
  var modal = document.getElementById(id);
  modal.style.display = "block";
}

// Função para fechar o modal com o ID especificado
function closeModal(id) {
  var modal = document.getElementById(id);
  modal.style.display = "none";
}

// Fechar o modal quando clicar fora dele
window.onclick = function(event) {
  var modals = document.getElementsByClassName('modal');
  for (var i = 0; i < modals.length; i++) {
      if (event.target == modals[i]) {
          modals[i].style.display = "none";
      }
  }
}





/* Coloca a barra de scroll da div msg para baixo */
var objDiv = document.getElementById("msg");
objDiv.scrollTop = objDiv.scrollHeight;