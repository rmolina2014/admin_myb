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

require_once 'liquidacionfletero.php';

require_once '../remito/remito.php';

include '../cabecera.php';

?>

<style type="text/css" media="print">

@media print {

body { font-size:10px; }

#noimprimir {display:none;}

#parte2 {display:none;}

}

</style>

<?

function cambiaf_mysql($fechadb){

    list($yy,$mm,$dd)=explode("-",$fechadb);

    $fecha = new DateTime();

    $fecha->setDate($yy, $mm, $dd);

    echo $fecha->format('d-m-Y');

}



if( isset($_GET['idhrint']) && !empty($_GET['idhrint']) )

{

  $idhr= $_GET['idhrint'];

?>

 <div class="container">

 <div class="row">



  <h3>Hoja de Ruta Interna Nº : <?echo $idhr;?></h3>

  <div class="col-xs-12">

    <?

     $objecto = new liquidacionfletero();

     $listado = $objecto->cabecerahr($idhr);

     while( $item = mysqli_fetch_array($listado))

     {
     ?>
      <div class="row">

        <div class="col-xs-4">
        <label> Fecha : <?echo $item['fecha'];?> </label>
        </div>
         <div class="col-xs-4">
        <label> Chofer : <?echo $item['nombrechofer'];?> </label>
         </div>
         <div class="col-xs-4">
        <label> Patente Camion : <?echo $item['patentecamion'];?> </label>
        </div>

      </div>

      <?}?>

     </div>



     <h4>Detalle</h4>
  <div class="col-xs-12">
    <table class="table table-bordered">
      <thead>
             <tr>
              <th>Fecha</th>
              <th>Nº</th>
              <TH>Cliente </TH>
              <TH>Proveedor </TH>
              <TH>Bultos</TH>
              <th>Descripción</th>
              <th>Nº Sur Express</th>
              <th>Importe</th>
              <th>Importe Fletero</th>
              <th>Importe Dividido en 1.21</th>
             </tr>
       <thead>
       <tbody>
        <?
          // variable sumador
          $neto = 0;
          $usuarios = $objecto->listaremito($idhr);

          while( $item = mysqli_fetch_array($usuarios))
          {
         ?>
           <tr>
              <td><?php echo cambiaf_mysql($item['fecha']);?></td>
              <td><?php echo $item['numeroremito'];?></td>
              <td><?php echo $item['nombrecliente'];?></td>
              <td><?php echo $item['nombreproveedor'];?></td>
              <td><?php echo $item['bultos'];?></td>
             <td><?php echo $item['descripcion'];?></td>
             <td><?php echo $item['remitose'];?></td>
             <td><?php echo $item['importe'];?></td>
             <td><?php echo $item['importefletero'];?></td>
             <td>
                <?php
                   if ($item['importefletero'] > 0)
                   {
                     echo $a = round(($item['importefletero']/1.21),2);
                     $neto = $neto + $a;
                   }
                  
                ?>
                  
              </td>
          </tr>
          <?
           }
          ?>
          <tr>
            <td colspan="9">Fin del Listado</td>
            <td><?php echo "Total: ".$neto;?></td>
          </tr>
          </tbody>
         </table>
        <!--fin listado remitos-->
</div>



 <!--fin listado remitos-->

<div id='noimprimir'>
 <a href="listado.php">Listado</a>
</div>
</div>

<?}?>

