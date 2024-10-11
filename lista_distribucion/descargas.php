 <!DOCTYPE html>
<html lang="es">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
    
    <title>eMe&Be</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.css" media="screen">
    <!--link rel="stylesheet" href="css/custom.min.css"-->
    <!--script type="text/javascript" async="" src="js/ga.js"></script-->
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <style>
    body { background-color: #e9e8e9; }
  </style>


  
  <link rel="stylesheet" href="../nivo/themes/dark/dark.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="../nivo/nivo-slider.css" type="text/css" media="screen" />
  <script type="text/javascript" src="../nivo/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="../nivo/jquery.nivo.slider.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158661797-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-158661797-1');
</script>
 
    
</head>
  <body>

    <div class="navbar navbar-expand-lg fixed-top " style="background-color: #2d84a9;">
      <div class="container">
       
       
      </div>
    </div>
    <br>
 

 <div class="container">

   <h1>eMe&Be</h1>



 <div class="col-md-12">
  <h4>Lista Distribución - Archivos</h4>
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

        
        <a href="archivo/<?php echo $archivo;?>" target="_blank">
        <span class="badge"><font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;">
        <?php echo $archivo;?>
        </font></font></span>
        </a>
        
      </li>
        
      <?
       
    }
  }
?>
    </ul>
    </div>
  </div>
</div>
