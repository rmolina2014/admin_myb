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
      <p>
       <a href="historial.php" class="btn btn-primary">Historial Remito</a>
       <a href="listadoHojaRuta.php" class="btn btn-primary">Hoja de Ruta - Detalle </a>
       <a href="listadoFechas.php" class="btn btn-primary">Clientes Fechas </a>
       <a href="listadoHR_Rosario.php" class="btn btn-primary">Consultas Rosario </a>
       <a href="listadoBS_Rosario.php" class="btn btn-primary">Consultas Buenos Aires </a>
       <a href="#" class="btn btn-primary" id="myBtn">Remitos por Fecha</a> 
     </p>
     <br>
     <br>
     <br>
     <br>
     <br>
     <br>
 

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4>Ingresar Fechas de los Remitos</h4>
        </div>
        <div class="modal-body">
                  
              <form role="form" method="POST" action="excel_remitos_fecha.php">

               <div class="col-md-8">
                <label >Fecha desde :</label>
                <input name="desde" id="cuit" class="form-control" type="date" tabindex="1" required autofocus />
                <div id="Info"></div>
               </div>

               <div class="col-md-8">
                <label >Fecha hasta :</label>
                <input name="hasta"  class="form-control" type="date" tabindex="2"  required />
              </div>
              <div class="col-md-8">
               <hr>
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right" onclick="location.href='listado.php';"><i class="fa fa-floppy-o"></i> Aceptar</button>
              </div>
            </form>
        </div>
        <div class="modal-footer">
        
          
        </div>
      </div>
    </div>
  </div> 

 <!-- fin modal-->




 </div><!-- /. PAGE INNER  -->
 </div><!-- /. PAGE WRAPPER  -->
 </div> <!-- /. WRAPPER  -->
 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 $(document).ready(function()
  {
      $("#myBtn").click(function(){
             $("#myModal").modal();
        });

     // consultas por fecha
      $('#exportar').click(function(){
        $.ajax({
            url: 'exportar_fechas.php',
            success: function(data) {
                $('#div_dinamico').html(data);
            }
        });
      });
   
 });
</script>
</body>
</html>
