<?php
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
  $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
    $permiso=$_SESSION['sesion_permisos'];
 } else { header ("Location: ../index.php"); }

require_once 'hojarutainterna.php';
require_once '../remito/remito.php';
include '../cabecera.php';
function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}



if( isset($_GET['id']) && !empty($_GET['id']) )

{

  $idhrint= $_GET['id'];

?>

 <div class="container">

 <div class="row">

  <h4>Hoja de Ruta Interna</h4>

  <div class="col-md-12">

   <?

     $objecto = new hojarutainterna();

     $listado = $objecto->cabecerahr($idhrint);

     while( $item = mysqli_fetch_array($listado))

     {

     ?>

      <div class="row">

        <label> Numero : <?echo $numeroHRI=$item['numero'];?> </label>

        <label> Fecha : <?echo $item['fecha'];?> </label><br>

        <label> Chofer : <?echo $item['nombrechofer'];?> </label>

        <label> Patente Camion : <?echo $item['patentecamion'];?> </label><br>

      </div>

      <?}?>

     </div>

     <h4>Detalle</h4>

<div class="col-md-12">

 <!-- Listado de remitos -->

 <table id="listado" class="table" >

      <thead>

             <tr>

              <th>Fecha</th>

              <th>Nº guia</th>

              <TH>Destinatario </TH>

              <TH>Proveedor </TH>

              <TH>Bultos</TH>

              <th>Descripción</th>

               <th>Nº Sur Exp.</th>
              <th>Importe</th>

             </tr>

       <thead>

       <tbody>

        <?

          $usuarios = $objecto->listaremito($idhrint);

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
             <!--td> x </td-->

          </tr>

          <?

           }

          ?>

          </tbody>

         </table>

        <!--fin listado remitos-->

</div>

<!--fin listado remitos-->

<div>



 <a href="imprimir.php?idhrint=<? echo $idhrint; ?>" class="btn btn-primary btn-sm"> Imprimir</a>

</div>



</div>

</div>

</div>

</div>

</div>

<?}?>

