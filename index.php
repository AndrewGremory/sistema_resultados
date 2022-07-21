<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = '<div class="alert alert-warning" role="alert">
      Ingrese su usuario y su clave
    </div>';
    } else {
      require_once "bd/conexionn.php";

      $objeto = new Conexion();
      $conexion = $objeto->Conectar();


      $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
      $clave = (isset($_POST['clave'])) ? $_POST['clave'] : '';

      $consulta = "SELECT * FROM usuarios where usuario ='$usuario' and pw='$clave'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $con = $resultado->fetchAll(PDO::FETCH_ASSOC);


      foreach ($con as $dato);
      if ($con != null) {
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $dato['id_usuario'];
        $_SESSION['nombre'] = $dato['nombre'];
        $_SESSION['apellido'] = $dato['apellido'];
        $_SESSION['email'] = $dato['correo'];
        $_SESSION['user'] = $dato['usuario'];
        $_SESSION['clave'] = $dato['pw'];
        $_SESSION['rol_name'] = $dato['rol'];
        header('location: sistema/');
      } else {
        $alert = '<div class="alert alert-warning" role="alert">
            
                  Usuario o Contraseña Incorrecta 
                </div>';
        session_destroy();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <link rel="stylesheet" href="sistema/css/mainstyle.css">
  <!-- <link rel="stylesheet" href="sistema/css/style.css"> -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>

<body>
  <!-- <form class="user"  method="POST">

        <h1>LOGIN USUARIO</h1>
        <p>Usuario <input type="text" placeholder="Ingrese usuario" name="usuario"></p>
        <p>Contraseña <input type="password" placeholder="Ingrese contraseña" name="clave"></p>

        <input type="submit" class="btn btn-primary" value="Ingresar">

    </form> -->

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <h1>LOGIN USUARIO</h1>

      </div>

      <!-- Login Form -->
      <form class="user" method="POST">

      <?php echo isset($alert) ? $alert : ""; ?>

        <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Ingrese usuario">
        <input type="password" id="password" class="fadeIn third" name="clave" placeholder="Ingrese contraseña">
        <input type="submit" class="fadeIn fourth" value="Ingresar">
      </form>
    </div>
  </div>

  <!-- Archivos javascript -->
  <script src="sistema/vendor/jquery/jquery-3.6.0.min.js"></script>
  <script src="sistema/vendor/popper/popper.min.js"></script>
  <script src="sistema/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="sistema/vendor/jquery.cookie/jquery.cookie.js"></script>
  <script src="sistema/vendor/jquery-validation/jquery.validate.min.js"></script>

</body>

</html>