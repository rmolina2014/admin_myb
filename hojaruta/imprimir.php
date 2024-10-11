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

require_once '../remito/remito.php';

include '../cabecera.php';



?>

<style type="text/css" media="print">

@media print {

  body { 
         font-size:18px;
         }

         table {
    font-size: 14px;
}

#noimprimir {display:none;}

#parte2 {display:none;}

}

</style>

<?

function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);

//si viniera en otro formato, adaptad el explode y el orden de las variables a lo que necesitéis

//creamos un objeto DateTime (existe desde PHP 5.2)

    $fecha = new DateTime();

//definimos la fecha pasándole las variabes antes extraídas

        $fecha->setDate($yy, $mm, $dd);

//y ahora el propio objeto nos permite definir el formato de fecha para imprimir que queramos       

    echo $fecha->format('d-m-Y');

}

if( isset($_GET['idhr']) && !empty($_GET['idhr']) )

{

  $idhr= $_GET['idhr'];

?>
 <div class="container">
 <div class="row">
  <h3>Hoja de Ruta Nº : <?echo $idhr;?></h3>
  <div class="col-xs-12">
   <?  
     $objecto = new hojaruta();

     $usuarios = $objecto->cabecerahr($idhr);

     while( $item = mysqli_fetch_array($usuarios))

     {
          $observacion=$item['observacion']
     ?> 

     <div class="row">

       <div class="col-xs-4">

        <label> Chofer : <?echo $item['nombrechofer'];?> </label>

        <label> Carnet : <?echo $item['carnetchofer'];?> </label>

       </div>

       <div class="col-xs-4">

         <label> Patente Camion : <?echo $item['patentecamion'];?> </label>

         <label> Patente Acoplado : <?echo $item['patenteacoplado'];?> </label>

        </div>  

        <div class="col-xs-4">

         <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label>

          <label> Destino : <?echo $item['provincia'];?> </label>

        </div>  



      <?}?>

 </div>

     <h4>Detalle</h4>



<div class="col-xs-12">

  <table class="table table-condensed">

      <thead>

             <tr>

              <th>Fecha</th>

              <th>Nº</th>

              <TH>Cliente </TH>

              <TH>Proveedor </TH>

              <TH>Bultos</TH>

              <th>Descripción</th>

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

              <td><?php echo $item['bultos'];?></td>

             <td><?php echo $item['descripcion'];?></td>

           

          </tr>

          <?

           } 

          ?>

          <tr>

          

          <td colspan="6">Fin del Listado</td></tr>

          <tr><td colspan="6"><?echo "Observaciones : ".$observacion; ?> </td></tr>

          </tbody>

         </table>

         <h4>Total Declarado : <?
       $totalvalordeclarado = $objecto->valordeclarado($idhr);

                        echo '$ '.number_format($totalvalordeclarado,2,",", ".");;
       ?></h4>

        <!--fin listado remitos-->

</div>
 <!--fin listado remitos-->
<div id='noimprimir'>
 <a href="listado.php">Listado</a>
</div>
</div>
<?}?>



