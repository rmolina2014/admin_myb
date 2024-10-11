<?php
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
   $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
     $permiso=$_SESSION['sesion_permisos'];
 }
  else { header ("Location: ../index.php"); }
 
include '../cabecera.php';

$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Aceptar')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    //$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
     $newFileName =  $fileName;//. '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'pdf', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './archivo/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='El archivo se cargó correctamente.';
      }
      else 
      {
        $message = 'Hubo algún error al mover el archivo al directorio de carga. Asegúrese de que el servidor web pueda escribir en el directorio de carga.';
      }
    }
    else
    {
      $message = 'Subida fallida. Tipos de archivo permitidos: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'Hay algún error en la carga del archivo. Por favor revise el siguiente error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
  
  $_SESSION['message'] = $message;
  //header("Location: index.php");
  echo "<script language=Javascript> location.href=\"index.php\"; </script>";
 
}
else
{
?>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
<br>
<br>
 <h4>Lista Distribución</h4>
 
  <form method="POST" action="index.php" enctype="multipart/form-data">
    <div class="col-md-8">
      <span> Archivo:</span>
      <input type="file" class="form-control" name="uploadedFile" />
    </div>
    <div class="col-md-8">
      <input type="submit"class="btn btn-small btn-primary " name="uploadBtn" value="Aceptar" />
    </div>
  </form>
  </div>
  <br>
  <div class="col-md-12">
  <h4>Listado de Archivos</h4>
  <br>
  <div class="col-md-8">
  <div class="bs-component">
    <ul class="list-group">    
  
  <?php 
 
  $ruta='archivo/';//$_GET['ruta'];
 
  $directorio = opendir($ruta); //ruta actual
  while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
  {
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
       // echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
    }
    else
    {
      ?>
      <li class="list-group-item">

        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        <?php echo $archivo;?>
        </font></font>
        <a href="borrar.php?id=<?php echo $archivo;?>">
        <span class="badge"><font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;">
        Borrar
        </font></font></span>
        </a>
        
      </li>
        <!--p>  
        <label ><?php echo $archivo;?></label>
        
        <a href="borrar.php?id=<?php echo $archivo;?>">Borrar</a>
      </p-->
      <?
       
    }
  }
?>
    </ul>
    </div>
  </div>
</div>
<?php 
}
?>