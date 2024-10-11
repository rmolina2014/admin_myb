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

require_once 'hojaruta.php';
include '../cabecera.php';


function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}

if( isset($_GET['idhr']) && !empty($_GET['idhr']) )
{
  $idhr= $_GET['idhr'];
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

  <div class="container">
  <div class="row">
   <h4>Zonas Por Hoja de Ruta</h4>
   <div class="col-md-12">
   <?
     $objecto = new hojaruta();
     $listado = $objecto->zona_cliente($idhr);
     
     ?>
        <div class="row">
         <H4> Hoja de Ruta Nº : <?echo $idhr; ?> </h4>
          <br>
        </div>
  
     </div>
      <h3>Detalle : </h3>
      <div class="col-md-12">
         <table id="listado" class="table" >
            <thead>
             <tr>
              <th>Nº</th>
              <TH>Cliente </TH>
              <TH>Domicilio </TH>
              <TH>Zona </TH>
              <TH>Remito </TH>
              <TH>Bultos</TH>
              <th></th>
             </tr>
       <thead>
       <tbody>
        <?
          $i=0;
          while( $item = mysqli_fetch_array($listado))
          {
             $i++;
         ?>
           <tr>
              <td><?php echo $i; ?> </td>
              <td><?php echo $item['nombre'];?></td>
              <td><?php echo $item['domicilio'];?></td>
              <td><?php echo $item['zona'];?></td>
              <td><?php echo $item['remito_numero'];?></td>
              <td><?php echo $item['bultos'];?></td>
             
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
        <!--fin listado remitos-->
       <hr>
<?
           }
          ?>
<div id='noimprimir'>
 <a href="listado.php">Listado</a>
</div>
