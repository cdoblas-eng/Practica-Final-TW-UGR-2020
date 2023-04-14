<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function login_error($error){

  $cad = " <div class='alert alert-danger' role='alert'>
      $error
  </div>";

  return $cad;
}

function login_success($success){
  $cad = " <div class='alert alert-success' role='alert'>
      $success
  </div>";

  return $cad;
}

function avisos_login(){
  $avisos = "";
  if ( isset ($GLOBALS['error_correo']) )
      $avisos .= $GLOBALS['error_correo'] ;

  if ( isset ($GLOBALS['error_contrasena']) )
      $avisos .= $GLOBALS['error_contrasena'] ;

  if ( isset ($GLOBALS['error_autenticacion']) )
      $avisos .= $GLOBALS['error_autenticacion'] ;

  if ( isset ($GLOBALS['login_success']) )
      $avisos .= $GLOBALS['login_success'] ;

  return $avisos;
}

function comprobar_credenciales(){

    //SI SE HAN INTRODUCIDO LOS DATOS SE COMPRUEBAN CREDENCIALES

    if (isset($_POST['enviar']) && !empty($_POST["email"]) && !empty($_POST["contrasena"]))  {

        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        unset( $_SESSION["error_correo"] );
        unset( $_SESSION["error_contrasena"] );
        //COMPROBACION CREDENCIALES FUNCIÓN SQL
        //------------------------------>

      $correcto = login($email,$contrasena);

      if ($correcto == 0)
        $GLOBALS['error_autenticacion'] = login_error("Las credenciales no son validas");
      else
        $GLOBALS['login_success'] = login_success("Las credenciales son correctas :D");
    }
    // Si no introducen alguno de los datos
    else if (isset($_POST['enviar'])) { //Si no

            // Comprobamos si el campo usuario está vacio y mostramos error
            if (empty($_POST["email"]) ){
              $GLOBALS['error_correo'] = login_error("No ha introducido el correo");
            }
            // Comprobamos si el campo contraseña está vacia y mostramos error
            if (empty($_POST["contrasena"])){
              //MENSAJE DE ERROR
              $GLOBALS['error_contrasena'] = login_error("No ha introducido la contraseña");
            }
      }

}

function enviar_correo($destino, $token){
  $mail = new PHPMailer;
  $mail->isSMTP();
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->SMTPAuth = true;
  $mail->Username = 'contactorealfooding@gmail.com';
  $mail->Password = 'yhQqrANJ';


  $mail->setFrom('contactorealfooding@gmail.com', 'Informacion Realfooding');
  //$mail->addReplyTo('guillelupianez99@gmail.com', 'Guillermin');
  $mail->addAddress($destino);
  // $mail->addCC('cc1@example.com', 'Elena');
  // $mail->addBCC('bcc1@example.com', 'Alex');
  $mail->Subject = 'Mensaje de verificacion Realfooding';
  $mail->isHTML(true);

  $mensaje = "<p>¡Bienvenido al RealFooding! Para verificar su dirección de correo haga click en el siguiente link:</p>";
  $mensaje .= '<p>https://void.ugr.es/~doblaslupianez1920/practicaFINAL_3?ac=link-email&token='.$token.'</p>';
  $mail->msgHTML($mensaje);
  //$mail->AltBody = 'This is a plain-text message body';

  if (!$mail->send()) {
      echo 'Mailer Error: '. $mail->ErrorInfo;
  } else {
      //echo 'Message sent!';
      //Section 2: IMAP
      //Uncomment these to save your message in the 'Sent Mail' folder.
      #if (save_mail($mail)) {
      #    echo "Message saved!";
      #}
  }

}

