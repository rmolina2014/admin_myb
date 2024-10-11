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
 require_once 'cliente.php';
 include '../cabecera.php';
 ?>
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Clientes</h3>
      <hr>
      <div id="div_dinamico">
        <p><a href="nuevo.php" class="btn btn-primary" id="agregar">Agregar Nuevo Cliente</a> </p>

          <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          
          <thead>
             <tr>
              <th>Nº</th>
              <th>Nombre Fantasia</th>
              <th>Nombre Real</th>
              <th>Cuit</th>
              <th>Email</th>
              <th>Domicilio</th>
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new cliente();
          $usuarios = $objecto->lista();
          $i=1;
          while( $item = mysqli_fetch_array($usuarios))
          {
          ?>
           <tr>
              <td><?php echo $i++;?></td>
               <td><?php echo $item['nombrefantasia'];?></td>
                <td><?php echo $item['nombrereal'];?></td>
                <td><?php echo $item['cuit'];?></td>
                 <td><?php echo$item['email'];?></td>
                 <td><?php echo$item['domicilio'];?></td>
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
  <script src="../js/jquery.maskedinput.js" type="text/javascript"></script>

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

 });
</script>
</body>
</html>
