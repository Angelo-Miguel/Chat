function theme() {
  const themeSwitch = document.getElementById('themeSwitch');

  themeSwitch.addEventListener('change', function () {
    if (themeSwitch.checked) {
      document.body.classList.add('dark-theme');
      document.body.classList.remove('light-theme');
      // Salvar a preferência de tema no localStorage
      localStorage.setItem('theme', 'dark');
    } else {
      document.body.classList.add('light-theme');
      document.body.classList.remove('dark-theme');
      // Salvar a preferência de tema no localStorage
      localStorage.setItem('theme', 'light');
    }
  });

  // Carregar a preferência de tema do localStorage
  window.addEventListener('load', function () {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
      themeSwitch.checked = true;
      document.body.classList.add('dark-theme');
      document.body.classList.remove('light-theme');
    } else {
      themeSwitch.checked = false;
      document.body.classList.add('light-theme');
      document.body.classList.remove('dark-theme');
    }
  });
}



const balao = document.querySelector('.balao');
if (balao) {
  /* Frases quando não tem nenhum usuario selecionado */
  const frases = [
    { text: '"O primeiro dever da inteligência é desconfiar dela mesmo"', autor: 'Albert Einstein' },
    { text: '"A vida é 10% o que acontece comigo e 90% como eu reajo a isso"', autor: 'Charles Swindoll' },
    { text: '"O sucesso é ir de fracasso em fracasso sem perder o entusiasmo"', autor: 'Winston Churchill' },
    { text: '"A persistência é o caminho do êxito"', autor: 'Charles Chaplin' },
    { text: '"O único limite para a nossa realização de amanhã são as nossas dúvidas de hoje."', autor: 'Franklin D. Roosevelt' },
    { text: '"A vida é o que acontece enquanto você está ocupado fazendo outros planos."', autor: 'John Lennon' },
    { text: '"Se você quer viver uma vida feliz, amarre-se a uma meta, não a pessoas ou coisas."', autor: 'Albert Einstein' },
    { text: '"Não é o mais forte que sobrevive, nem o mais inteligente, mas o que melhor se adapta às mudanças."', autor: 'Charles Darwin' },
    { text: '"A felicidade não é algo pronto. Ela vem de suas próprias ações."', autor: 'Dalai Lama' },
    { text: '"O futuro pertence àqueles que acreditam na beleza de seus sonhos."', autor: 'Eleanor Roosevelt' },
    { text: '"A única maneira de fazer um ótimo trabalho é amar o que você faz."', autor: 'Steve Jobs' },
    { text: '"Não espere. O tempo nunca será justo."', autor: 'Napoleon Hill' },
    { text: '"A maior glória em viver não está em nunca cair, mas em se levantar cada vez que caímos."', autor: 'Nelson Mandela' },
    { text: '"A jornada de mil milhas começa com um passo."', autor: 'Lao Tsé' },
    { text: '"Acredite que você pode e você já está no meio do caminho."', autor: 'Theodore Roosevelt' },
    { text: '"O sucesso geralmente vem para aqueles que estão ocupados demais para procurá-lo."', autor: 'Henry David Thoreau' },
    { text: '"A melhor maneira de prever o futuro é criá-lo."', autor: 'Peter Drucker' },

    { text: '"Confira as últimas atualizações no nosso blog."', autor: '' },
    { text: '"Tem alguma dúvida? Confira nossa página de Perguntas Frequentes."', autor: '' },
    { text: '"Confira as últimas atualizações no nosso blog."', autor: '' },
    //{ text: '"Tem alguma dúvida? Confira nossa página de Perguntas Frequentes."', autor: '' }
  ];

  const balao = document.querySelector('.balao');
  const fraseElement = document.querySelector('.frase');
  const autorElement = document.querySelector('.autor');

  function getFraseAleatoria() {
    const randomIndex = Math.floor(Math.random() * frases.length);
    return frases[randomIndex];
  }

  function atualizarFrase() {
    const novaFrase = getFraseAleatoria();
    fraseElement.textContent = novaFrase.text;
    autorElement.textContent = novaFrase.autor;
  }

  /* ultiliza aniamationstart para atualizar pela primeira vez depois só usa o animationiteration */
  balao.addEventListener('animationstart', () => {
    setTimeout(atualizarFrase, 3000); // 3 segundo após o início da animação
  });

  balao.addEventListener('animationiteration', () => {
    setTimeout(atualizarFrase, 3000); // 3 segundo após a iteração da animação
  });
}

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
    if (objDiv) {
      objDiv.scrollTop = objDiv.scrollHeight;
    }
  }, 1);
}

/* Ajax para atualizar o chat em tempo real */
var ultimosDadosChat = null;
var ultimosDadosRecentes = null;
var ultimosDadosScroll = null;

//
function changeUserChat(amigo_selecionado) { 
  $.ajax({
    url: 'processaselecao.php',
    type: 'GET',
    data: { amigo_selecionado: amigo_selecionado },
    success: function (response) {
      loadProfile()
    },
  });
}


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

function loadProfile() {
  $.ajax({
      url: 'ajax_fetch_profile.php',
      success: function(data) {
          $('#profile').html(data);
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
        if (scrollMsg) {
          var scrollDown = document.getElementById("scrollDown");
          if (houveAtualizacaoScroll(scrollMsg.scrollTop)) {
            if (scrollMsg.scrollTop <= scrollMsg.scrollHeight * 0.7 && scrollMsg.scrollTop >= 2500) {
              scrollDown.style.display = "block";
            } else {
              scrollDown.style.display = "none";
            }
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
loadProfile(); // atualiza o perfil do usuario
updateRecentes(); // Inicia a atualização de conversas recentes
msgScrollHeight(); // Define que a wbarra de rolagem vai estar no fim
theme(); // Define qual tema Ligth 