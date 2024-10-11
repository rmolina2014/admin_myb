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
//require_once 'remito.php';
include '../cabecera.php';
 require_once '../conexion.php';
 ?>  
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Consultas</h3>
     <hr>
       <span class="label label-default"><a href="historial.php"><strong>Historial Remito</strong></a></span>
     <span class="label label-default"><a href="listadoFechas.php"> <strong>Clientes Fechas</strong> </a></span>
     <span class="label label-default"><a href="listadoRosario.php"> <strong>Consultas Rosario</strong> </a></span>
      <span class="label label-default"><a href="listadoBA.php"> <strong>Consultas Buenos Aires </strong> </a></span>
   </div>
   <div class="col-md-12">
     <ul class="nav nav-tabs">
        <li> <a href="listadoHR_Rosario.php" id="hojaruta">Hojas de Ruta</a></li>
        <!--li> <a href="temacircular/index.php">Remitos</a>       </li>
        <li> <a href="usuario">Clientes</a>       </li>
        <li> <a href="buscador/index.php">Proveedores</a>       </li-->
    </ul>
    </div>
 <!-- /. ROW  -->
    <div id="listados"> </div>




 </div><!-- /. PAGE INNER  -->
 </div><!-- /. PAGE WRAPPER  -->
 </div>
 </div> <!-- /. WRAPPER  -->
  <script src="../js/jquery-1.10.2.js"></script>
  
 <script type="text/javascript">
 $(document).ready(function()
  {
     // llamada ajax
      $('#hojaruta3').click(function(){
        

         $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'listadoBS_Rosario.php',
          success: function(data){
            if (data)
            {
             $('#listados').html(data);
            }
        }
        });//fin ajax
       
        
    });

});
  
</script>
</body>
</html>
