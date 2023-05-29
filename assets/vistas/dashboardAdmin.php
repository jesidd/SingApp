<?php
  session_start();
  if (!isset($_SESSION['CORREO'])) {
      session_destroy();
      header('locatio: ../sesion.php');
      die();
  }elseif($_SESSION['ROL']==2){
    header('location: ./inicio.php');
    die();
  }




include '../modelo/ConectBe.php';
$consulta = "SELECT * FROM usuario ";
if (isset($_POST['buscar'])) {
  $correo = $_POST['correo'];
  $consulta = "SELECT * FROM usuario WHERE correo LIKE '%$correo%'";
}

$query = mysqli_query($conexion, $consulta);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


  <link rel="stylesheet" href="./css/admin.css">

  <link rel="icon" href="img/logo.png">
  <title>PROYECTO</title>




  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

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
  <br>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>

        </div>
        <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.
        </div>
        <div class="modal-footer">
          <button class="btn " type="button" data-dismiss="modal"
            style="background: white; color:black;">Cancelar</button>
          <a class="btn rounded-3" style="background: #16a085; color:white; margin:1px 1px 1px 1px;"
            href="../controlador/action/act_logout.php">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>

  <section class="home" id="home">

    <div class="content">
      <h3>ADMINISTRADOR</h3>
    </div>

  </section>




  <section>

    <div class="container">



      <div class="row1 ">

        <a href="#agregar1" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn_a"><i
            class="fa-solid fa-plus"></i>Agregar Usuario</a>

        <form action="" method="post" class="form1">

          <input type="text" name="correo" placeholder="NOMBRE" class="form-control">

          <input type="submit" value="buscar" name="buscar" class="btn_a">

        </form>
      </div>

      <div class="row">
        <div class="col-lg4 my-4">
          <div class="card rounded-3">
            <h4 class="h4usuarios" style="color:white;">USUARIOS REGISTRADOS</h4>
          </div>



          <table class="table" id="usuariosRegistrados">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Nickname</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">acciones</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <td scope="col">
                    <?php echo $data["nombre"]; ?>
                  </td>
                  <td scope="col">
                    <?php echo $data["nickname"]; ?>
                  </td>
                  
                  <td scope="col">
                    <?php echo $data["correo"]; ?>
                  </td>
                  <td scope="col">
                    
                    <?php $rol_idrol = $data["rol_idrol"];
                     if($rol_idrol==1){
                      echo 'ADMINISTRADOR';
                     }else{ 
                      echo 'USUARIO';
                     } ?>
                  </td>
                  
                  <div id="acciones">
                    <td>
                      <div class="container-fluid">


                        <a class="btn_1"
                          href="controlador/action/eliminarcuenta.php?correo=<?php echo $data['correo']; ?>"><i
                            class="fa-solid fa-trash"></i>
                        </a>
            
                         <a href="#modificarModal?cedula=<?php echo $data['correo']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn_1"><i
                            class="fa-solid fa-scroll"></i>
                        </a>

                      </div>
                    </td>
                  </div>
                </tr>

              </tbody>
              <?php
              }
              ?>

          </table>






        </div>
      </div>
    </div>
    </div>
    </div>







  </section>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTRAR USUARIO</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-signin needs-validation" novalidate method="post"
            action="./controlador/action/ar.php" id="formulario">

            <input type="text" name="usu_id" id="usu_id">

            <div class="">
              <input type="text" id="nombre" name="nombre" required
                placeholder="nombre" class="form-control">
            </div>
            <div class="">
              <label class="form-label"></label>
              <input type="email" id="correo" name="correo" required
                placeholder="correo" class="form-control">
            </div>
            

            <div class="">
              <label class="form-label"></label>
              <input type="number" id="passord" name="password" required
                placeholder="password" class="form-control">
            </div>
            
           
           

            <div class="">
              <label class="form-label"></label>
              <input type="text" id="nickname" name="nickname" required
                placeholder="nickname" class="form-control">
            </div>

           
            </div>

            <div class="modal-footer">
              <div class="button-area">
                <button class="btn submit" name="submit" value="submit" id="btnlogin">REGISTRAR</button>
              </div>

          </form>
          <button type="button" class="btn btn-secondary"
            style="background: #16a085; color:white; margin:1px 1px 1px 1px;" data-bs-dismiss="modal">Close</button>
        </div>



      </div>
    </div>
    </div>
  </div>

  <!-- Modificar --> 

  <div class="modal fade" id="modificarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">MODIFICAR USUARIO</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-signin needs-validation" novalidate method="post"
            action="../controlador/action/act_modificar.php" id="formulario">


            <div class="">
              <input type="text" id="nombre" name="nombre" required
                value="<?php ?>"placeholder="nombre" class="form-control">
            </div>
            <div class="">
            <label class="form-label"></label>
              <input type="text" id="apellido" name="apellido" required
                placeholder="apellido" class="form-control">
            </div>
            <div class="">
              <label  class="form-label"></label>
              <input type="tel" id="telefono" name="telefono" required
                placeholder="telefono" class="form-control">
            </div>
            <div class="">
              <label  class="form-label"></label>
              <input type="text" id="direccion" name="direccion" required
                placeholder="direccion" class="form-control">
            </div>

            <div class="">
              <label  class="form-label"></label>
              <input type="text" id="cedula" name="cedula" valur="<?php echo $data['cedula']; ?>" required class="form-control" maxlength="10" pattern="[0-9]{10}" >
            </div>

            <div class="">
              <label class="form-label"></label>
              <input type="number" id="passord" name="password" required
                placeholder="password" class="form-control">
            </div>
            <div class="">
              <label class="form-label"></label>
              <input type="number" id="edad" name="edad" required
                placeholder="edad" class="form-control">
            </div>
            <div class="">
              <label class="form-label"></label>
              <input type="email" id="correo" name="correo" required
                placeholder="correo" class="form-control">
            </div>
           <div class="">
              <label class="form-label"></label>
              <select name="rol_idrol" id="rol_idrol"  class="form-control">
              <option value="" selected>Seleccione un rol</option>
                <option value="1">Paciente</option>
                <option value="2">Administrador</option>
                <option value="3">Médico</option>
              </select>
            </div>

            <div class="">
              <label class="form-label"></label>
              <select name="eps_ideps" id="eps_ideps"  class="form-control">
              <option value="" selected>Seleccione una eps</option>
                <option value="1">SALUD TOTAL</option>
                <option value="2">HUMANA VIVIR</option>
                <option value="3">COOMEVA</option>
                <option value="3">CAFESALUD</option>
                <option value="3">MUTUALSER</option>

              </select>
            </div>
           
            </div>

            <div class="modal-footer">
              <div class="button-area">
                <button class="btn submit" name="submit" value="submit" id="btnlogin">REGISTRAR</button>
              </div>

          </form>
          <button type="button" class="btn btn-secondary"
            style="background: #16a085; color:white; margin:1px 1px 1px 1px;" data-bs-dismiss="modal">Close</button>
        </div>



      </div>
    </div>
    </div>
  </div>



  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

  <style>
    .table td,
    th {
      height: 45px;
      text-align: center;
    }

    .table th {
      color: var(--green);
    }

    .btn_1 {
      margin-top: .2rem;
      margin-left: .5rem;
      padding: .5rem;
      border: var(--border);
      border-radius: .5rem;
      box-shadow: var(--box-shadow);
      color: var(--green);
      cursor: pointer;
      font-size: 1rem;
      text-decoration: none;
      display: inline-block;
    }

    .btn_1:hover {
      background: var(--green);
      color: #fff;
      scale: 1.20;
      box-shadow: var(--box-shadow);
    }
  </style>



  <script src="js/librerias/jquery-3.3.1.min.js"></script>

  <script src="js/librerias/sweetalert2.js"></script>
  <script src="js/logica/dashboardAdmin.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>


</body>

</html>