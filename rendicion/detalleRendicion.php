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
?>
<style type="text/css">
  .input_container {
  height: 30px;
  float: left;
}
.input_container input {
  height: 20px;
  width: 200px;
  padding: 3px;
  border: 1px solid #cccccc;
  border-radius: 0;
}
.input_container ul {
  width: 206px;
  border: 1px solid #eaeaea;
  position: absolute;
  z-index: 9;
  background: #f3f3f3;
  list-style: none;
}
.input_container ul li {
  padding: 2px;
}
.input_container ul li:hover {
  background: #eaeaea;
}
#country_list_id {
  display: none;
}
</style>
<?
function cambiaf_mysql($fechadb){

    list($yy,$mm,$dd)=explode("-",$fechadb);

    $fecha = new DateTime();

    $fecha->setDate($yy, $mm, $dd);

    echo $fecha->format('d-m-Y');

}

if( isset($_GET['id']) && !empty($_GET['id']) )
{
  $idViaje= $_GET['id'];
?>
 <div class="container">
 <div class="row">
 <div class="col-xs-12">
  <h3>Editar Detalle</h3>
   <?
     $objecto = new rendicion();
     $listado = $objecto->cabeceraRendicion($idViaje);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
     <div class="row" >
       <div class="col-xs-3">
         <label> Rendicion N°: <?echo $numeroViaje=$item['id'];?> </label><br>
         </div>

        <div class="col-xs-3">
          <label> Chofer : <?echo $item['nombrechofer'];?> </label><br>
        </div>

        <div class="col-xs-3">
          <label> Patente : <?echo $item['patente'];?> </label><br>
        </div>

        <div class="col-xs-3">
          <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>
        </div>
        <div class="col-xs-3">
          <label> KM Salida : <?echo $item['kmsalida'] ;?> </label><br>
        </div>
        <div class="col-xs-3">
          <label> Flete : <?echo '$ '.number_format($item['flete'],2, ",", ".");?> </label><br>
        </div>
         <div class="col-xs-3">
          <label> Porcentaje : <?echo $item['porcentaje'];?> </label><br>
        </div>
        <div class="col-xs-3">
         <label> Comision : <?echo '$ '.number_format($item['comision'],2, ",", ".");
                   $comision=$item['comision'];

         ?> </label><br>
        </div>
       
        
    </div>
      <?}?>
    </div>
    </div>

<hr>

<div class="col-xd-12">
<!-- Listado de clientes -->
<h3>Clientes</h3>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
  Agregar Cliente
