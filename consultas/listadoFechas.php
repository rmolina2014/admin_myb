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
   <div class="row">
    <div class="col-md-12">
     <h3>Listado por Fecha</h3>
      <hr>
      <div class="row">
          <div class="col-md-12">
           <div id="div_dinamico">
                
           <h4>Datos del Remito</h4>
            <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
              <thead>
                 <tr>
                  <th>Nº</th>
                  <TH> Cliente </TH>
                  <TH> Fecha Ultimo Remito</TH> 
                  <TH> Cantidad Dias</TH>  
                </tr>
               <thead>
               <tbody>
                <?
                 	//24112015 clientes con remitos 
                  $sql="SELECT DISTINCT idcliente,nomcliente FROM remito"; 
          		  $registro = consulta_mysql($sql);
                  $i=0;
                  $fechaactual=date('Y-m-d');
                  $listaClientes = array();
                  while( $item = mysqli_fetch_array($registro))
                  {
                   $id = $item['idcliente'];  
                   $cliente= $item['nomcliente'];
                   // sacar la ultima fecha de envio del cliente
                   $sql="SELECT MAX(fechaingreso) AS ultimafecha FROM remito WHERE idcliente=".$item['idcliente']; 
                   $registro1 = consulta_mysql($sql);
                   $item1 = mysqli_fetch_array($registro1);  
                   $fecha= $item1['ultimafecha']; 
                   
                   $segundos=strtotime($fecha) - strtotime('now');
                   $diferencia_dias=intval($segundos/60/60/24)*-1;

                  $listaClientes[$i++] = array('id'=>$id, 'cliente'=>$cliente,'fecha'=>$fecha,'diferencia_dias'=>$diferencia_dias);
                  }
                  //ordenar arreglos 
                  foreach ($listaClientes as $key => $row)
                  {
                     $aux[$key] = $row['diferencia_dias'];
                  }

                  array_multisort($aux, SORT_DESC, $listaClientes);
                  // listar archivo
                  foreach ($listaClientes as $key => $row)
                  {
                  ?>
                   <tr>
                      <td><?php echo $row['id']?></td>
                      <td><?php echo $row['cliente'];?></td>
                      <td><?php echo $row['fecha'];?></td>
                      <td><?php echo $row['diferencia_dias'];?></td>
                  </tr>
                  <?
                   }
                 
                  ?>
              </tbody>
             </table>
                
 </div>
 <!-- /. ROW  -->
 </div><!-- /. PAGE INNER  -->
 </div><!-- /. PAGE WRAPPER  -->
 </div> <!-- /. WRAPPER  -->
 </body>
</html>
