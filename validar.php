<?php
/*
include("conexion.php");

if(isset($_POST['usuario']) && isset($_POST['password']))
{
  $usuario=$_POST['usuario']; 
  
  $password=md5($_POST['password']);
  
  $sql="SELECT * FROM usuario WHERE usuario ='$usuario'";
  $usuarios = consulta_mysql($sql);
  while( $item = mysql_fetch_array($usuarios))
  {
    if ( $item['password'] == $password)
      {
           $nombre=$item['nombre'];
           //$permiso=$item['permiso'];
            // crear sesion y guardar datos
            session_name("sesion_prest");
            // incia sessiones
            session_start();
            $_SESSION['sesion_usuario'] = $item['usuario'];
            $_SESSION['sesion_id'] = $item['id'];
            $_SESSION['sesion_nombre'] = $item['nombre'];
            $_SESSION['sesion_sucursal'] = $item['sucursal'];
            $_SESSION['sesion_permisos'] = $item['permiso'];
            
            echo "<script language=Javascript> location.href=\"panelcontrol.php\"; </script>";
            //echo "Acceso Correcto";
            exit();
            }
            else
                { //$mensaje='Password Incorrecto';
                 echo "<script language=Javascript> location.href=\"index.php?mensaje='Password Incorrecto'\"; </script>";
                 exit();
                 }
       }//fin while
      // $mensaje= 'Usuario no existente en la base de datos';
       mysql_free_result($usuarios);
       echo "<script language=Javascript> location.href=\"index.php?mensaje='Usuario no existente en la Base de Datos'\"; </script>";
       exit();
}else{
        //echo 'Debe especificar un usuario y password';
         echo "<script language=Javascript> location.href=\"index.php?mensaje='Debe especificar un Usuario y Password'\"; </script>";
    exit();
   }
*/


include("conexion.php");

if(isset($_POST['usuario']) && isset($_POST['password']))
{
  $usuario=$_POST['usuario']; 
  
  $password=md5($_POST['password']);
  
  $sql="SELECT * FROM usuario WHERE usuario ='$usuario'";
  
  $usuarios = consulta_mysql($sql);
  while( $item = mysqli_fetch_array($usuarios))
  {
    if ( $item['password'] == $password)
      {
          $nombre=$item['nombre'];
           //$permiso=$item['permiso'];
            // crear sesion y guardar datos
            session_name("sesion_prest");
            // incia sessiones
            session_start();
            $_SESSION['sesion_usuario'] = $item['usuario'];
            $_SESSION['sesion_id'] = $item['id'];
            $_SESSION['sesion_nombre'] = $item['nombre'];
            $_SESSION['sesion_sucursal'] = $item['sucursal'];
            $_SESSION['sesion_permisos'] = $item['permiso'];
            
            echo "<script language=Javascript> location.href=\"panelcontrol.php\"; </script>";
            //echo "Acceso Correcto";
            exit();
            }
            else
                { //$mensaje='Password Incorrecto';
                 echo "<script language=Javascript> location.href=\"index.php?mensaje='Password Incorrecto'\"; </script>";
                 exit();
                 }
       }//fin while
      // $mensaje= 'Usuario no existente en la base de datos';
       mysqli_free_result($usuarios);
       echo "<script language=Javascript> location.href=\"index.php?mensaje='Usuario no existente en la Base de Datos'\"; </script>";
       exit();
}else{
        //echo 'Debe especificar un usuario y password';
         echo "<script language=Javascript> location.href=\"index.php?mensaje='Debe especificar un Usuario y Password'\"; </script>";
    exit();
   }
?>
