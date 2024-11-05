function theme() {
  const themeSwitch = document.getElementById("themeSwitch");
  if (themeSwitch) {
    themeSwitch.addEventListener("change", function () {
      if (themeSwitch.checked) {
        document.body.classList.add("dark-theme");
        document.body.classList.remove("light-theme");
        localStorage.setItem("theme", "dark");
      } else {
        document.body.classList.add("light-theme");
        document.body.classList.remove("dark-theme");
        localStorage.setItem("theme", "light");
      }
    });

    window.addEventListener("load", function () {
      const theme = localStorage.getItem("theme");
      if (theme === "dark") {
        themeSwitch.checked = true;
        document.body.classList.add("dark-theme");
        document.body.classList.remove("light-theme");
      } else {
        themeSwitch.checked = false;
        document.body.classList.add("light-theme");
        document.body.classList.remove("dark-theme");
      }
    });
  }
}

setTimeout(() => {
  var balao = document.querySelector(".balao");

  if (balao) {
    /* Frases quando não tem nenhum usuario selecionado */
    const frases = [
      {
        text: '"O primeiro dever da inteligência é desconfiar dela mesmo"',
        autor: "Albert Einstein",
      },
      {
        text: '"A vida é 10% o que acontece comigo e 90% como eu reajo a isso"',
        autor: "Charles Swindoll",
      },
      {
        text: '"O sucesso é ir de fracasso em fracasso sem perder o entusiasmo"',
        autor: "Winston Churchill",
      },
      {
        text: '"A persistência é o caminho do êxito"',
        autor: "Charles Chaplin",
      },
      {
        text: '"O único limite para a nossa realização de amanhã são as nossas dúvidas de hoje."',
        autor: "Franklin D. Roosevelt",
      },
      {
        text: '"A vida é o que acontece enquanto você está ocupado fazendo outros planos."',
        autor: "John Lennon",
      },
      {
        text: '"Se você quer viver uma vida feliz, amarre-se a uma meta, não a pessoas ou coisas."',
        autor: "Albert Einstein",
      },
      {
        text: '"Não é o mais forte que sobrevive, nem o mais inteligente, mas o que melhor se adapta às mudanças."',
        autor: "Charles Darwin",
      },
      {
        text: '"A felicidade não é algo pronto. Ela vem de suas próprias ações."',
        autor: "Dalai Lama",
      },
      {
        text: '"O futuro pertence àqueles que acreditam na beleza de seus sonhos."',
        autor: "Eleanor Roosevelt",
      },
      {
        text: '"A única maneira de fazer um ótimo trabalho é amar o que você faz."',
        autor: "Steve Jobs",
      },
      {
        text: '"Não espere. O tempo nunca será justo."',
        autor: "Napoleon Hill",
      },
      {
        text: '"A maior glória em viver não está em nunca cair, mas em se levantar cada vez que caímos."',
        autor: "Nelson Mandela",
      },
      {
        text: '"A jornada de mil milhas começa com um passo."',
        autor: "Lao Tsé",
      },
      {
        text: '"Acredite que você pode e você já está no meio do caminho."',
        autor: "Theodore Roosevelt",
      },
      {
        text: '"O sucesso geralmente vem para aqueles que estão ocupados demais para procurá-lo."',
        autor: "Henry David Thoreau",
      },
      {
        text: '"A melhor maneira de prever o futuro é criá-lo."',
        autor: "Peter Drucker",
      },
      { text: '"Confira as últimas atualizações no nosso blog."', autor: "" },
      //{ text: '"Tem alguma dúvida? Confira nossa página de Perguntas Frequentes."', autor: '' }
    ];

    const balao = document.querySelector(".balao");
    const fraseElement = document.querySelector(".frase");
    const autorElement = document.querySelector(".autor");

    function atualizarFrase() {
      var novaFrase = frases[Math.floor(Math.random() * frases.length)];
      fraseElement.textContent = novaFrase.text;
      autorElement.textContent = novaFrase.autor;
    }

    /* ultiliza aniamationstart para atualizar pela primeira vez depois só usa o animationiteration */
    balao.addEventListener("animationstart", () => {
      setTimeout(atualizarFrase, 3000); // 3 segundo após o início da animação
    });

    balao.addEventListener("animationiteration", () => {
      setTimeout(atualizarFrase, 3000); // 3 segundo após a iteração da animação
    });
  }
}, 1000);

function openModal(id) {
  var modal = document.getElementById(id);
  modal.style.display = "block";
}

function closeModal(id) {
  var modal = document.getElementById(id);
  modal.style.display = "none";
}

window.onclick = function (event) {
  var modals = document.getElementsByClassName("modal");
  for (var i = 0; i < modals.length; i++) {
    if (event.target == modals[i]) {
      modals[i].style.display = "none";
    }
  }
};

function msgScrollHeight() {
  setTimeout(() => {
    var objDiv = document.getElementById("msg");
    if (objDiv) {
      objDiv.scrollTop = objDiv.scrollHeight;
    }
  }, 1);
}

