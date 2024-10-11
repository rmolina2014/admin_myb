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
require_once 'remito.php';
include '../cabecera.php';
 ?>  
 <div class="container-fluid">

   <div class="row">

    <div class="col-md-12">

     <h3>Remito</h3>
     <hr>
      <span class="label label-default"><a href="#" id="lista"><strong>Listado</strong></a></span>
      <span class="label label-default"><a href="#" id="termi"> <strong>Entregados</strong> </a></span>
      <br>
      <br>
     
       <div id="div_dinamico">
        <?
          if ($permiso < 3) {
         ?>
        <p>
          <a href="nuevo.php" class="btn btn-primary">Agregar Remito</a>
        </p>
        <?
         }
        ?>

         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >

          <thead>

             <tr>
                 
              <th>Orden</th>

              <th>Remito</th>

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

                

              <th></th>

             </tr>

           <thead>

           <tbody>

          <?php

          $objecto = new remito();

          $listado = $objecto->lista();

          $i=1;

          while( $item = mysqli_fetch_array($listado))

          {
           
           
          ?>

           <tr>
               <td><?php echo $i;?></td>

              <td>
                <a href="#" data-toggle="modal" data-target="#myModal" id="nremito<?php echo $item['id'];?>">
                  <?php echo $item['numero'];?>
                </a>
              </td>

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


              <td>
                  <!--a class="btn btn-primary btn-sm" id="editar<?php echo $item['id'];?>" > Editar</a-->

                  <?
                   if ($permiso < 3) {
                   ?>  
                  <a class="btn btn-primary btn-sm" id="borrar<?php echo $item['id'];?>" > Borrar</a>
                  <?
                    }
                   if ($permiso == 1) {
                   ?>  
                   <select id="control<?php echo $item['id'];?>" name="control">
                        <option value='cambiar'>Cambiar Estado:</option>
                        <option value='En Deposito Destino'>En Deposito Destino</option>
                      <option value='Entregado'>Entregado</option>
                   </select>
               <? }?>

              </td>

          </tr>

          <?php
           $i++;
           } 

          ?>

          </tbody>

         </table>

         </div>

         </div>

</div>

 </div>
 
 <!-- 16012018 modal de consulta de remitos-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Consulta Remito</h4>
      </div>
      <div class="modal-body">
        <div id="datosremitos"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- fin modal-->

<br>

<footer>

  Administraci&oacuten 2015

</footer>

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
    });

     // llamada ajax
      $('#agregar').click(function(){  
        $.ajax({  
            url: 'nuevo.php',  
            success: function(data) {  
                $('#div_dinamico').html(data);  
            }  
        });  
    }); 

    //editar
    $("a[id^='editar']").click(function(evento)
       {
        evento.preventDefault();
        vid = this.id.substr(6,4);
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'editar.php',     
          data: { id: vid},
          success: function(data){
            if (data)
            {
             //$('#div_dinamico').hide();   
             $('#div_dinamico').html(data);
            }
        }
        })//fin ajax 
        });//fin



    //eliminar

     $("a[id^='borrar']").click(function(evento)
       {
        evento.preventDefault();
        vid = this.id.substr(6,8);
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'eliminar.php',     
          data: { id: vid},
          success: function(data){
            if (data)
            {
              alert(data);
               location.reload(true);
            }
        }
        })//fin ajax 
        });//fin


 //cambiar estado select

    $("select[id^='control']").change(function()
       {
        vid = this.id.substr(7,6);
        vestado=$(this).val();
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'cambiarestadoremito.php',
          data: { id: vid, estado: vestado},
          success: function(data){
          if (data)
            {
             alert(data);
             location.reload(true);
            }
          }
        })//fin ajax
        });//fin change

     //18092015 listado de Remitos Entregados
     $("a[id^='termi']").click(function(evento)
       {
        evento.preventDefault();
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'remitosentregados.php',
          success: function(data){
            if (data)
            {
             $('#div_dinamico').html(data);
            }
        }
        })//fin ajax
        });//fin

     $("a[id^='lista']").click(function(evento)
       {
        evento.preventDefault();
        location.reload(true);
        });//fin
        
        //16012018 ventana modal consulta datos remito
    $("a[id^='nremito']").click(function(evento)
       {
         vid = this.id.substr(7,8);
         $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'consulta_datos_remito.php',     
          data: { numero: vid},
          success: function(data){
            if (data)
            {
             //$('#div_dinamico').hide();   
             $('#datosremitos').html(data);
            }
        }
        })//fin ajax 
      });//fin
    


 });
</script>

</body>

</html>