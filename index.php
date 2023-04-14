<?php

session_start();
require 'bd.php';
require 'login.php';
require 'vista.php';

require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';

unset($_SESSION["usuario"]);


if (isset($_SESSION["usuario"])){
  echo "CORRECTO";
}

head();
encabezado();
navegador();
JS();

if (isset($_GET["ac"])) {
  $ac = $_GET["ac"];

  switch ($ac) {
    case "inicio":

      main_index();
      //enviar_correo();
    break;

    case "listado":

    break;

    case "anadir_receta":
      html_anadir_receta();
    break;

    case "register":
        confirmacion_usuario();
    break;
    case "contacto":
      echo "hola que tal";
      //insertar_usuario("prueba", "wilson@wilson", "contra", "tokennn", "pepelillo", "jajjj");

    break;

    case "confirm_registro":
      if (isset($_POST['confirmar'])){
        registrar_usuario($_POST['nombre'],$_POST['email'],$_POST['path_image'],$_POST['password'],"colaborador");
        echo login_success("Un correo de confirmación ha sido enviado a su email, revíselo");
      }
    break;

    case "link-email":
      if (isset($_GET['token'])){
        gestionar_link($_GET['token']);
      }
    break;

    case "editar_perfil":
        html_editar_perfil(40); //$_SESSION["id"]
    break;

    default:
      echo "HOLA";
    break;
  }
}
else{
  main_index();
}

if ( isset($_GET["login"]) ) {
  if (isset($_POST['enviar'])){
    comprobar_credenciales();
  }
  html_login();
}


fin();

 ?>
