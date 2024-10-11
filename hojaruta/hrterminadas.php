<?php
 //------------------
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
 //-----------------
 require_once 'hojaruta.php';
 ?>
      
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Chofer</th>
              <th>Camion</th>
              <th>Acoplado</th>
              <th>Destino</th>
               <th>Estado</th>
 <th>Total Valor Declarado</th>
              <th>Observación</th>
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new hojaruta();
          $usuarios = $objecto->listaterminados();
          $i=1;
          while( $item = mysqli_fetch_array($usuarios))
          {
          ?>
           <tr>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['nombrechofer'];?></td>
              <td><?php echo $item['patentecamion'];?></td>
              <td><?php echo$item['patenteacoplado'];?></td>
              <td><?php echo$item['provincia'];?></td>
              <td><?php echo$item['estado'];?></td>
               <td>
                  <?php
                       $totalvalordeclarado = $objecto->valordeclarado($item['numero']);

                        echo '$ '.number_format($totalvalordeclarado,2,",", ".");;
                  ?>
                    
              </td>
              <td><?php echo$item['observacion'];?></td>
              <td>
                 <a href="verHR.php?id=<?php echo $item['numero'];?>" class="btn btn-primary btn-sm" > Ver</a>
                <a href="imprimir.php?idhr=<? echo $item['numero']; ?>" class="btn btn-primary btn-sm"> Imprimir</a>
                  <a href="zonas.php?idhr=<? echo $item['numero']; ?>" class="btn btn-primary btn-sm"> Zonas</a>
              </td>
          </tr>
          <?php
           }
          ?>
          </tbody>
         </table>
         