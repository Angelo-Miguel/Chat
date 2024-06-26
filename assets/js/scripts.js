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
var ultimosDadosChat = null;
var ultimosDadosRecentes = null;
var ultimosDadosScroll = null;

function updateChat() {
  $.ajax({
    url: 'ajax_fetch_msg.php',
    success: function (data) {
      // Verifica se houve uma mudança nos dados recebidos
      if (houveAtualizacaoChat(data)) {
        $('#msg').html(data); // Atualiza o conteúdo do chat
        msgScrollHeight(); // Chama a função para ajustar a altura da mensagem
      }
      setTimeout(updateChat, 100); // Agende a próxima atualização
    }
  });
}

/* AJAX ao mandar msg */
function sendMessage() {
  var text = $('#text').val();
  $.post('ajax_enviar_msg.php', { text: text }, function (data) {
    $('#text').val('');
  });
}

function updateRecentes() {
  $.ajax({
    url: 'ajax_fetch_recentes.php',
    success: function (data) {
      if (houveAtualizacaoRecentes(data)) {
        // Verifica se houve uma mudança nos dados recebidos
        $('#recentes').html(data); // Atualiza o conteúdo do chat
      }
      setTimeout(updateRecentes, 100); // Agende a próxima atualização
    }
  });
}

/* Mostrar ou esconde o botão de scroll quando o scroll bar estiver muito alta */
function scrollButton() {
  $.ajax({
    success: function (data) {
      setTimeout(() => {
        var scrollMsg = document.getElementById("msg");
        var scrollDown = document.getElementById("scrollDown");
        //console.log(scrollMsg.scrollTop);
        if (houveAtualizacaoScroll(scrollMsg.scrollTop)) {
          if (scrollMsg.scrollTop <= scrollMsg.scrollHeight * 0.7 && scrollMsg.scrollTop >= 2500) {
            scrollDown.style.display = "block";
          } else {
            scrollDown.style.display = "none";
          }
        }
      }, 1);
      setTimeout(scrollButton, 1);
    }
  });
}

// Função para verificar se houve uma atualização nos dados recebidos
function houveAtualizacaoChat(novosDados) {
  if (ultimosDadosChat != novosDados) {
    ultimosDadosChat = novosDados;
    return true;
  }
  return false;
}

function houveAtualizacaoScroll(novosDados) {
  if (ultimosDadosScroll != novosDados) {
    ultimosDadosScroll = novosDados;
    return true;
  }
  return false;
}

function houveAtualizacaoRecentes(novosDados) {
  if (ultimosDadosRecentes != novosDados) {
    ultimosDadosRecentes = novosDados;
    return true;
  }
  return false;
}

/* Abir ou Fechar o menu lateral para mobile */
var sidMenu = document.getElementById("sid-menu");
function openMenu() {
  sidMenu.classList.add("open-sid-menu");
}

function closeMenu() {
  sidMenu.classList.remove("open-sid-menu");
}

/* Iniciar Funções */
scrollButton(); //inicia a verificação do botao de scroll
updateChat(); // Inicia a atualização do chat
updateRecentes(); // Inicia a atualização de conversas recentes
msgScrollHeight(); // Define que a barra de rolagem vai estar no fim