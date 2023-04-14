<?php

function head(){
echo <<< HTML
  <html lang="es" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="css/recetas.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
      <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>

       <!--JQUERY-->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

       <!-- Los iconos tipo Solid de Fontawesome-->
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
       <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

       <!-- Nuestro css-->
       <link rel="stylesheet" type="text/css" href="css/form-login.css">

    </head>
HTML;
}

function encabezado(){
echo <<< HTML
  <body class="w-75">
    <header>
      <div class="container text-center div_header">
        <img class="float-left w-25" src="imagenes/logo-mi-menu-realfooding.png" alt="foto portada">
        <h1 id="titulo_pagina">Aprende a ser un auténtico Realfooder</h1>
      </div>
    </header>
HTML;
}

function navegador(){
  //echo htmlspecialchars($_SERVER['PHP_SELF']);
  $ac = "";
  if (isset($_GET["ac"]))
    $ac = $_GET["ac"];
echo <<< HTML
  <nav class="navbar navbar-expand-sm navbar-white navegador d-flex justify-content-between">

    <!-- Links -->

    <div>
      <ul class="navbar-nav mt-3">

        <!-- <a class="navbar-brand" href="#">
            <img src="imagenes/tiburon.jpg" alt="Logo" style="width:40px;">
        </a> -->

        <li class="nav-item">
          <a class="nav-link" href="index.php?ac=inicio">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ac=listado">Listado Recetas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ac=contacto">Contacto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ac=$ac&login=si">Acceso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ac=editar_perfil">Editar perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ac=anadir_receta">Añadir receta</a>
        </li>
      </ul>
    </div>

    <form class="form d-flex inline mt-3" action="/action_page.php">
        <input class="form-control mr-sm-2 input_buscar align-self-center" type="text" placeholder="Buscar Receta">
        <button class="btn btn-success align-self-center" type="submit">Buscar</button>
    </form>
  </nav>
HTML;
}

function main_index(){
echo <<< HTML
  <main class="container mt-5">
    <div class="row">
      <div class="col-6">
        <img src="imagenes/eat-real-food.png" alt="logo realfooding">
      </div>

      <div class="col-6">

        <p class="h2">Cocina Realfooding</p>

        <p>
            El Realfooding es un estilo de vida basado en comer comida real y evitar los ultraprocesados.

            Somos un movimiento que defiende el derecho a una alimentación saludable para la población.

            Cocinar saludablemente es esencial para ser un verdadero realfooder y con nosotros te convertirás en maestro.
        </p>
      </div>
    </div>

    <div class="row fila-2-index">
      <div class="col-6">

        <p class="h2">Alimentos sostenibles y de temporada</p>

        <p>
          Promovemos la compra de alimentos en el mercado, ya que garantiza una alimentación menos procesada,
           más saludable, más sostenible y beneficiosa con la economía alimentaria.

          La comida real no lleva etiqueta.
        </p>
      </div>

      <div class="col-6 text-center" id="imagen2">
        <img class="w-50" src="imagenes/sopa.jpg" alt="imagen sopa">
      </div>
    </div>
  </main>
HTML;
}

function JS(){
  echo <<< HTML
  <script>
    function cerrar_login(){
      document.getElementById("box").style.display="none";
    }

    function mostrar_login(){
      document.getElementById("box").style.display="block";
    }

    function cargar_pagina(){
      var variable = 1;
      if (variable == "1")
        document.getElementById("box").style.display="block";
    }
  </script>

HTML;

}

function fin(){
echo <<< HTML
  <aside>


  </aside>

    </body>




    <footer>


    </footer>


  </html>
HTML;
}

function form_registro(){
  $nombre = "";
  $email = "";


  if (isset($_SESSION['nombre'])){
    $nombre = $_SESSION['nombre'];
  }
  if (isset($_SESSION['email-reg'])){
    $email = $_SESSION['email-reg'];
  }
echo <<< HTML

<div class="text-center container col-3">
<form class="form-signin" method="post" action="index.php?ac=register"enctype="multipart/form-data">

      <h1 class="h3 mb-3 font-weight-normal">Registro</h1>

      <!-- <img class="mb-4" src="imagenes/user.png" alt="" width="72" height="72">
      <input type="file" name="imagen" class="form-control mb-2"  required autofocus> -->

      <label for="imagen-reg">
      <input type="file" name="imagen-reg" id="imagen-reg" style="display:none;"/>
      <img class="mb-4 logo-registro" src="imagenes/user.png" alt="" width="72" height="72">
      </label>

      <label for="inputEmail" class="sr-only">Nombre:</label>
      <input type="text" name="nombre" class="form-control mb-2" placeholder="Introduzca su nombre" value = '$nombre' required autofocus>

      <label for="inputEmail" class="sr-only">Dirección email</label>
      <input type="email" name="email" class="form-control mb-2" placeholder="Introduzca su email" value = '$email' required autofocus>

      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" name="password" class="form-control mb-2" placeholder="Introduzca una contraseña" required>

      <label for="inputPassword" class="sr-only">Repita la contraseña</label>
      <input type="password" name="confirm-password" class="form-control" placeholder="Confirme la contraseña" required>

      <button class="btn btn-lg btn-success btn-block" name="enviar" type="submit">Regístrese</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
    </form>
  </div>
HTML;
echo errores_registro();
}


