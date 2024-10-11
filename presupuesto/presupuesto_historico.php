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
 ?>
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
          $usuarios = $objecto->lista_presupuesto_historico();
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
              </td>
          </tr>
          <?php
           }
          ?>
          </tbody>
     </table>
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

   })
   </script>