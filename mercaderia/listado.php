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
 require_once 'mercaderia.php';
 require_once '../almacen/almacen.php';
 include '../cabecera.php';

 ?>

 <div class="container-fluid">
   <div class="row">

    <div class="col-md-12">
    <?
        $almacen = new almacen();
        $disponible1 = $almacen->disponible(1);
        $disponible2 = $almacen->disponible(2);

    ?>
     <h3>Stock  - Plano Disponible : <b style="color: green;"> <? echo $disponible1; ?></b> m2 - Estanteria Disponible: <b style="color: green;"> <? echo $disponible3; ?></b>  m3 </h3>
     <hr>
      <!--div class="container"-->
      <div id="div_dinamico">
       <ul class="nav nav-tabs">
          <li><button class="btn btn-primary" id="ingreso">Ingreso de Mercaderia</button> </li>
          <li> <button class="btn btn-primary" id="salida">Salida de Mercaderia</button> </li>
        </ul>
        </br>
        <!--p><button class="btn btn-primary" id="agregar">Ingreso de Mercaderia</button> </p>

        <p><button class="btn btn-primary" id="agregar">Salida de Mercaderia</button> </p-->

         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>Nº</th>
              <th>Cliente</th>
              <th>Tipo Mercaderia</th>
              <th>Cantidad</th>
              <th>Almacen</th>
              <th>Espacio</th>
              <th>Unidad</th>
              <th>Fecha Ingreso</th>
              <th>Fecha Salida</th>
              <th>Estado</th>
              <th></th>
             </tr>
           <thead>
           <tbody>

          <?php
          $objecto = new mercaderia();
          $registros = $objecto->lista();
          $i=1;
          while( $item = mysql_fetch_array($registros))
          {
          ?>
           <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['cliente_id'];?></td>
              <td><?php echo $item['tipomercaderia'];?></td>
              <td><?php echo$item['cantidad'];?></td>
              <td><?php echo$item['almacen_id'];?></td>
              <td><?php echo $item['espacio'];?></td>
              <td><?php echo $item['unidad'];?></td>
              <td><?php echo$item['fechaingreso'];?></td>
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

  <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/bootstrap.min.js" type="text/javascript"></script>
  <script type="text/javascript">
   $(document).ready(function()
   {
     // llamada ajax
      $('#ingreso').click(function(){
        $.ajax({
            url: 'ingresomercaderia.php',
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
