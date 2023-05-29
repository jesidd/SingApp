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

    #message-traduccion {
      margin: auto;
      background-image: url('./img/bk.jpg');
      background-size: 100%;
      margin-bottom: 10px;
      border-radius: 10px;
      height: 200px;
      width: 25%;
    }

    #message-container {
      background-color: #fff;
      box-shadow: .5rem .2rem .5rem .5rem rgba(0, 0, 0, .1);
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

    .botones{
      background-color: #fff;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      flex-wrap: nowrap;
      gap: 10px;
    }

    .btn-action{
      margin-top: 1.5rem;
    margin-left:1.5rem;
    padding: .5rem;
    padding-left: 1rem;
    border: 2px solid black;
    border-radius: 1.5rem;
    box-shadow: var(--box-shadow);
    color: var(--light-color);
    cursor: pointer;
    font-size: 1.6rem;
    text-decoration: none;
    }
    .btn-action:hover{
      background: var(--green);
    color: #fff;
    scale: 1.20;
    box-shadow: var(--box-shadow);
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
    <div id="chat-header"></div>
    <div id="message-traduccion"></div>
    <div id="message-container"></div>
    <div class="botones">
      <button class="btn-action" id="record-button">Grabar</button>
      <button class="btn-action" id="stop-button" disabled>Detener</button>
      <button class="btn-action" id="play-button">Enviar</button>
    </div>
    <p  id="recording-status" style="display: none; text-align: center; margin-top: 10px; color: red;">Grabando audio...</p>
    <p  id="stopped-status" style="display: none; text-align: center; margin-top: 10px; color: green;">Audio detenido.</p>
  </div>

  <script>
    const recordButton = document.getElementById("record-button");
    const stopButton = document.getElementById("stop-button");
    const playButton = document.getElementById("play-button");
    const recordingStatus = document.getElementById("recording-status");
    const stoppedStatus = document.getElementById("stopped-status");
    const messageContainer = document.getElementById("message-container");
    const chunks = [];

    let mediaRecorder;

    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    playButton.addEventListener("click", playRecording);

    function startRecording() {
      navigator.mediaDevices.getUserMedia({ audio: true })
        .then(function (stream) {
          mediaRecorder = new MediaRecorder(stream);
          mediaRecorder.start();
          recordingStatus.style.display = "block";
          recordButton.disabled = true;
          stopButton.disabled = false;
          playButton.disabled = true;
          chunks.length = 0;

          mediaRecorder.addEventListener("dataavailable", function (e) {
            chunks.push(e.data);
          });
        })
        .catch(function (err) {
          console.log("Error al acceder al micrófono:", err);
        });
    }

    function stopRecording() {
      mediaRecorder.stop();
      recordingStatus.style.display = "none";
      stoppedStatus.style.display = "block";
      recordButton.disabled = false;
      stopButton.disabled = true;
      playButton.disabled = false;
    }

    function playRecording() {
      const blob = new Blob(chunks, { type: "audio/webm" });
      const audioUrl = URL.createObjectURL(blob);
      const audio = new Audio(audioUrl);
      audio.play();
      addMessage(audioUrl, "sent");
    }

    function addMessage(message, sender) {
      const messageElement = document.createElement("div");
      messageElement.classList.add("message", sender);
      messageElement.innerHTML = `
        <audio controls src="${message}"></audio>
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



