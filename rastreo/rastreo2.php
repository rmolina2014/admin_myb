<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>eme&eb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <!--link rel="stylesheet" href="css/custom.min.css"-->
    <!--script type="text/javascript" async="" src="js/ga.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script-->
    <style>
    body { background-color: #e9e8e9; }
  </style>


  <link rel="stylesheet" href="nivo/themes/dark/dark.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="nivo/nivo-slider.css" type="text/css" media="screen" />
  <script type="text/javascript" src="nivo/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="nivo/jquery.nivo.slider.js"></script>
 
    
</head>
  <body>

    <div class="navbar navbar-expand-lg fixed-top " style="background-color: #2d84a9;">
      <div class="container">
        <a href="index.html" class="navbar-brand">eMe&Be</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="nav ml-auto" style="color:#EB8125;">
           <!--ul class="nav justify-content-center" style="color:#EB8125;"-->  
            <!--li class="nav-item dropdown">
              <a class="nav-link" href="#quienesomos" id="themes">Quienes Somos
              </a>
             
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#calidad">Política de Calidad</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#depositos">Depositos</a>
            </li-->
            <li class="nav-item">
              <a class="nav-link" href="index.html">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rastreo.html">Rastreo de Envios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacto.html">Contacto</a>
            </li>
          </ul>

        </div>
      </div>
    </div>
    <br>
     <br>
      <br>
       <br>

<div style="background:#f3f3f3;">
  
 <div class="container">
   <div class="row">
    <div class="col-md-12">
     <h3>Remitos</h3>
     <hr>
     <table id="listado" class="table" >
          <thead>
             <tr>
              <th>Nº</th>
              <TH>Cliente </TH>
              <TH>Proveedor </TH>
              <TH>Valor Declarado </TH>
              <TH>Tipo Comprobante  </TH>
              <TH>Valor Contrareembolso </TH>
              <TH>Fecha </TH>
              <TH>Bultos </TH>  
               <TH> Descripción</TH> 
              <TH> Estado</TH>  
              <TH> Fecha Ingreso</TH> 
              <TH> Ultima Fecha </TH> 
              <th>Cantidad de dias</th>   
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          error_reporting(E_ALL);
ini_set('display_errors', '1');
         // require_once 'admin/conexion.php';
         function consulta_mysql($sql){
$conexion = mysqli_connect("localhost","mblogist_admin2020","+qazx2020","mblogist_admin2020");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit; 
  }
 $result = mysqli_query($conexion,$sql);
 /* esto duplica if (!mysqli_query($conexion,$sql))
  {
  echo("Errorcode: ".mysqli_errno($conexion));
  exit;
  }*/
 return $result;  
}
if(isset($_GET['id']) && !empty($_GET['id']))
 {
     $idcliente= (int)$_GET['id'];

  //sacar cuit
  $sql="SELECT cuit from cliente where id=$idcliente";
  $listado = consulta_mysql($sql);
  $item = mysqli_fetch_array($listado);
  $cuitcliente= $item['cuit'];  

  if ($cuitcliente=='00-00000000-0')
      { $sql="SELECT * from remito where idcliente=".$idcliente." or idproveedor=".$idcliente; 
      
      }
       else 
             {  $sql="SELECT * from remito where idcliente = '$idcliente' or idproveedor = '$idcliente' OR cuitcliente ='$cuitcliente' OR cuitproveedor = '$cuitcliente'";
             
             }

  //  SELECT * FROM remito WHERE idcliente='3743' OR idproveedor='3743' OR cuitcliente LIKE '33-71173058-9' OR cuitproveedor LIKE '33-71173058-9' 
 // $sql="SELECT * from remito where idcliente=".$idcliente." or idproveedor=".$idcliente;
  //$sql="SELECT * from remito where idcliente = '$idcliente' or idproveedor = '$idcliente' OR cuitcliente LIKE '$cuitcliente' OR cuitproveedor like '$cuitcliente'";
     
  $listado = consulta_mysql($sql);
  while( $item = mysqli_fetch_array($listado))
  {
 ?>
           <tr>
             <td><?php echo $item['numero'];?></td>
             <td><?php echo $item['nomcliente'];?></td>
             <td><?php echo $item['nomproveedor'];?></td>
             <td><?php echo $item['valordeclarado'];?></td>
             <td><?php echo $item['tipocomprobante'];?></td>
             <td><?php echo $item['contrareembolso'];?></td>
             <td><?php echo $item['fecha'];?></td>
             <td><?php echo $item['bultos'];?></td>
             <td><?php echo $item['descripcion'];?></td>
             <td><?php echo $item['estado'];?></td>
             <td><?php echo $item['fechaingreso'];?></td>
             <td><?php echo $item['fechaestado'];?></td>
             <td><?php 
                    $fechaEstado=$item['fechaestado'];
                    $fechaIngreso=$item['fechaingreso'];
                    $segundos=strtotime($fechaEstado) - strtotime($fechaIngreso);
                    $diferencia_dias=intval($segundos/60/60/24);
                    echo "<b>".$diferencia_dias."</b>";
              ?>
               </td>
          </tr>
          <?php
           }
           } 
          ?>
          </tbody>
         </table>
     </div>
     </div>
     </div>

  <!-- fin del contenido principal-->
<div id="footer">
<div class="container">
 <div class="col-md-12">
  <hr>
  <h4><strong>Sur Express S.A.</strong></h4>
  </div>
  <div class="col-md-6">
       <address> <strong>Deposito San Juan</strong><br> Perona 363 Este<br> Rawson<br> Telefono: (0264) 424-0770</address> <address> <strong>Email:</strong><br> <a href="mailto:#">info@surexpresssa.com.ar</a></address>
     <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6798.162041540761!2d-68.52590900000001!3d-31.576826!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaac3063c996f3d07!2sSur+Express+S.A.!5e0!3m2!1ses!2sus!4v1440387016553" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
   <div class="col-md-6">
           <address> <strong>Deposito Bs AS</strong><br> 
           Carlos Maria Ramirez 2204<br>
           Pompeya - Cap. Federal<br> Tel. Fax: (011) 49180371 - 49189939 </address> <address> <strong>Email:</strong><br> <a href="mailto:#">depositobsas@surexpresssa.com.ar</a></address>
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.848041284211!2d-58.4286339!3d-34.6585404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccb9a8033c17d%3A0x3182b7215930fb4d!2sTransporte+Sur+SRL!5e0!3m2!1ses-419!2sar!4v1440938755397" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    </div>
</div>
</div>
</body>
</html>