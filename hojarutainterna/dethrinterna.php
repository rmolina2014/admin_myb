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

        <label> Numero : <?echo $numeroHRI=$item['numero'];?> </label><br>

        <label> Fecha : <?echo $item['fecha'];?> </label><br>

        <label> Chofer : <?echo $item['nombrechofer'];?> </label><br>

        <label> Patente Camion : <?echo $item['patentecamion'];?> </label><br>

      </div>

      <?}?>

     </div>

     <h3>Detalle</h3>

<div class="col-md-12">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">
  Agregar Remito
</button>

 <!-- Listado de remitos -->
<input type="hidden" value="<?echo $numeroHRI;?>" name="numeroHRI" id="numeroHRI"/>  
 <table id="listado5" class="table" >
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
              <th></th>
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
              <td> 
               <a class="btn btn-primary btn-sm" id="borrar<?php echo $item['remitoid'];?>" > X</a>
              </td>
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
 <a href="cambiarestadoHRI.php?id=<? echo $numeroHRI;?>&estado=Reparto" class="btn btn-primary btn-sm">Guardar</a>
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

       <table id="listado" class="table table-condensed" >

          <thead>

             <tr>

              <th>Nº</th>

              <TH>  Cliente </TH>

              <TH>  Proveedor </TH>

              <TH>  Fecha </TH>

              <th>Guia Sur Express</th>
              
             </tr>

           <thead>

           <tbody>

          <?php

          $objecto = new remito();

          $listado = $objecto->listaremitohri();

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

                  <form method="post" action="agregarremito2.php">

                    <input type="hidden" name="hr" value="<?php echo $idhrint;?>" />

                    <input type="hidden" name="remito" value="<?php echo $item['id'];?>" />                  

                    <input type="text" name="remitose" placeholder="Ej: Remito Nº 1256" />
                    <input type="text" name="importe" placeholder="Ej: $ 1000" />
                    <!--input type="number" name="importefletero" placeholder="Importe Fletero Ej: $ 1000" /-->

                    <input type="submit" value="Agregar">

                  </form>
             

                  <!--a class="btn btn-primary btn-sm"  href="agregarremito.php?hr=<?php echo $idhrint;?>&remito=<?php echo $item['id'];?>" > Agregar</a-->
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

<!--script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<!--script src="../js/bootstrap.min.js" type="text/javascript"></script-->
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
    });

    //eliminar remito
    //eliminar
     $("a[id^='borrar']").click(function(evento)
       {
        evento.preventDefault();
        vidremito = this.id.substr(6,6);
        //alert(vidremito);
        vidhri=$("#numeroHRI").val();
        //alert(vidhri);

        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'eliminarRemitoHRI.php',
          data: { idhri: vidhri, idremito:vidremito },
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
