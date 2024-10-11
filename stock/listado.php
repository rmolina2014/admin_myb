<?php
 //------------------
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
   $ID= $_SESSION['sesion_id'];
   $sucursal=$_SESSION['sesion_sucursal'];
  $nombre=$_SESSION['sesion_usuario'];
  $permiso=$_SESSION['sesion_permisos'];
 }
  else { header ("Location: ../index.php"); }
 //-----------------
 require_once 'stock.php';
 include '../cabecera.php';
 ?>
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Stock</h3>
     <hr>
      <div id="div_dinamico">
        <p><button class="btn btn-primary" id="agregar">Agregar Nuevo Registro</button> </p>
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>Nº Registro</th>
              <th>Cliente</th>
              <th>Descripcion</th>
              <th>Comprobante de Ingreso</th>
               <th>Comprobante de Egreso</th>
              <th>Fecha Ingreso</th>
              <th>Fecha Salida</th>
              <th>Estado</th>
              <th></th>
             </tr>
           <thead>
           <tbody>

          <?php
          $objecto = new stock();
          $registros = $objecto->lista();
          $i=1;
          while( $item = mysqli_fetch_array($registros))
          {
          ?>
           <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['cliente'];?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo$item['comIngreso'];?></td>
              <td><?php echo $item['comEgreso'];?></td>
              <td><?php echo $item['fechaingreso'];?></td>
              <td><?php echo$item['fechasalida'];?></td>
              <td><?php echo$item['estado'];?></td>
              <td>
                  <a class="btn btn-primary btn-sm" id="editar<?php echo $item['id'];?>" > Editar</a>
                  <a class="btn btn-primary btn-sm" id="borrar<?php echo $item['id'];?>" > Borrar</a>
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
 <!-- /. ROW  -->
 <footer><p> Admin -2015 </p></footer>
 </div><!-- /. PAGE INNER  -->
 </div><!-- /. PAGE WRAPPER  -->
 </div> <!-- /. WRAPPER  -->
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
