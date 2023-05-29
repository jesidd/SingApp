<?php
session_start();
if (!isset($_SESSION['CORREO']) || $_SESSION['ROL'] != 2) {
  header('location: ../vista/sesion.php');
  
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chat</title>
  <link rel="stylesheet" href="css/admin.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 

<style>




#chat-container {
  padding: 20px;
}



#chat-header h2 {
  margin: 0;
}

#message-traduccion{
  margin: auto;
  background-image: url('./img/bk.jpg');
  background-size: 100%;
  margin-bottom: 10px;
  
  border-radius: 10px;
  height: 200px;
  width: 25%;
}

#message-container {
  background-color:#fff;
  box-shadow:  .5rem .2rem .5rem .5rem rgba(0,0,0, .1);
  border-radius: 10px;
  height: 300px;
  overflow-y: scroll;
  width: 80%;
  margin: auto;
  margin-bottom: 10px;
}

.message {
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 10px;
}

.received {
  background-color: #eee;
  align-self: flex-start;
}

.sent {
  background-color: #b5bcfd;
  align-self: flex-end;
}

.timestamp {
  font-size: 0.8em;
  color: #777;
}

#message-input-container {
  display: flex;
  align-items: center;
  margin-top: 20px;
  width: 80%;
  margin: auto;
  background-color: #b5bcfd;
  
  border-radius: 10px;
}

#message-input {
  flex-grow: 1;
  padding: 10px;
  background: local;
}

#send-button {
  padding: 10px;
}



</style>




</head>
<body>
  <!--NAV---------------------------------------------->
  <header class="header">

    <a href="../index.html" class="logo">SignApp</a>
    <nav class="navbar">
      <a href="./inicio.php"><i class="fa-solid fa-house"></i> Inicio</a>
      <a href="#services"><i class="fa-solid fa-bell"></i> Notificaciones</a>

    </nav>
    <div class="dropdown">
      <a class="btn_action" data-bs-toggle="dropdown">
        <span class="nombreusuario" class="active">
          <?php echo $_SESSION['NOMBRE_USUARIO'] ?>
        </span>
      </a>

      <ul class="dropdown-menu">
        <li><a class="dropdown-item  a" href=""><i class="fa-solid fa-house"></i> INICIO</a></li>
        <li><a class="dropdown-item  b" href=""><i class="fa-solid fa-bell"></i> NOTIFICACIONES</a></li>
        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-envelope"></i> MENSAJES</a></li>
        <li><a class="dropdown-item" href="#logoutModal" data-toggle="modal" data-target="#logoutModal"><i
              class="fa-solid fa-right-from-bracket"></i> CERRAR SESION</a></li>
      </ul>
    </div>
  </header>


  <div id="chat-container">
    <div id="chat-header">
    </div>
    <div id="message-traduccion"></div>
    <div id="message-container"></div>
    <div id="message-input-container">
      <input type="text" id="message-input" placeholder="Escribe un mensaje...">
      <button id="send-button">Enviar</button>
    </div>
  </div>

 

  <script>
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");

sendButton.addEventListener("click", function() {
  const message = messageInput.value;
  if (message) {
    addMessage(message, "sent");
    messageInput.value = "";
  }
});

function addMessage(message, sender) {
  const messageContainer = document.getElementById("message-container");
  const messageElement = document.createElement("div");
  messageElement.classList.add("message", sender);
  messageElement.innerHTML = `
    <p>${message}</p>
    <span class="timestamp">${getCurrentTime()}</span>
  `;
  messageContainer.appendChild(messageElement);
  messageContainer.scrollTop = messageContainer.scrollHeight;
}

function getCurrentTime() {
  const now = new Date();
  let hours = now.getHours();
  let minutes = now.getMinutes();
  const ampm = hours >= 12 ? 'PM' : 'AM';
  hours %= 12;
  hours = hours || 12;
  minutes = minutes < 10 ? '0' + minutes : minutes;
  return `${hours}:${minutes} ${ampm}`;
}

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>
</html>





