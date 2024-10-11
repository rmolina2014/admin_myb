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
//require_once 'remito.php';
 include '../cabecera.php';
 include '../hojaruta/hojaruta.php';
 require_once '../conexion.php';
 ?>  
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Consultas</h3>
     <hr>
        <span class="label label-default"><a href="historial.php"><strong>Historial Remito</strong></a></span>
       <span class="label label-default"><a href="listadoHojaRuta.php"> <strong>Hoja de Ruta - Detalle </strong> </a></span>
       <span class="label label-default"><a href="listadoFechas.php"> <strong>Clientes Fechas</strong> </a></span>
       <span class="label label-default"><a href="listadoHR_Rosario.php"> <strong>Consultas Rosario</strong> </a></span>
       <span class="label label-default"><a href="listadoBS_Rosario.php"> <strong>Consultas Buenos Aires </strong> </a></span>

   </div>

<div class="col-md-12">  
<h3>Buscar Detalle de Hoja de Ruta</h3>
      <hr>

       <div class="row">
         <div class="col-md-12">
          <form role="form" method="POST" class="form-horizontal" action="listadoHojaRuta.php">
            <div class="col-md-2">
            <label >Número Hoja de Ruta</label>
            </div>
            <div class="col-md-4">
             <input type="text" id="numero" name="numero" class="form-control" tabindex="1" autofocus required/>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i> Buscar</button>
            </div>
           </form>
         </div>
       </div>  
  </div>

<?

function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}

if( isset($_POST['numero']) && !empty($_POST['numero']) )
{
  $idhr= $_POST['numero'];
  
     $objecto = new hojaruta();
     $usuarios = $objecto->cabecerahr($idhr);
     while( $item = mysqli_fetch_array($usuarios))
     {
     ?>

<div class="col-md-12"> 
      <h4>Hoja de Ruta</h4>
        <hr>
       <div class="row">
        <div class="col-md-12">
           <!-- Listado de remitos -->
           <table id="listado" class="table" >
            <thead>
                   <tr>
                    <th>Número</th>
                    <th>Fecha</th>
                    <TH>Destino </TH>
                    
                    <th>Estado</th>
                    <th></th>
                   </tr>
             <thead>
             <tbody>
              <tr>
                       
              <td><?echo $numeroHR=$item['numero'];?></td>
              <td><?echo cambiaf_mysql($item['fecha']) ;?></td>
              <td><?echo $sucursal;?></td>
              <td><?php echo $item['estado'];?></td>
             
          </tr>
          </tbody>
          </thead>
          </table>




     <?
     }
     ?>
     </div>
      </div>

     <h4>Detalle</h4>
     <hr>
     <div class="row">
     <div class="col-md-12">
     <!-- Listado de remitos -->
     <table id="listado" class="table" >
      <thead>
             <tr>
              <th>Fecha</th>
              <th>Nº</th>
              <TH>Cliente </TH>
              <TH>Proveedor </TH>
              <TH>Valor Declarado </TH>
              <th>Estado</th>
              <th></th>
             </tr>
       <thead>
       <tbody>
        <?
          $usuarios = $objecto->listaremito($idhr);
          while( $item = mysqli_fetch_array($usuarios))
          {
         ?>
           <tr>
                       
              <td><?php echo cambiaf_mysql($item['fecha']);?></td>
              <td><?php echo $item['numeroremito'];?></td>
              <td><?php echo $item['nombrecliente'];?></td>
              <td><?php echo $item['nombreproveedor'];?></td>
              <td><?php echo $item['valordeclarado'];?></td>
              
              <td><?php echo $item['estado'];?></td>
             
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
         <h6>Fin Listado</h6>    
        <!--fin listado remitos-->
      <?
       }
      ?>
 </div>
 </div>
  






<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $(document).ready(function()
  {
    

 });
</script>
</div>
</div>
</div>
</div>

