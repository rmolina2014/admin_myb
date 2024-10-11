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
      

   </div>
    <div class="col-md-12">
     <h3>Historial</h3>
      <hr>

       <div class="row">
	       <div class="col-md-12">
	        <form role="form" method="POST" class="form-horizontal" action="historial.php">
	          <div class="col-md-4">
	          <label >Número Remito</label>
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
      <hr>
      <?
       if( isset($_POST['numero']) && !empty($_POST['numero']) )
       {
       	$numero=$_POST['numero'];
       	$sql="SELECT * FROM `remito` WHERE `numero`='$numero'"; 
				$registro = consulta_mysql($sql);
        ?>
        <div class="row">
    	   <div class="col-md-12">
           <div id="div_dinamico">
                
           <h4>Datos del Remito</h4>
            <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
              <thead>
                 <tr>
                  <th>Nº</th>
                  <TH>  Cliente </TH>
                  <TH>  Dir. Cliente  </TH>
                  <TH>  Cuit cliente  </TH>
                  <TH>  Proveedor </TH>
                  <TH>  Dir. Proveedor  </TH>
                  <TH>  Cuit Proveedor  </TH>
                  <TH>  Valor Declarado </TH>
                  <TH>  Tipo Comprobante  </TH>
                  <TH>  Valor Contrareembolso </TH>
                  <TH>  Fecha </TH>
                  <TH>  Bultos </TH>  
                  <TH> Descripcion</TH> 
                  <TH> Estado</TH>
                  <TH> Fecha Ingreso</TH> 
                  <TH> Fecha del Estado</TH>  

                </tr>
               <thead>
               <tbody>
              <?php
              $remitoId=0;
              while( $item = mysqli_fetch_array($registro))
              {
              ?>
               <tr>
                  <td>
                  <?php 
                  echo $item['numero'];
                  $remitoId=$item['id'];
                  ?></td>
                  <td><?php echo $item['nomcliente'];?></td>
                  <td><?php echo $item['dircliente'];?></td>
                  <td><?php echo $item['cuitcliente'];?></td>
                  <td><?php echo $item['nomproveedor'];?></td>
                  <td><?php echo $item['dirproveedor'];?></td>
                  <td><?php echo $item['cuitproveedor'];?></td>
                  <td><?php echo $item['valordeclarado'];?></td>
                  <td><?php echo $item['tipocomprobante'];?></td>
                  <td><?php echo $item['contrareembolso'];?></td>
            	  	 <td><?php echo $item['fecha'];?></td>
          			  <td><?php echo $item['bultos'];?></td>
          			  <td><?php echo $item['descripcion'];?></td>
            			<td><?php echo $item['estado'];?></td>
                  <td><?php echo $item['fechaingreso'];?></td>
                  <td><?php echo $item['fechaestado'];?></td>
              </tr>
              <?php
               } 
              ?>
              </tbody>
             </table>
             <?
              if($remitoId > 0)
              {

             ?>
            <h4>Hoja de Ruta</h4>
            <?
             $sql="SELECT DISTINCT hojaruta.`id`,hojaruta.`estado`,hojaruta.`fecha`
                	 FROM`hojaruta`
                	 INNER JOIN `detallehr` 
                   ON (`hojaruta`.`id` = `detallehr`.`idhojaruta`) WHERE detallehr.`idremito`='$remitoId';"; //0003-001643' ";
    		  		$registro = consulta_mysql($sql);
            ?>
             <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
              <thead>
                 <tr>
                  <th>Nº</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                 </tr>
               <thead>
               <tbody>
              <?php
              while( $item = mysqli_fetch_array($registro))
              {
              ?>
               <tr>
                  <td><?php echo $item['id'];?></td>
                  <td><?php echo $item['fecha'];?></td>
                  <td><?php echo$item['estado'];?></td>
               </tr>
              <?php
               }
              ?>
              </tbody>
             </table>


            <h4>Hoja de Ruta Interna</h4>
            <?
             $sql="SELECT hojarutainterna.`id`, hojarutainterna.`estado`, hojarutainterna.`fecha`
                   FROM `detalleinterna`
    			         INNER JOIN `hojarutainterna` 
    			         ON (`detalleinterna`.`idinterna` = `hojarutainterna`.`id`)
    			         WHERE `detalleinterna`.`idremito`='$remitoId'"; 
    					$registro = consulta_mysql($sql);
            ?>
              <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
              <thead>
                 <tr>
                  <th>Nº</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                 </tr>
               <thead>
               <tbody>
              <?php
              while( $item = mysqli_fetch_array($registro))
              {
              ?>
               <tr>
                  <td><?php echo $item['id'];?></td>
                  <td><?php echo $item['fecha'];?></td>
                  <td><?php echo$item['estado'];?></td>
               </tr>
              <?php
               }
              ?>
              </tbody>
             </table>
          </div>
         </div>
        </div>
        <?php
           }
           } //fin del if 
          ?>

 </div>
 <!-- /. ROW  -->

 </div><!-- /. PAGE INNER  -->
 </div><!-- /. PAGE WRAPPER  -->
 </div> <!-- /. WRAPPER  -->