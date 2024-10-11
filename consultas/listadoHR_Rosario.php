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
   </br>
   <div class="row">
    <div class="col-md-12">
     <h3>Listado de Hojas de Ruta de Rosario</h3>
      <hr>
        <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
              <thead>
                 <tr>
                  <th>Nº</th>
                  <TH> Fecha</TH> 
                  <TH> Estado</TH>  
                </tr>
               <thead>
               <tbody>
                <?
                    /*
                      consultas
                      SELECT * FROM hojaruta WHERE origen='Rosario'

SELECT id,nomcliente,cuitcliente,nomproveedor,cuitproveedor,idcliente,idproveedor,numero,fechaingreso FROM remito WHERE origen='Rosario' ORDER BY fechaingreso DESC
  
                    */

                 	//24112015 clientes con remitos 
                 $sql="SELECT * FROM hojaruta WHERE origen='Rosario'"; 
          				$registro = consulta_mysql($sql);
                  
                  while( $item = mysqli_fetch_array($registro))
                  {
                 
                  ?>
                   <tr>
                      <td><?php echo $item['id']?></td>
                      <td><?php echo $item['fecha'];?></td>
                      <td><?php echo $item['estado'];?></td>
                  </tr>
                  <?
                   }
                  ?>
              </tbody>
             </table>
                
 </div>
 </div>
 