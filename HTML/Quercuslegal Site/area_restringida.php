<!DOCTYPE html>
<html lang="es">
<head>
  <title> Quercus | Área Restringida </title>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="../imgs/favicon-32.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/quercus.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <!-- jQuery first, then Tether, then Bootstrap JS. -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="col-xs-10 col-md-9 top-header">
      <div class="top-header-link-box">
        <a href="spa/area_restringida.php" class="link-client-login"> CLIENTES </a>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="col-xs-12 col-md-9 nav-main">
      <div class="col-xs-12 col-md-3 nav-main-logo">
        <img src="../imgs/quercus_logo.svg" />
      </div>
      <ul class="col-md-8 navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/index.html">INICIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/nosotros.html">NOSOTROS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/internacionalizacion.html">INTERNACIONALIZACIÓN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/emprendedores.html">EMPRENDEDORES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/servicios.html">SERVICIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contacto.php">CONTACTO</a>
        </li>
      </ul>
      <div class="responsive-icon">&#9776;</div>
    </div>
    <div class="responsive-menu">
      <ul class="responsive-menu-nav">
        <li class="responsive-nav-item">
          <a class="responsive-nav-link" href="/index.html">INICIO</a>
        </li>
        <li class="responsive-nav-item">
          <a class="responsive-nav-link" href="/nosotros.html">NOSOTROS</a>
        </li>
        <li class="responsive-nav-item">
          <a class="responsive-nav-link" href="/internacionalizacion.html">INTERNACIONALIZACIÓN</a>
        </li>
        <li class="responsive-nav-item">
          <a class="responsive-nav-link" href="/emprendedores.html">EMPRENDEDORES</a>
        </li>
        <li class="responsive-nav-item">
          <a class="responsive-nav-link" href="/servicios.html">SERVICIOS</a>
        </li>
        <li class="responsive-nav-item">
          <a class="responsive-nav-link" href="/contacto.php">CONTACTO</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-9 clients-page-banner-block">
        <div class="col-xs-12 col-md-12 clients-page-banner-block-img">
          <img src="../imgs/quercus-web-clientes.jpg" />
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-9 clients-page-text-block">
        <div class="col-xs-12 col-md-6 clients-page-txt-one">
          <h1>Para nosotros tú eres lo más importante. Te lo demostramos día a día.</h1>
        </div>

        <div class="col-xs-12 col-md-6 clients-page-txt-two">
          <? if (!isset($_COOKIE['usuario_login1']) && !isset($_COOKIE['usuario_password1'])){ ?>
            <form action="descargas_fiscal.php" method="post">
              <div class="form-group">
                <label for="user">Usuario:</label>
                <input type="text" class="form-control" id="user" placeholder="Usuario" required>
              </div>
              <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control" id="pass" placeholder="Contraseña" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Entrar</button>
              </div>
            </form>
          <? }
          else {
            echo "<script type='text/javascript'>window.location='descargas_fiscal.php';</script>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-12 front-end-blank-line"></div>
  <div class="col-xs-12 col-md-12 front-end-footer">
    <p>
      Quercus &copy; Todos los derechos reservados &#124; Políticas de Privacidad &#124; C. Roberto Tojeiro N.1 A-B 15009 A Coruña, España.
      <br/> Síguenos en
      <img class="front-end-footer-icon" src="../imgs/facebook-icon.svg" />
      <img class="front-end-footer-icon" src="../imgs/linkedin-icon.svg" />
    </p>
  </div>
  <script src="../js/app.js"></script>
  <script type="text/javascript">
    $('.carousel').carousel()
  </script>

</body>
</html>