var ultimosDadosChat = null;
var ultimosDadosRecentes = null;
var ultimosDadosScroll = null;
var amigoAnt = null;

function changeUserChat(amigo_selecionado) {
  setTimeout(() => {
    updateChat();
  }, 10);
  if (amigoAnt == amigo_selecionado) {
    amigo_selecionado = "0";
  }
  $.ajax({
    url: "processaselecao.php",
    type: "GET",
    data: { amigo_selecionado: amigo_selecionado },
    success: function (response) {
      setTimeout(() => {
        loadProfile();
        updateMsg();
      }, 110);
      if (amigo_selecionado == "0") {
        amigoAnt = null;
      } else {
        amigoAnt = amigo_selecionado;
      }
    },
  });
}

function updateChat() {
  $.ajax({
    url: "ajax-fetch-chat.php",
    success: function (response) {
      $("#conteudoChat").html(response);
    },
    error: function () {
      console.error("Erro ao carregar o chat.");
    },
  });
}

function updateMsg() {
  $.ajax({
    url: "ajax_fetch_msg.php",
    success: function (data) {
      if (houveAtualizacaoChat(data)) {
        $("#msg").html(data);
        document.querySelectorAll(".msg-id").forEach((input) => {
          const msgId = input.value; // Pega o valor do input (ID da mensagem)
          console.log(msgId);

          // Verifica se a mensagem já foi marcada como lida (com base em algum critério, ex: classe)
          const messageDiv = input.closest(".msg2"); // Pega o contêiner da mensagem
          if (!messageDiv.querySelector(".visto")) {
            // Se não houver ícone de "visto"
            console.log("visto");
            
            markAsRead(msgId); // Chama a função para marcar como lida
          }
        });
        msgScrollHeight();
      }
      setTimeout(updateMsg, 500); // Aumentar o tempo de atualização para evitar sobrecarga
    },
  });
}

function markAsRead(id) {
  $.ajax({
    url: "processalido.php",
    type: "POST",
    data: {
      id: id,
    },
  });
}

function loadProfile() {
  $.ajax({
    url: "ajax_fetch_profile.php",
    success: function (data) {
      $("#profile").html(data);
    },
  });
}

function sendMessage() {
  var text = $("#text").val();
  $.post("ajax_enviar_msg.php", { text: text }, function (data) {
    $("#text").val("");
  });
}

function updateRecentes() {
  $.ajax({
    url: "ajax_fetch_recentes.php",
    success: function (data) {
      if (houveAtualizacaoRecentes(data)) {
        $("#recentes").html(data);
      }
      setTimeout(updateRecentes, 500); // Aumentar o tempo de atualização para evitar sobrecarga
    },
  });
}

function scrollButton() {
  var scrollDown = document.getElementById("scrollDown");
  var scrollMsg = document.getElementById("msg");
  setTimeout(() => {
    if (scrollMsg) {
      if (houveAtualizacaoScroll(scrollMsg.scrollTop)) {
        if (
          scrollMsg.scrollTop <= scrollMsg.scrollHeight * 0.7 &&
          scrollMsg.scrollHeight >= 2500
        ) {
          scrollDown.style.display = "block";
        } else {
          scrollDown.style.display = "none";
        }
      }
    }
    setTimeout(scrollButton, 100); // Verificação a cada 1 segundo
  }, 1);
}

// Ajax para o botão de favorito
function toggleFavorite(userId, isChecked) {
  $.ajax({
    url: "processafavorito.php",
    type: "POST",
    data: {
      id: userId,
      favorito: isChecked,
    },
    success: function (response) {
      console.log(response);
    },
  });
}

/* Fazer isso funcionar depois erro: o sistema não sabe quando tem alguma msg nova */
/* function notificacao() {
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  } else if (Notification.permission === "granted") {
    const notification = new Notification("Hi there!");
  } else if (Notification.permission !== "denied") {
    Notification.requestPermission().then((permission) => {
      if (permission === "granted") {
        const notification = new Notification("Hi there!");
      }
    });
  }
} */

function houveAtualizacaoChat(novosDados) {
  if (ultimosDadosChat != novosDados) {
    ultimosDadosChat = novosDados;
    // notificacao();
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

var sidMenu = document.getElementById("sid-menu");
function openMenu() {
  sidMenu.classList.add("open-sid-menu");
}

function closeMenu() {
  sidMenu.classList.remove("open-sid-menu");
}

/* Iniciar Funções */
changeUserChat(); // troca de usuario/conversa
scrollButton(); //inicia a verificação do botao de scroll para aparecer no mobile
updateMsg(); // Inicia a atualização das msg
loadProfile(); // atualiza o perfil do usuario
updateRecentes(); // Inicia a atualização do usuarios recentes
msgScrollHeight(); // Define que a barra de rolagem vai estar no fim do chat
theme(); // Define qual tema sera exibido claro ou escuro
