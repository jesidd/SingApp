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

    video{
      height: auto;
      width: 100%;
      border-radius: 25px;
    }
    #chat-container {
      padding: 20px;
    }
    #chat-header h2 {
      margin: 0;
    }
    #message-traduccion {
      margin: auto;
      
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
      margin-top: 50px;
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
      <a href="#"><i class="fa-solid fa-house"></i> Inicio</a>
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
    <div class="botones">
      <button class="btn-action" id="start-camera-button">Iniciar cámara</button>
      <button class="btn-action" id="stop-camera-button" >Detener cámara</button>
    </div>
  </div>

  <script>
    let videoStream;

    // Acceder a la cámara y mostrar el video en el div
    function iniciarCamara() {
      const constraints = { video: true };

      const video = document.createElement('video');
      video.autoplay = true;

      navigator.mediaDevices.getUserMedia(constraints)
        .then(stream => {
          video.srcObject = stream;
          document.getElementById('message-traduccion').appendChild(video);
          videoStream = stream;
        })
        .catch(error => {
          console.error('Error al acceder a la cámara:', error);
        });
    }

    // Detener la cámara y eliminar el video del div
    function detenerCamara() {
      if (videoStream) {
        const videoTracks = videoStream.getVideoTracks();
        videoTracks.forEach(track => track.stop());
        videoStream = null;

        const videoElement = document.querySelector('video');
        if (videoElement) {
          videoElement.remove();
        }
      }
    }

    // Solicitar permiso y encender la cámara
    function solicitarPermisoCamara() {
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
          .then(() => {
            iniciarCamara();
          })
          .catch(error => {
            console.error('Permiso denegado para acceder a la cámara:', error);
          });
      } else {
        console.error('La API getUserMedia no está disponible en este navegador.');
      }
    }

    // Manejador de eventos para el botón "Iniciar cámara"
    document.getElementById('start-camera-button').addEventListener('click', () => {
      solicitarPermisoCamara();
    });

    // Manejador de eventos para el botón "Detener cámara"
    document.getElementById('stop-camera-button').addEventListener('click', () => {
      detenerCamara();
    });
  </script>
</body>
</html>






