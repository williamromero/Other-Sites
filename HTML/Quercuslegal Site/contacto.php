<!DOCTYPE html>
<html lang="es">
<head>
  <title> Quercus | Contacto </title>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="imgs/favicon-32.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <link rel="stylesheet" href="css/quercus.css">
  <link rel="stylesheet" href="css/responsive.css">
  <!-- jQuery first, then Tether, then Bootstrap JS. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-10 col-md-9 top-header">
        <div class="top-header-link-box">
          <a href="spa/area_restringida.php" class="link-client-login"> CLIENTES </a>
        </div>
      </div>
      <div class="col-xs-12 col-md-9 nav-main">
        <div class="col-xs-12 col-md-3 nav-main-logo">
          <img src="imgs/quercus_logo.svg" />
        </div>
        <ul class="col-md-8 navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">INICIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nosotros.html">NOSOTROS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="internacionalizacion.html">INTERNACIONALIZACIÓN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="emprendedores.html">EMPRENDEDORES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="servicios.html">SERVICIOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto.php">CONTACTO</a>
          </li>
        </ul>
        <div class="responsive-icon">&#9776;</div>
      </div>
      <div class="responsive-menu">
        <ul class="responsive-menu-nav">
          <li class="responsive-nav-item">
            <a class="responsive-nav-link" href="index.html">INICIO</a>
          </li>
          <li class="responsive-nav-item">
            <a class="responsive-nav-link" href="nosotros.html">NOSOTROS</a>
          </li>
          <li class="responsive-nav-item">
            <a class="responsive-nav-link" href="internacionalizacion.html">INTERNACIONALIZACIÓN</a>
          </li>
          <li class="responsive-nav-item">
            <a class="responsive-nav-link" href="emprendedores.html">EMPRENDEDORES</a>
          </li>
          <li class="responsive-nav-item">
            <a class="responsive-nav-link" href="servicios.html">SERVICIOS</a>
          </li>
          <li class="responsive-nav-item">
            <a class="responsive-nav-link" href="contacto.php">CONTACTO</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-9 contact-page-banner-block">
        <div class="col-xs-12 col-md-12 contact-page-banner-block-img">
          <img src="imgs/quercus-web-contacto.jpg" />
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-9 contact-page-text-block">
        <div class="col-xs-12 col-md-5 contact-page-txt-one">
          <h1 class="contact-page-txt-one-title">CONTÁCTANOS</h1>
          <ul>
            <li> C/Roberto Tojeiro N.1 Entresuelo A-B 15009 A Caruña </li>
            <li> Tlf. 981 177 790 </li>
          </ul>
        </div>
        <div class="col-xs-12 col-md-7 contact-page-txt-two">
          <? if (!$HTTP_POST_VARS){ ?>
          <form action="contacto.php" method="post" onsubmit="return form_Validator(this)">
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
              <label for="empresa">Empresa:</label>
              <input type="text" class="form-control"  name="empresa" placeholder="Empresa">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="input_email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono:</label>
              <input type="phone" class="form-control" id="input_phone" name="telefono" placeholder="Teléfono">
            </div>
            <div class="form-group">
              <label for="mensaje">Mensaje:</label>
              <textarea class="form-control" id="textarea_message" name="mensaje" rows="3"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success btn-lg btn-block" name="submit" value="Enviar">
            </div>
          <?
            }else{ 
            //Estoy recibiendo el formulario, compongo el cuerpo 
            $cuerpo = "Enviado desde quercuslegal.com:\n";
            $cuerpo = "Mensaje enviado desde quercuslegal.com .- \n"; 
            $cuerpo .= "Nombre: " . $HTTP_POST_VARS["nombre"] . "\n"; 
            $cuerpo .= "Empresa: " . $HTTP_POST_VARS["empresa"] . "\n";
            $cuerpo .= "E-mail: " . $HTTP_POST_VARS["email"] . "\n";
            $cuerpo .= "Telefono: " . $HTTP_POST_VARS["telefono"] . "\n";
            $cuerpo .= "Mensaje: " . $HTTP_POST_VARS["mensaje"] . "\n";

              //mando el correo... 
              echo  '<script> alert("prueba"); </script>';
              mail("williamromerovela@gmail.com","Mensaje desde QuercusLegal",$cuerpo,"From: quercuslegal.com");
              mail("info@quercuslegal.com","Mensaje desde QuercusLegal",$cuerpo,"From: quercuslegal.com");
              echo  '<script> window.location.href=\'http://www.quercuslegal.com/contacto_gracias.html\'; </script>';
            } 
          ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-12 front-end-blank-line"></div>
  <div class="col-xs-12 col-md-12 front-end-footer">
    <p>
      Quercus &copy; Todos los derechos reservados &#124; Políticas de Privacidad &#124; C. Roberto Tojeiro N.1 A-B 15009 A Coruña, España.
      <br/> Síguenos en
      <img class="front-end-footer-icon" src="imgs/facebook-icon.svg" />
      <img class="front-end-footer-icon" src="imgs/linkedin-icon.svg" />
    </p>
  </div>
  <script src="js/app.js"></script>
  <script type="text/javascript">
    $('.carousel').carousel()
  </script>

</body>
</html>