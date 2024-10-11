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
 require_once 'hojarutainterna.php';
 ?>
      
         
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>Nº</th>
              <th>Fecha</th>
              <th>Chofer</th>
              <th>Camion</th>
              <th>Estado</th>
              <th></th>
             </tr>
           <thead>

           <tbody>

          <?php

          $objecto = new hojarutainterna();

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

               <td><?php echo $item['estado'];?></td>

              <td>

             
                              <a href="verHRI.php?id=<?php echo $item['numero'];?>" class="btn btn-primary btn-sm" > Ver</a>


                  <a href="imprimir.php?idhrint=<? echo $item['numero']; ?>" class="btn btn-primary btn-sm"> Imprimir</a>

                  <!--a class="btn btn-primary btn-sm" id="borrar<?php echo $item['numero'];?>" > Borrar</a-->

              </td>

          </tr>

          <?php

           }

          ?>

          </tbody>

         </table>