function html_confirm_register($nombre,$correo,$contrasena,$dir_foto){

echo <<< HTML
  <div class="text-center container col-3">
  <form class="form-signin" method="post" action="index.php?ac=confirm_registro" enctype="multipart/form-data">

        <h1 class="h3 mb-3 font-weight-normal">Confirme los datos</h1>

        <!-- <img class="mb-4" src="imagenes/user.png" alt="" width="72" height="72">
        <input type="file" name="imagen" class="form-control mb-2"  required autofocus> -->
        <input type="text" name="path_image" value="$dir_foto" hidden>
        <img class="mb-4 logo-registro" src=$dir_foto alt="" width="72" height="72">
        </label>

        <label for="inputName" class="sr-only">Nombre:</label>
        <input type="text" name="nombre" class="form-control mb-2" placeholder="Introduzca su nombre" value = '$nombre' required autofocus readonly>

        <label for="inputEmail" class="sr-only">Dirección email</label>
        <input type="email" name="email" class="form-control mb-2" placeholder="Introduzca su email" value = '$correo' required autofocus readonly>

        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" name="password" class="form-control mb-2" placeholder="Introduzca una contraseña" value ='$contrasena' required readonly>

        <button class="btn btn-lg btn-success btn-block" name="confirmar" type="submit">Confirmar</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
      </form>
    </div>
HTML;
}

function html_login(){
  $ac = $_GET["ac"];
  $avisos_login =  avisos_login();

echo <<< HTML
  <div id="box">
    <div id="login" class="modal-dialog text-center">
        <div class="col-sm-8">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="static/img/user.png"/>
                    <button id="cerrar-login" type="button" class="close" onclick="cerrar_login()" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="col-12" method="post" action="index.php?ac=$ac&login=si">";
                  <div class="form-group" id="user-group">
                    <input type="text" class="form-control" placeholder="Email" name="email"/>
                    </div>
                    <div class="form-group" id="contrasena-group">
                      <input type="password" class="form-control" placeholder="Contraseña" name="contrasena"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="enviar"><i class="fas fa-sign-in-alt"></i>  Ingresar </button>
                </form>
                <div class="col-12 forgot">
                    <a href="?ac=register">Registrate</a>
                </div>
                $avisos_login
              </div>
        </div>
    </div>
  </div>
HTML;

}

function html_editar_perfil($id){

    informacion_usuario($id,$nom,$email,$foto,$password,$tipo,$registrado);

echo <<< HTML
      <div class="text-center container col-3">
      <form class="form-signin" method="post" action="index.php?ac=confirm_registro" enctype="multipart/form-data">

            <h1 class="h3 mb-3 font-weight-normal">Confirme los datos</h1>

            <label for="imagen-reg">
            <input type="file" name="foto-nueva" id="foto-nueva" style="display:none;"/>
            <img class="mb-4 logo-registro" src='$foto' alt="foto de perfil" width="72" height="72">
            </label>

            <label for="imagen-reg">
            <input type="text" name="imagen-perfil" id="imagen-perfil" style="display:none;"/>
            </label>

            <label for="inputName" class="sr-only">Nombre:</label>
            <input type="text" name="nombre" class="form-control mb-2" placeholder="Introduzca su nombre" value = '$nom' required autofocus>

            <label for="inputEmail" class="sr-only">Dirección email</label>
            <input type="email" name="email" class="form-control mb-2" placeholder="Introduzca su email" value = '$email' required autofocus>

            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" name="password" class="form-control mb-2" placeholder="Introduzca una contraseña">

            <label for="inputName" class="sr-only">Nombre:</label>
            <input type="text" name="nombre" class="form-control mb-2" placeholder="Tipo de usuario" value = '$tipo' required autofocus readonly>

            <button class="btn btn-lg btn-success btn-block" name="editar" type="submit">Editar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
          </form>
        </div>
HTML;

}

