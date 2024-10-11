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

  require_once 'remito.php';
 
        if(isset($_POST['numero']) && !empty($_POST['numero']))
         {
          $numero= $_POST['numero'];

          $objecto = new remito();

          $listado = $objecto->consulta_datos_remito_hr($numero);

          while( $item = mysqli_fetch_array($listado))
          {
          ?>
          <ul class="list-group">
            <li class="list-group-item">Remito Nº : <?php echo $item['numero'];?></li>
            <li class="list-group-item">Hoja Ruta Nº : <?php echo $item['hojaruta'];?></li>
            <li class="list-group-item">Estado : <?php echo $item['hr_estado'];?></li>
             <li class="list-group-item">Chofer : <?php echo $item['chofer'];?></li>
             <li class="list-group-item">Camion : <?php echo $item['camion'];?></li>
          </ul>
           <?php
           } 
          
          $listado2 = $objecto->consulta_datos_remito_hri($numero);

          if (!$listado2) {
            ?>
               <p>Sin Hoja de Ruta Interna.</p>
            <?
          }

          while( $item = mysqli_fetch_array($listado2))
          {
          ?>
          <ul class="list-group">
            <li class="list-group-item">Hoja Ruta Interna Nº : <?php echo $item['numero_hri'];?></li>
            <li class="list-group-item">Estado : <?php echo $item['estado'];?></li>
            <li class="list-group-item">Chofer : <?php echo $item['chofer'];?></li>
            <li class="list-group-item">Camion : <?php echo $item['camion'];?></li>
          </ul>
           <?php
           } 
         }
?>
