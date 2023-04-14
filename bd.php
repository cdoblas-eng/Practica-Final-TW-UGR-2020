<?php
function DB_conexion(){
  return mysqli_connect("localhost","root","","tw");
}

function DB_desconexion($db){
  mysqli_close($db);
}

function login($email,$password){
  $db = DB_conexion();
  $prep = mysqli_prepare($db,"SELECT id FROM usuarios WHERE email=? and password=?");
  $val = $email;
  $val2 = $password;
  mysqli_stmt_bind_param($prep,'ss',$val,$val2);
  // echo mysqli_stmt_errno($prep);
  // echo mysqli_stmt_error($prep);
  // echo mysqli_stmt_sqlstate($prep);
  if (mysqli_stmt_execute($prep)) {
    mysqli_stmt_bind_result($prep,$rid);
  if (mysqli_stmt_fetch($prep)) {
        $_SESSION["usuario"] = $rid;
        $correcto = true;

  } else{
      // echo "1 else";
      $correcto = false; // No hay resultados
  }
  } else{
      // echo "2 else";
      $correcto = false;// Error en consulta
  }
    mysqli_stmt_close($prep);
    return $correcto;

  DB_desconexion($db);
}

function email_registrado($email){
  $db = DB_conexion();
  $registrado = false;
  $prep = mysqli_prepare($db, "SELECT email FROM usuarios WHERE email=?");
  $val = $email;
  mysqli_stmt_bind_param($prep,'s',$val);

  if (mysqli_stmt_execute($prep)) {
      mysqli_stmt_bind_result($prep,$r_email);
    if (mysqli_stmt_fetch($prep)) {
          $registrado = true;
    }
  }
    mysqli_stmt_close($prep);

  DB_desconexion($db);

  return $registrado;
}

function insertar_usuario($nombre, $email, $foto, $contrasena, $tipo, $token){
  $db = DB_conexion();
  $correcto = false;

  $prep = mysqli_prepare($db, "INSERT INTO usuarios(nombre,email,foto,password,tipo,token) VALUES(?,?,?,?,?,?)");

  $val1 = $nombre;
  $val2 = $email;
  $val3 = $foto;
  $val4 = password_hash($contrasena, PASSWORD_DEFAULT);
  $val5 = $tipo;
  $val6 = $token;

  //echo $val3;
  mysqli_stmt_bind_param($prep,'ssssss',$val1, $val2, $val3, $val4, $val5, $val6);

  if (mysqli_stmt_execute($prep))
  {
    if (mysqli_affected_rows($db) > 0){
      $correcto = true;
      //echo "numero de filas afectado > 0";
    }
  }
  else{
    echo mysqli_stmt_error($prep);
  }

  DB_desconexion($db);

  return $correcto;
}

function comprobar_token($token){
  $db = DB_conexion();
  $nombre = "";

  $prep = mysqli_prepare($db, "SELECT nombre FROM usuarios WHERE token=?");

  $val1 = $token;

  mysqli_stmt_bind_param($prep,'s',$val1);

  if (mysqli_stmt_execute($prep))
  {
    mysqli_stmt_bind_result($prep,$nombre);
    mysqli_stmt_fetch($prep);
  }

  // if ($nombre != ""){
  //   echo "El enlace ha sido pulsado con el token correcto";
  //   $correcto = true;
  // }

  DB_desconexion($db);

  return $nombre;
}

function modificar_registrado($token){
  $db = DB_conexion();
  $cambiado = false;

  $prep = mysqli_prepare($db, "UPDATE usuarios SET registrado=? WHERE token=?");
  $val1 = 1;
  $val2 = $token;

  mysqli_stmt_bind_param($prep,'is',$val1, $val2);

  mysqli_stmt_execute($prep);

  return $cambiado;
}

function informacion_usuario($id,&$nombre,&$email,&$foto,&$password,&$tipo,&$registrado){

  $db = DB_conexion();
  $prep = mysqli_prepare($db,"SELECT nombre,email,foto,password,tipo,registrado FROM usuarios WHERE id=?");
  $val = $id;

  mysqli_stmt_bind_param($prep,'i',$val);
  // echo mysqli_stmt_errno($prep);
  // echo mysqli_stmt_error($prep);
  // echo mysqli_stmt_sqlstate($prep);
  if (mysqli_stmt_execute($prep)) {
    mysqli_stmt_bind_result($prep,$nombre,$email,$foto,$password,$tipo,$registrado);
  if (mysqli_stmt_fetch($prep)) {
    echo $nombre . $email;
        $correcto = true;
  } else{
      // echo "1 else";
      $correcto = false; // No hay resultados
  }
  } else{
      // echo "2 else";
      $correcto = false;// Error en consulta
  }
    mysqli_stmt_close($prep);
    return $correcto;

  DB_desconexion($db);

}

function informacion_usuario_2($id,&$tipo,&$registrado){
  informacion_usuario($id,$nombre,$email,$foto,$password,$tipo,$registrado);
}


?>
