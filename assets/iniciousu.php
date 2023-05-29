 <?php
       
  session_start();
  if (!isset($_SESSION['CORREO']) || $_SESSION['ROL'] != 2) {
  header('location: ../vista/sesion.php');
  
}
        
?> 

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <link rel="icon" href="img/logo.png">
  <title>Inicio</title>





</head>

<body>

   <!--NAV---------------------------------------------->
   <header class="header">

    <a href="../index.html" class="logo">SignApp</a>
    <nav class="navbar">
      <a href="#"><i class="fa-solid fa-house"></i> Inicio</a>
      <a href="#services"><i class="fa-solid fa-bell"></i> Notificaciones</a>
      <a href="/texto.php"><i class="fa-solid fa-bell"></i> Texto</a>
      <a href="/camara.php"><i class="fa-solid fa-bell"></i> Camara</a>
      <a href="/Voz.php"><i class="fa-solid fa-bell"></i> Voz</a>


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
        <li><a class="dropdown-item  a" href=/texto.php"><i class="fa-solid fa-bell"></i> TEXTO</a></li>
        <li><a class="dropdown-item  b" href="/camara.php"><i class="fa-solid fa-bell"></i> CAMARA</a></li>
        <li><a class="dropdown-item  a" href="/camara.php"><i class="fa-solid fa-bell"></i> VOZ</a></li>
        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-envelope"></i> MENSAJES</a></li>
        <li><a class="dropdown-item" href="#logoutModal" data-toggle="modal" data-target="#logoutModal"><i
              class="fa-solid fa-right-from-bracket"></i> CERRAR SESION</a></li>

      </ul>
    </div>
  </header>


  </header>
  <br>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                                
                            </div>
                            <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                            <div class="modal-footer">
                                <button class="btn rounded-3" type="button" data-dismiss="modal" style="background: white; color:black;">Cancelar</button>
                                <a class="btn rounded-3" style="background: black; color:white;" href="../controlador/action/act_logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
  
<!-- modal mesages -->



<!-- Vertically centered scrollable modal -->

<div class="modal fade" id="messi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Centro de mensajes</h5>
                                
                            </div>
                            <div class="modal-body">No tiene mensajes recientes</div>
                            <div class="modal-footer">
                                <button class="btn rounded-3" type="button" data-dismiss="modal" style="background: white; color:black;">Atras</button>
                      
                            </div>
                        </div>
                    </div>
                </div>



<!-- -->



<section class="home" id="home">

  <div class="content">
    <div class="text">
      <h1><b>BIENVENIDO</b></h1>
      <p>REVISE SU ULTIMA INFORMACIÓN. </p>
    </div>
  </div>

</section>




  </section>

  
  <section>
    <div class="container2">
      <div class="row">
        <div class="col-lg my-3">
          <div class="card rounded-0">
            <div class="card-header bg-light">
              <h4 class="miscursos">Noticias</h4>
            </div>
            <div class="card-body">


              <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                  <div class="container2 mt-5 mb-5">
                    <div class="card">
                      <img src="img/bk.jpg" class="card-img-top cover-samll" alt="...">

                      <div class="card-body">
                        <h4 class="card-title">UNIMAGDALENA y La Piragua: un viaje a través de la Colombia profunda</h4>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                  <div class="container2 mt-5 mb-5">
                    <div class="card">
                      <img src="img/bk.jpg" class="card-img-top cover-samll" alt="...">
                      <div class="card-body">
                        <h4 class="card-title">UNIMAGDALENA y La Piragua: un viaje a través de la Colombia profunda</h4>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                  <div class="container2 mt-5 mb-5">
                    <div class="card">
                      <img src="img/bk.jpg" class="card-img-top cover-samll" alt="...">

                      <div class="card-body">
                        <h4 class="card-title">UNIMAGDALENA y La Piragua: un viaje a través de la Colombia profunda</h4>
                      </div>
                    </div>
                  </div>
                </div>

              </div>





            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  </div>

 



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
  <script src="app.js"></script>


</body>

</html>