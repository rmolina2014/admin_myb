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
  $idhr= $_GET['id'];
?>

 <div class="container">

 <div class="row">

  <h4>Hoja de Ruta</h4>

  <div class="col-md-12">

   <?

     $objecto = new hojaruta();

     $usuarios = $objecto->cabecerahr($idhr);

     while( $item = mysqli_fetch_array($usuarios))

     {

       $observacion=$item['observacion'];

     ?>

        <div class="row">

         <label> Numero : <?echo $numeroHR=$item['numero'];?>         Origen : <?echo $item['origen'];?> </label><br>

         <div class="col-md-4">

       <label> Chofer : <?echo $item['nombrechofer'];?> </label><br>

       <label> Carnet : <?echo $item['carnetchofer'];?> </label><br>

       </div>

        <div class="col-md-4">

         <label> Patente Camion : <?echo $item['patentecamion'];?> </label><br>

         <label> Patente Acoplado : <?echo $item['patenteacoplado'];?> </label><br>

        </div>

        <div class="col-md-4">

         <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>

          <label> Destino : <?echo $item['provincia'];?> </label><br>

        </div>

      <?}?>

     </div>

<h3>Detalle</h3>

<div class="col-md-12">

<!-- Button trigger modal -->

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">

  Agregar Remito

</button>



 <!-- Listado de remitos -->

 <input type="hidden" value="<?echo $numeroHR;?>" name="numeroHR" id="numeroHR"/>  

 <table id="listado1" class="table" >
      <thead>
             <tr>
              <th>Fecha</th>
              <th>Nº</th>
              <TH>Cliente </TH>
              <TH>Proveedor </TH>
              <TH>Bultos</TH>
              <th>Descripción</th>
              <th></th>
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
             <td> 
                <a class="btn btn-primary btn-sm" id="borrar<?php echo $item['remitoid'];?>" > X</a>
              </td>
          </tr>
          <?
           }
          ?>
          <tr><td colspan="6"><? echo "Observaciones : ".$observacion;?></td></tr>  
          </tbody>
         </table>
<div>
 <a href="cambiarestadoHR.php?id=<? echo $numeroHR;?>&estado=Pendiente" class="btn btn-primary btn-sm">Guardar</a>
</div>
</div>
<!-- Modal -->



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remitos</h4>
      </div>
      <div class="modal-body">
       <!--listado de remitos en deposito bss as-->
       <table id="listado" class="table" >
         <thead>
             <tr>
              <th>Nº</th>
              <TH>  Cliente </TH>



              <TH>  Proveedor </TH>



              <TH>  Fecha </TH>



              <th></th>



             </tr>



           <thead>



           <tbody>



          <?php



          $objecto = new remito();



          $listado = $objecto->listaremitohr();



          $i=1;



          while( $item = mysqli_fetch_array($listado))



          {



          ?>



           <tr>



              <td><?php echo $item['numero'];?></td>



              <td><?php echo $item['nomcliente'];?></td>



              <td><?php echo $item['nomproveedor'];?></td>



              <td><?php echo $item['fecha'];?></td>



              <td>



                  <!--a class="btn btn-primary btn-sm" id="editar<?php echo $item['id'];?>" > Editar</a-->



                  <a class="btn btn-primary btn-sm"  href="agregarremito.php?hr=<?php echo $idhr;?>&remito=<?php echo $item['id'];?>" > Agregar</a>



              </td>



          </tr>



          <?php



           }



          ?>



          </tbody>



         </table>



        <!--fin listado remitos-->



      </div>



      <div class="modal-footer">



        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>



      </div>



    </div>



  </div>



</div>



</div>



</div>



</div>



<?}?>



<script src="../js/jquery-1.10.2.js"></script>

<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="../js/DataTables-1.10.8/media/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="../js/DataTables-1.10.8/media/js/jquery.js"> </script>

<script type="text/javascript" charset="utf8" src="../js/DataTables-1.10.8/media/js/jquery.dataTables.js"> </script>

<script type="text/javascript">

$(document).ready(function()

 {

       $('#listado').DataTable( {

         "oLanguage": {

         "sSearch": "Buscar:"},

        "paging":   false,

        "ordering": false,

        "info":     false

    });//fin datatable



    //eliminar remito

    //eliminar

     $("a[id^='borrar']").click(function(evento)

       {

        evento.preventDefault();

        vidremito = this.id.substr(6,6);

        //alert(vidremito);

        vidhr=$("#numeroHR").val();

        //alert(vidhr);

        $.ajax({

          type: "POST",

          cache: false,

          async: false,

          url: 'eliminarRemitoHR.php',

          data: { idhr: vidhr, idremito:vidremito },

          success: function(data){

            if (data)

            {

              alert(data);

              location.reload(true);

            }

        }

        })//fin ajax

        });//fin



 });

</script>

</body>

</html>





