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
window.onclick = function (event) {
  var modals = document.getElementsByClassName('modal');
  for (var i = 0; i < modals.length; i++) {
    if (event.target == modals[i]) {
      modals[i].style.display = "none";
    }
  }
}

/* Coloca a barra de scroll da div msg para baixo */
function msgScrollHeight() {
  setTimeout(() => {
    var objDiv = document.getElementById("msg");
    objDiv.scrollTop = objDiv.scrollHeight;
  }, 1);
}

/* Ajax para atualizar o chat em tempo real */
var ultimosDados = null;

function updateChat() {
  $.ajax({
    url: 'ajax_fetch_msg.php',
    success: function (data) {
      // Verifica se houve uma mudança nos dados recebidos
      if (houveAtualizacao(data)) {
        msgScrollHeight(); // Chama a função para ajustar a altura da mensagem
        $('#msg').html(data); // Atualiza o conteúdo do chat
      }
      setTimeout(updateChat, 1000); // Agende a próxima atualização
    }
  });
}

// Função para verificar se houve uma atualização nos dados recebidos
function houveAtualizacao(novosDados) {
  if (!ultimosDados) {
    ultimosDados = novosDados;
    return true;
  }

  if (novosDados !== ultimosDados) {
    ultimosDados = novosDados;
    return true; 
  }

  return false; 
}

function sendMessage() {
  var text = $('#text').val();
  $.post('ajax_enviar_msg.php', { text: text }, function (data) {
    $('#text').val('');
  });
  setInterval(() => {
    msgScrollHeight();
  }, 100);
}

var sidMenu = document.getElementById("sid-menu");
function openMenu() {
  sidMenu.classList.add("open-sid-menu");
}

function closeMenu() {
  sidMenu.classList.remove("open-sid-menu");
}

updateChat(); // Inicia a atualização do chat
msgScrollHeight(); // Define que a barra de rolagem vai estar no fim