function html_editar_perfil_sticky($id){

    //informacion_usuario($id,$nom,$email,$foto,$password,$tipo,$registrado);

echo <<< HTML
      <div class="text-center container col-3">
      <form class="form-signin" method="post" action="index.php?ac=confirm_registro" enctype="multipart/form-data">

            <h1 class="h3 mb-3 font-weight-normal">Confirme los datos</h1>

            <label for="imagen-reg">
            <input type="file" name="imagen-reg" id="imagen-reg" style="display:none;"/>
            <img class="mb-4 logo-registro" src='$foto' alt="foto de perfil" width="72" height="72">
            </label>

            <label for="inputName" class="sr-only">Nombre:</label>
            <input type="text" name="nombre" class="form-control mb-2" placeholder="Introduzca su nombre" value = '$nom' required autofocus>

            <label for="inputEmail" class="sr-only">Dirección email</label>
            <input type="email" name="email" class="form-control mb-2" placeholder="Introduzca su email" value = '$email' required autofocus>

            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" name="password" class="form-control mb-2" placeholder="Introduzca una contraseña">

            <label for="inputName" class="sr-only">Nombre:</label>
            <input type="text" name="nombre" class="form-control mb-2" placeholder="Tipo de usuario" value = '$tipo' required autofocus readonly>

            <button class="btn btn-lg btn-success btn-block" name="editar" type="submit">Editar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
          </form>
        </div>
HTML;

}

function html_editar_perfil_conf($nombre,$email,$password,$tipo){

echo <<< HTML
<div class="text-center container col-3">
  <form class="form-signin" method="post" action="index.php?ac=anadir_receta" enctype="multipart/form-data">

      <h1 class="h3 mb-3 font-weight-normal">Inserte una nueva receta</h1>

      <label for="imagen-principal">
      <input type="file" name="imagen-principal" id="imagen-principal" style="display:none;"/>
      <img class="mb-4 logo-registro" src='$foto' alt="foto de perfil" width="72" height="72">
      </label>

      <label for="inputName" class="sr-only">Nombre:</label>
      <input type="text" name="nombre" class="form-control mb-2" placeholder="Introduzca su nombre" value = '$nombre' required autofocus>

      <label for="inputEmail" class="sr-only">Dirección email</label>
      <input type="email" name="email" class="form-control mb-2" placeholder="Introduzca su email" value = '$email' required autofocus>

      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" name="password" class="form-control mb-2" placeholder="Introduzca una contraseña" value = '$password' required>

      <label for="inputName" class="sr-only">Nombre:</label>
      <input type="text" name="nombre" class="form-control mb-2" placeholder="Tipo de usuario" value = '$tipo' required autofocus readonly>

      <button class="btn btn-lg btn-success btn-block" name="editar" type="submit">Editar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
  </form>
</div>
HTML;
}

function html_anadir_receta(){
echo <<< HTML

  <div class="text-center container col-3">
    <form class="form-signin" method="post" action="index.php?ac=anadir_receta" enctype="multipart/form-data">
      <h1 class="h3 mb-3 font-weight-normal">Añadir receta</h1>

      <label for="inputEmail" class="sr-only">Nombre de la receta:</label>
      <input type="text" name="nombre" class="form-control mb-2" placeholder="Introduzca el nombre de la receta" value = '$nombre' required autofocus>

      <label for="imagen-principal"> Introduzca la imagen principal de la receta</label>
      <input type="file" name="imagen-principal" id="imagen-principal" required/>

      <label for="descripcion" class="sr-only">Descripción</label>
      <textarea name="descripcion" class="form-control mb-2" placeholder="Introduzca la descripcion de la receta" value = '$descripcion' required autofocus></textarea>

      <label for="ingredientes" class="sr-only">Ingredientes</label>
      <textarea name="ingredientes" class="form-control mb-2" placeholder="Introduzca los ingredientes separados por comas" required autofocus></textarea>

      <label for="elaboracion" class="sr-only">Elaboración</label>
      <textarea name="elaboracion" class="form-control" placeholder="Introduzca los pasos para la elaboración" required autofocus>

      <label for="imagen-principal"> Introduzca las imagenes secundarias de la receta</label>
      <input type="file" name="imagen-principal" id="imagen-principal" required/>



      <button class="btn btn-lg btn-success btn-block" name="enviar" type="submit">Regístrese</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
    </form>
  </div>
HTML;
}
?>
