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

require_once 'rendicion.php';
include '../cabecera.php';

function cambiaf_mysql($fechadb){

    list($yy,$mm,$dd)=explode("-",$fechadb);

    $fecha = new DateTime();

    $fecha->setDate($yy, $mm, $dd);

    echo $fecha->format('d-m-Y');

}

if( isset($_GET['idviaje']) && !empty($_GET['idviaje']) )
{
  $idViaje= $_GET['idviaje'];
?>
<div class="container">
 
<div class="row">
      <?
         $objecto = new rendicion();
         $listado = $objecto->cabeceraRendicion($idViaje);
         while( $item = mysqli_fetch_array($listado))
         {
           $kmSalida=$item['kmsalida'];
           $kmllegada=$item['kmllegada'];
         ?>
       <div class="col-xs-8">
       <h3> Chofer : <?echo $item['nombrechofer'];?> </h3>
       </div>
       <div class="col-xs-4">
       <h3> Rendición N° : <? echo $idViaje;?> </h3>
       </div>
   </div>
   <hr>
   <div class="row" >
        <div class="col-xs-3">
          <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>
        </div>
         <div class="col-xs-3">
          <label> Patente : <?echo $item['patente'];?> </label><br>
        </div>
        <div class="col-xs-3">
          <label> KM Salida : <?echo $item['kmsalida'] ;?> </label><br>
        </div>
        <div class="col-xs-2">
          <label> Flete : <?echo '$ '.$item['flete'];?> </label><br>
        </div>
         <div class="col-xs-2">
          <label> Porcentaje : <?echo $item['porcentaje'];?> </label><br>
        </div>
        <div class="col-xs-2">
          <label> Comision : <?echo '$ '.$item['comision'];
                   $comision=$item['comision'];
         ?> </label><br>
        </div>
    </div>
   <?}?>
      <hr>
      
<!-- Listado de clientes -->
<h4>Clientes</h4>
<div class="col-xd-12">
   <table id="listado1" class="table" >
    <thead>
             <tr>
             <th>Cliente</th>
              <th>Destino</th>
              <th>Remitos</th>
             </tr>
       <thead>
       <tbody>
        <?
          $listarCliente = $objecto->listarCliente($idViaje);
          while( $item = mysqli_fetch_array($listarCliente))
          {
         ?>
           <tr>
             <td><?php echo $item['nombrereal'];?></td>
              <td><?php echo $item['provincia'];?></td>
               <td><?php echo $item['remitos'];?></td>
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
        


 </div>
  <hr>
 <!-- Listado de a cuenta -->
 <h4>Items a Cuenta</h4>
 <div class="col-xd-12">
  <table id="listado1" class="table" >
    <thead>
             <tr>
              <th>N°</th>
              <th>Descripción</th>
              <th>N° Cheque</th>
              <th>Banco</th>
              <th>Importe</th>
             </tr>
       <thead>
       <tbody>
        <?
          $listarACuenta = $objecto->listarACuenta($idViaje);
          $i=0;
          $totalACuenta=0;
          while( $item = mysqli_fetch_array($listarACuenta))
          {
            $i++;
         ?>
           <tr> 
              <td><? echo $i;?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['banco'];?></td>
              <td><?php echo '$ '.$item['importe'];?></td>
          </tr>
          <?
          
             $totalACuenta=$totalACuenta+$item['importe'];
          
           
           }
          ?>
           <tr> 
              <td></td>
              <td></td>
              <td></td>
              <td><?php echo 'Total :';?></td>
              <td><?php echo '$ '.$totalACuenta;?></td>
          </tr>
          </tbody>
         </table>
       <hr>
 </div>


 <!-- Listado de gastos varios -->
 <div class="col-xd-12">
<!-- Listado de clientes -->
<h3>Gastos Varios</h3>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalGV">
  Agregar Gastos Varios
</button>
<table id="listado1" class="table" >
    <thead>
             <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Descripción</th>
              <th>Comprobante N°</th>
              <th>Importe</th>
              <th></th>
             </tr>
       </thead>
       <tbody>
        <? $i=0;
          $totalGV=0;
          $listar = $objecto->listarGastosVarios($idViaje);
          while( $item = mysqli_fetch_array($listar))
          {
             $i++;
         ?>
           <tr>
           <td><? echo $i;?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo $item['comprobante'];?></td>
              <td><?php echo '$ '.$item['importe'];?></td>
              <td> 
                <a class="btn btn-primary btn-sm" id="borrarGV<?php echo $item['idgastosvarios'];?>" > X</a>
              </td>
          </tr>
          <?
          
           $totalGV=$totalGV+$item['importe'];

           }
          ?>
           <tr> 
              <td></td>
              <td></td>
              <td></td>
              <td><?php echo 'Total :';?></td>
              <td><?php echo '$ '.$totalGV;?></td>
          </tr>
          </tbody>
         </table>
       <hr>

       
 </div>
<!-- Modal GASTOS VARIOS -->
<div class="modal fade" id="myModalGV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Gastos Varios</h4>
      </div>
      <div class="modal-body">
       <!--listado de remitos en deposito bss as-->
       <form role="form" method="POST" action="insertarGastosVarios.php">
          <input type="hidden" name="viaje_id" value="<? echo $idViaje?>" />
         <div class="row">
          <div class="col-md-10">
            <label >Tipo Gasto</label>
           <select name="tipogasto_id" class="form-control" required>
           <option value="" >Seleccionar...</option>
           <?  
           $sql="SELECT id,descripcion FROM tipogasto";
           $listado = consulta_mysql($sql);
           while( $item = mysqli_fetch_array($listado))
           {
           ?>
            <option value="<?echo $item['id'];?>"> <?echo $item['descripcion'];?> </option>
            <?
          } 
          ?>
          </select>
            
          </div>

          <div class="col-md-10">
            <label >Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" tabindex="1" required/>
             <div id="Info"></div>
          </div>

          <div class="col-md-10">
            <label >N° Comprobante</label>
            <input type="text" id="numerocomprobante" name="numerocomprobante" class="form-control" tabindex="1" required/>
             
          </div>

          <div class="col-md-10">
            <label >Importe</label>
            <input type="text" id="importe" name="importe" class="form-control" tabindex="1" required/>
             
          </div>


          <div class="col-md-10">
           <br>
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="guardarCliente" type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
          </div>
       </form>

        </div>
        
     </div>
     <div class="modal-footer">
         
      </div>
    </div>
   </div>
  </div>
 <!--fin Modal cliente-->


 <!-- Listado de gasto de combustible -->
<div class="col-xd-12">
<h3>Gastos Combustible</h3>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalGastosComb">
  Agregar Gastos Combustible
</button>
<table id="listado1" class="table" >
    <thead>
             <tr>
             <th>N°</th>
              <th>Fecha</th>
              <th>Nombre</th>
              <th>Comprobante N°</th>
              <th>Litros GAS OIL</th>
              <th>Importe</th>
               <th>Cuenta Corriente</th>
              <th></th>
             </tr>
       </thead>
       <tbody>
        <?$i=0;
          $totalGC=0;
          $totallitros=0;
          $listar2 = $objecto->listarGastosComb($idViaje);
          while( $item = mysqli_fetch_array($listar2))
          {
             $i++;
         ?>
           <tr>
            <td><? echo $i;?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['nombre'];?></td>
              <td><?php echo $item['numerocomprobante'];?></td>
              <td><?php echo $item['litros'];?></td>
              <td><?php echo '$ '.$item['importe'];?></td>
              <td><?php echo $item['cuentacorriente'];?></td>
              <td> 
                <a class="btn btn-primary btn-sm" id="borrarGComb<?php echo $item['id'];?>" > X</a>
              </td>
          </tr>
          <?
            if ($item['cuentacorriente'] <>'SI') {
           $totalGC=$totalGC+$item['importe'];
           }
           $totallitros=$totallitros+$item['litros'];
           }
          ?>
           <tr> 
              <td></td>
              <td></td>
             <td></td>
              <td><?php echo 'Total :';?></td>
              <td><?php echo $totallitros;?></td>
              <td><?php echo '$ '.$totalGC;?></td>
               <td></td>
          </tr>
          </tbody>
         </table>
       <hr>

   <!-- Modal GASTOS combustible -->
<div class="modal fade" id="myModalGastosComb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Gastos Combustible</h4>
      </div>
      <div class="modal-body">
     
       <form role="form" method="POST" action="insertarGastosComb.php">
          <input type="hidden" name="viaje_id" value="<? echo $idViaje?>" />
         <div class="row">
          
          <div class="col-md-10">
            <label >Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" tabindex="1" required/>
             <div id="Info"></div>
          </div>

           <div class="col-md-10">
            <label >Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" tabindex="1" required/>
             
          </div>

          <div class="col-md-10">
            <label >N° Comprobante</label>
            <input type="text" id="numerocomprobante" name="numerocomprobante" class="form-control" tabindex="1" required/>
             
          </div>

          <div class="col-md-10">
            <label >Litros</label>
            <input type="text" id="litros" name="litros" class="form-control" tabindex="1" required/>
             
          </div>

          <div class="col-md-10">
            <label >Importe</label>
            <input type="text" id="importe" name="importe" class="form-control" tabindex="1" required/>
             
          </div>
           <div class="col-md-10">
            <label >Cuenta Corriente</label>
          
            <select name="cuentacorriente" class="form-control" required>
              <option value="NO" selected >NO</option>
              <option value="SI" >SI</option>
              
            </select>  
             
          </div>


          <div class="col-md-10">
           <br>
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="guardarCliente" type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
          </div>
       </form>

        </div>
        
     </div>
     <div class="modal-footer">
         
      </div>
    </div>
   </div>
  </div>
 <!--fin Modal cliente-->

 <div class="col-xd-12">
  <h3> Total Rendicion :<? echo '$ '.$tg=($comision+$totalACuenta)-($totalGV +$totalGC)?></h3>  
 </div>
   <hr>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<div ng-app>
    <div class="col-xd-12" ng-init="kmSalida=<? echo $kmSalida; ?>;kmLlegada=0" >
    <h3>Kilometros</h3>
     <div class="col-md-4">
              <label>Km de Salida</label>
              <input name="flete" class="form-control" type="number" disabled min="0" tabindex="3" ng-model="kmSalida" />
            </div>
         <div class="col-md-4">
              <label>Km de Llegada</label>
              <input name="kmLlegada" id="kmLlegada" class="form-control" type="number" min="0" ng-model="kmLlegada" tabindex="4" required />
            </div>
         <div class="col-md-4">
              <label>Total KM : </label>
              <!--input name="comision"  class="form-control" type="number" /-->
              <span class="form-control"> {{kmLlegada-kmSalida}}</span>
              
            </div>
           

            <div class="col-xd-12">
             <h5> Consumo Estimado (Km Recorridos/Litros Gas Oil) : <?
              if ($totallitros > 0 )
              {
                 echo number_format($estimado=($totalKM / $totallitros));
              }
             
              ?></h5>  
            </div>
    </div>
</div>
<hr>
<br>
<br>
<br>
<div class="col-xd-12">
<!--a class="btn btn-primary pull-right"  href="cambiarestadoRendicion.php?idviaje=<? echo $idViaje;?>&litros=<? echo $totallitros;?>" >Guardar</a-->
<a class="btn btn-primary pull-right"  id="Guardar" >Guardar</a>
</div>

</div>
</div>
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">

 var numeroViaje='<? echo $idViaje; ?>';
 </script>

 <script type="text/javascript">

 $(document).ready(function()
  {
          //CAMBIAR ESTADO CALCULAR KM Y LITROS

       $("a[id^='Guardar']").click(function(evento)
       {
        evento.preventDefault();

        var vid =<? echo $idViaje;?>;
        var vlitros =<? echo $totallitros;?>;
        var vkmllegada=$('#kmLlegada').val();

        if (vkmllegada>0) {
               
        $.ajax({
          type: "GET",
          cache: false,
          async: false,
          url: 'cambiarestadoRendicion.php',     
          data: { idviaje:vid,litros:vlitros,km:vkmllegada},
          success: function(data){
            window.location.href = "listado.php";
        }
        })//fin ajax
           } else alert ('Ingresar los KM de llegada es obligatorio.')
        });//fin


    //eliminar gastos combustibles
     $("a[id^='borrarGComb']").click(function(evento)
       {
        evento.preventDefault();
        vid = this.id.substr(11,4);
       
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'eliminarGComb.php',     
          data: { id:vid},
          success: function(data){
            if (data)
            {
              alert(data);
              window.location.reload(true);
            }
        }
        })//fin ajax 
        });//fin
    //eliminar gastos varios

     $("a[id^='borrarGV']").click(function(evento)
       {
        evento.preventDefault();
        vid = this.id.substr(8,4);
        
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'eliminarGV.php',     
          data: { id:vid},
          success: function(data){
            if (data)
            {
              alert(data);
              window.location.reload(true);
            }
        }
        })//fin ajax 
        });//fin
    
    //eliminar a cuenta

     $("a[id^='borrarACuenta']").click(function(evento)
       {
        evento.preventDefault();
        vid = this.id.substr(13,4);
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'eliminarACuenta.php',     
          data: { id:vid},
          success: function(data){
            if (data)
            {
              alert(data);
              window.location.reload(true);
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
            }
        }
        })//fin
        });//fin select
 });


  function autocomplet(){
  var min_length = 0; // min caracters to display the autocomplete
  var keyword = $('#cliente').val();
  if (keyword.length >= min_length) {
    $.ajax({
      url: 'ajax_refresh.php',
      type: 'POST',
      data: {keyword:keyword},
      success:function(data){
        $('#listacliente').show();
        $('#listacliente').html(data);
      }
    });
  } else {
    $('#listacliente').hide();
  }
}


// set_item : this function will be executed when we select an item
function set_cliente(item,nombre) {
  // change input value
  $('#cliente').val(nombre);
  $('#idcliente').val(item);
  // hide proposition list
  $('#listacliente').hide();
}

 
</script>
</div>
</div>
</div>
</div>
<?}?>

