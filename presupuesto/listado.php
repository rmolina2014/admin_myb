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
 require_once 'presupuesto.php';
 include '../cabecera.php';
 ?>
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Presupuesto</h3>
     <hr>
      <p>
           <a class="btn btn-primary" href="nuevo3.php">Agregar Nuevo</a>
           <button class="btn btn-primary" id="pendientes">Listado</button> 
           <button class="btn btn-primary" id="historicos">Historicos</button> 
       
        </p>
     
     <div id="div_dinamico">
       
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>Nº</th>
              <th>Nombre</th>
              <th>DNI</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Detalle</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new presupuesto();
          $usuarios = $objecto->lista();
          $i=1;
          while( $item = mysqli_fetch_array($usuarios))
          {

          ?>
           <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['nombre'];?></td>
              <td><?php echo $item['dni'];?></td>
              <td><?php echo$item['telefono'];?></td>
              <td><?php echo$item['email'];?></td>
              <td><?php echo$item['detalle'];?></td>
              <td><?php echo$item['totalgeneral'];?></td>
              <td><?php echo$item['fecha'];?></td>
              <td><?php echo$item['estado'];?></td>
              <td>
                  <a class="btn btn-primary btn-sm" href="editar.php?id=<?php echo $item['id'];?>" > Editar</a>
                  <a class="btn btn-primary btn-sm"  id="borrar<?php echo $item['id'];?>" > Borrar</a>
                  <a class="btn btn-primary btn-sm"  href="imprimir.php?id=<?php echo $item['id'];?>" > Imprimir</a>
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

      //13042017 listado de Remitos historicos
     $("#historicos").click(function(evento)
       {
        $.ajax({
            url: 'presupuesto_historico.php',
            success: function(data) {
                $('#div_dinamico').html(data);
            }
        });
        });//fin

     $("#pendientes").click(function(evento)
       {
        
        location.reload(true);
        });//fin




 });

</script>

</body>

</html>