function errores_registro(){
  if (isset($_POST['enviar'])){
    $errores = "";
    $foto_tmp = $_FILES['imagen-reg']['tmp_name'];

    $_SESSION['nombre'] = $_POST['nombre'];

    if (empty($foto_tmp)) { // Si el campo de imagen está vacío
      $errores .= login_error("No ha introducido una foto de perfil");
    }
    else{
      //falta comprobar la extension del archivo!!!
      $_SESSION['imagen-reg'] = $foto_tmp;
    }

    if (email_registrado($_POST["email"])){// Si el email, ya se encuentra registrado
      $errores .= login_error("El email que ha introducido ya está registrado");
    }
    else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      $errores .= login_error("El email que ha introducido no es válido");
    }
    else{
      $_SESSION['email-reg'] = $_POST["email"];
    }

    if ($_POST["password"] != $_POST["confirm-password"] ){ // Si las contraseñas no coinciden
      $errores .= login_error("Las contraseñas no coinciden");
    }
    // else{
    //   $_SESSION['contrasena-reg'] = md5($_POST["password"]);
    // }

    return $errores;
  }
}



function confirmacion_usuario(){

  if (empty(errores_registro()) && isset($_POST["enviar"])){
    $foto_tmp = $_FILES['imagen-reg']['tmp_name'];
    $nombre_foto = $_FILES['imagen-reg']['name'];
    $ext = pathinfo($nombre_foto, PATHINFO_EXTENSION);
    $path_image = "./subidos/perfiles/" . obtener_token() . "." . $ext;

    move_uploaded_file($foto_tmp , $path_image);
    html_confirm_register($_POST["nombre"],$_POST["email"],$_POST["password"],$path_image);
    //enviar_correo($_SESSION['email-reg']);
  }else{
    form_registro();
  }

}

function obtener_token(){
  return bin2hex(random_bytes(8));
}

function registrar_usuario($nombre, $email, $path_image, $contrasena, $tipo){
  $token = obtener_token();
  insertar_usuario($nombre,$email,$path_image,$contrasena,$tipo,$token);
  enviar_correo($email,$token);
}

function gestionar_link($token){
  $nombre = comprobar_token($token);
  if ($nombre == ""){
    echo login_error("Ha habido un problema confirmando su cuenta");
  }
  else{
    modificar_registrado($token);
    $mensaje = "Enhorabuena, " .$nombre. ", su cuenta ha sido confirmada con éxito";
    echo login_success($mensaje);
  }
}

function checking_editar_perfil(){

  if (isset($_POST['editar'])){
    $errores = "";
    $foto_tmp = $_FILES['foto-nueva']['tmp_name'];

    $_SESSION['nombre'] = $_POST['nombre'];

    if (empty($foto_tmp)) { // Si el campo de imagen está vacío
      $GLOBALS['guardar_imagen'] = $_POST["imagen_perfil"];
    }
    else{
      $foto_tmp = $_FILES['foto-nueva']['tmp_name'];
      $nombre_foto = $_FILES['foto-nueva']['name'];
      $ext = pathinfo($nombre_foto, PATHINFO_EXTENSION);
      $path_image = "./subidos/perfiles/" . obtener_token() . "." . $ext;

      move_uploaded_file($foto_tmp , $path_image);
      $GLOBALS['guardar_imagen'] = $path_image;
    }

    if (email_registrado($_POST["email"])){// Si el email, ya se encuentra registrado
      $errores .= login_error("El email que ha introducido ya está registrado");
    }
    else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      $errores .= login_error("El email que ha introducido no es válido");
    }
    else{
      $_SESSION['email-reg'] = $_POST["email"];
    }

    if ($_POST["password"] != $_POST["confirm-password"] ){ // Si las contraseñas no coinciden
      $errores .= login_error("Las contraseñas no coinciden");
    }
    // else{
    //   $_SESSION['contrasena-reg'] = md5($_POST["password"]);
    // }

    return $errores;
  }
}

function editar_perfil($id){

  if ($id == $_SESSION["id"]){

    if (!isset($_POST["editar"])){
      html_editar_perfil($id);
    }
    else{

      // if (email_registrado($_POST["email"])){// Si el email, ya se encuentra registrado
      //   $errores .= login_error("El email que ha introducido ya está registrado");
      //   $error = true;
      // }
      // else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      //   $errores .= login_error("El email que ha introducido no es válido");
      //   $error = true;
      // }

    }
  }
  else{
    echo "No tienes permiso para editar este usuario";
  }
}



?>
