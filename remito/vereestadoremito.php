<?php

 //------------------

 session_name("sesion_prest");

 session_start();

 if (isset($_SESSION['sesion_usuario']))

 {

   $ID= $_SESSION['sesion_id'];

   $nombre=$_SESSION['sesion_usuario'];

   $sucursal=$_SESSION['sesion_sucursal'];

 }

  else { header ("Location: ../index.php"); }

 //-----------------

 require_once 'remito.php';

 include '../cabecera.php';

 ?>  

 <div class="container-fluid">

   <div class="row">

    <div class="col-md-12">

     <h3>Estado de Remitos</h3>

     <div id="div_dinamico">

        

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

              <TH> Fecha</TH>    

              <th></th>

             </tr>

           <thead>

           <tbody>

          <?php

          $objecto = new remito();

          $listado = $objecto->verestado(20);

          $i=1;

          while( $item = mysqli_fetch_array($listado))

          {

          ?>

           <tr>

             <td><?php echo $item['numero'];?></td>

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

              <td><?php echo $item['fechaestado'];?></td>

            

          </tr>

          <?php

           } 

          ?>

          </tbody>

         </table>

         </div>

         </div>

</div>

 </div>



<footer>

  Administración 2015

</footer>

</body>

</html>