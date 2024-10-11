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
 //-----------------


 require_once 'remitosproveedor.php';
 include '../cabecera.php';
 ?>
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Compras  </h3>
     <hr>
      <!--div class="container"-->
      <div id="div_dinamico">
        <p>
        <a href="nuevo.php" class="btn btn-primary" id="agregar"> Agregar Remitos Proveedores</a>

        <a href="../factura_proveedor/listado.php" class="btn btn-primary" id="agregar"> Facturas Proveedores</a>
        
        <a href="../proveedores_se/listado.php" class="btn btn-primary" id="agregar"> Proveedores</a>
    
        
         </p>
   

        <h3>Remitos Proveedores</h3>
        
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
             <th>Nº Remito</th>
              <TH> Proveedor </TH>
              <TH> Detalle </TH>
              <TH> Fecha </TH>
              <TH> Monto </TH>  
              <TH> Estado</TH>  
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new remitosproveedor();
          $usuarios = $objecto->lista();
          $i=1;
          while( $item = mysqli_fetch_array($usuarios))
          {
          ?>
         <tr>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['nombre'];?></td>
              <td><?php echo $item['detalle'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['monto'];?></td>
              <td><?php echo $item['estado'];?></td>
              <td>
                   <a class="btn btn-primary btn-sm" href="editar.php?id=<?php echo $item['id'];?>" > Editar</a>
                  <a class="btn btn-primary btn-sm"  id="borrar<?php echo $item['id'];?>" > Borrar</a>
              </td>

          </tr>

          <?php

           }

          ?>

          </tbody>

         </table>

         </div>

         </div>

</div>

</div>
<script type="text/javascript">
 $(document).ready(function()
  {
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

             $('#div_dinamico').html(data);

            }

        }

        })//fin ajax

        });//fin



    //eliminar

     $("a[id^='borrar']").click(function(evento)

       {

        evento.preventDefault();

        vid = this.id.substr(6,4);

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





 });

</script>

</body>

</html>

