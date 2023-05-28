<?php 
  session_start();
  error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Halloween</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="./css/sesion.css" />
   
  </head>
  <body>
    <!-- #region ENCABEZADO -->
    
    <!-- #endregion -->
    <!-- #region Principal-->
    <main>

      <div class="contenedor__todo">
          <div class="caja__trasera">
              <div class="caja__trasera-login">
                  <h3>¿Ya tienes una cuenta?</h3>
                  <p>Inicia sesión para entrar en la página</p>
                  <button class="button" id="btn__iniciar-sesion">Iniciar Sesión</button>
              </div>
              <div class="caja__trasera-register">
                  <h3>¿Aún no tienes una cuenta?</h3>
                  <p>Regístrate para que puedas iniciar sesión</p>
                  <button class="button" id="btn__registrarse">Regístrarse</button>
              </div>
          </div>

          <!--Formulario de Login y registro-->
          <div class="contenedor__login-register">
              <!--Login-->
              <form action="../assets/controlador/action/act_login.php" method="POST"  class="formulario__login">
                  <h2>Iniciar Sesión</h2>
                  <input type="text" placeholder="Correo Electronico" name="correo">
                  <input type="password" placeholder="Contraseña" name="pass">
                  <button class="button">Entrar</button>
              </form>

              <!--Register-->
              <form action="../assets/controlador/action/act_register.php" method="POST" class="formulario__register">
                  <h2>Regístrarse</h2>
                  <input type="text" placeholder="Nombre completo" name="nombre">
                  <input type="text" placeholder="Correo Electronico" name="correo">
                  <input type="text" placeholder="Usuario" name="nickname">
                  <input type="password" placeholder="Contraseña" name="password">
                  <button class="button">Regístrarse</button>
              </form>
          </div>
      </div>

  </main>

  <script src="./js/sesion.js"></script>

  <?php // codigo de la elecicion de swift alert a mostrar
      if(isset($_SESSION['msg'])){
          $msg = $_SESSION['msg'];
          $icon = 'success';
          $location = 'window.location.reload();';
          session_destroy(); 
      }else{
        if(isset($_SESSION['error'])){
            $msg = $_SESSION['error'];
            $icon = 'error';
            $location = 'window.location.reload();';
            session_destroy(); 
        }else{
          if(isset($_SESSION['go'])){
            $msg = $_SESSION['go'];
            $icon = 'success';
              $location = 'window.location.href= "./dashboardAdmin.php"';
          }
        }
      }
  ?>

  <script>//llamado del swift alert
    Swal.fire({
      position: 'center-center',
      icon: '<?php echo $icon ?>',
      title: '<?php echo $msg ?>',
      showConfirmButton: false,
      timer: 2500
    })

    setTimeout(() => {//funcion encargada de  ejecutar  luego de pasar 2600 ns (tiempo que demora la swift alert en patanlla)
				<?php echo $location ?>//ubicacion a donde mandara al usuario
			}, 2600);

  </script>

  <?php
          unset($_SESSION['msg']);
          unset($_SESSION['error']); 
          unset($_SESSION['go']); 
  ?>
  </body>
</html>