</button>
<table id="listado1" class="table" >
    <thead>
             <tr>
              <th>Cliente</th>
              <th>Destino</th>
               <th>Fecha</th>
              <th>Remitos</th>

              <th></th>
             </tr>
       </thead>
       <tbody>
        <?
          $listarCliente = $objecto->listarCliente($numeroViaje);
          while( $item = mysqli_fetch_array($listarCliente))
          {
         ?>
           <tr>
              <td><?php echo $item['nombrereal'];?></td>
              <td><?php echo $item['provincia'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['remitos'];?></td>
              
              <td> 
                <a class="btn btn-primary btn-sm" id="borrarCliente<?php echo $item['viajecliente_id'];?>" > X</a>
              </td>
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
       <hr>
 </div>
<!-- Modal Cliente -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Clientes</h4>
      </div>
      <div class="modal-body">
       <!--listado de remitos en deposito bss as-->
       <form role="form" method="POST" action="insertarCliente.php">
         <input type="hidden" name="viaje_id" value="<? echo $numeroViaje?>" />
         <div class="row">
          <div class="col-md-10">
            <label >Nombre</label>
            <input type="text" id="cliente" name="cliente_id" placeholder="Ingresar nombre Cliente" onkeyup="autocomplet()" class="form-control" tabindex="1" autofocus required>
            <ul id="listacliente"></ul>
            <input type="hidden" id="idcliente" name="idcliente" />
          </div>

            <div class="col-md-10">
              <label> Destino </label>
                <select name="provincia_id" class="form-control" tabindex="2" required>
                   <option value="" >Seleccionar...</option>
               <?  
               $sql="SELECT id,nombre FROM provincia";
               $listado = consulta_mysql($sql);
               while( $item = mysqli_fetch_array($listado))
               {
               ?>
                <option value="<?echo $item['id'];?>"> <?echo $item['nombre'];?> </option>
                <?
              } 
              ?>
              </select>
             </div>

              <div class="col-md-10">
            <label >Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" tabindex="3" required/>
             
          </div>

          <div class="col-md-10">
            <label >Remitos</label>
            <input type="text" id="remito" name="remito" class="form-control" tabindex="4" required/>
             <div id="Info"></div>
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

 <!-- Listado de a cuenta -->
<h3>Item a Cuenta</h3>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#aCuenta">
  Agregar Item a Cuenta
</button>
<table id="listado1" class="table" >
    <thead>
             <tr>
              <th>N°</th>
              <th>Descripción</th>
              <th>N° Cheque</th>
              <th>Banco</th>
              <th>Importe</th>
              <th></th>
             </tr>
       <thead>
       <tbody>
        <?
          $listarCliente = $objecto->listarACuenta($numeroViaje);
          $i=0;
          $totalACuenta=0;
          while( $item = mysqli_fetch_array($listarCliente))
          {
            $i++;
         ?>
           <tr> 
              <td><? echo $i;?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['banco'];?></td>
              <td><?php echo '$ '.number_format($item['importe'],2, ",", "."); ?></td>
              <td> 
                <a class="btn btn-primary btn-sm" id="borrarACuenta<?php echo $item['id'];?>" > X</a>
              </td>
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
              <td><?php echo '$ '.number_format($totalACuenta,2, ",", "."); ?></td>
              <td></td>
          </tr>
          </tbody>
         </table>
 
         <hr>
         </br>
         <!--a class="btn btn-danger pull-left" href="listado.php" class="btn btn-primary btn-sm">Cancelar</a-->
<div class="col-xd-12">
  <h5> Total General :<?
   $tg=($comision+$totalACuenta);
   echo '$ '.number_format($tg,2, ",", ".");

   ?></h5>  
 </div>
         <a class="btn btn-primary pull-right" href="listado.php" class="btn btn-primary btn-sm">Aceptar</a>

               
 </div>

<!-- Modal a cuenta -->
<div class="modal fade" id="aCuenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">A Cuenta</h4>
      </div>
      <div class="modal-body">
       <!--listado de remitos en deposito bss as-->
       <div class="row">
        <form role="form" method="POST" action="insertarACuenta.php">
          <input type="hidden" name="viaje_id" value="<? echo $numeroViaje?>" />
          

          <div class="col-md-10">
            <label for="exampleInputEmail1" >Descripción</label>
            <select name="descripcion" class="form-control" id="tipocomprobante" tabindex="1" required>
             <option value="Efectivo">Efectivo</option>
             <option value="Cheque">Cheque</option>
             <option value="Transferencia">Transferencia</option>
            </select>
          </div>

          <div class="col-md-10">
            <label >N° Cheque</label>
            <input type="text" id="numero" name="numero" class="form-control" tabindex="2" />
             <div id="Info"></div>
          </div>

           <div class="col-md-10">
            <label >Banco</label>
            <input type="text" id="banco" name="banco" class="form-control" tabindex="3" />
             <div id="Info"></div>
          </div>

           <div class="col-md-10">
            <label >Importe</label>
            <input type="text" id="importe" name="importe" class="form-control" tabindex="4" required/>
             <div id="Info"></div>
          </div>

          <div class="col-md-10">
           <br>
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="guardarACuenta" type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
          </div>
       </form>
      </div>
     </div>
     <div class="modal-footer">
         
      </div>
    </div>
   </div>
  </div>

 <!--fin listado remitos-->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
 var numeroViaje='<? echo $numeroViaje; ?>';
 </script>
 <script type="text/javascript">
 $(document).ready(function()
  {
     //eliminar cliente
     $("a[id^='borrarCliente']").click(function(evento)
       {
        evento.preventDefault();
        vid = this.id.substr(13,4);
        //alert(vid);
         //alert('numeroViaje '+numeroViaje);
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'eliminarCliente.php',     
          data: { viajecliente_id:vid,viaje_id:numeroViaje},
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

