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

 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Rendiciones</h3>
      <hr>
      <div id="div_dinamico">
        <p>
        <button class="btn btn-primary" id="agregar">Agregar Viaje</button> 
        <button class="btn btn-primary" id="consultas" onclick="location.href='consultas.php';">Consultas de Rendiciones por Nº</button>
        <button class="btn btn-primary" id="consultas" onclick="location.href='consultasRendicionChofer.php';">Consultas de Rendiciones por Chofer</button>
        <button class="btn btn-primary" id="myBtn">Exportar a Excel</button> 
       
        </p>
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>Nº Rendicion</th>
              <th>Fecha</th>
              <th>Chofer</th>
              <th>Patente</th>
              <th>Comision</th>
              <th>Flete</th>
              <th>Km Salida</th>
              <th>Km Llegada</th>
              <th>Total Km</th>
              <th>Total GAS OIL</th>
              <th>Estado</th>
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new rendicion();
          $listado = $objecto->lista();
          while( $item = mysqli_fetch_array($listado))
          {
          ?>
           <tr>
              <td> <?php echo $item['id'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['nombrechofer'];?></td>
              <td><?php echo $item['patente'];?></td>
              <td><?php echo $item['comision'];?></td>
              <td><?php echo $item['flete'];?></td>
              <td><?php echo $item['kmsalida'];?></td>
              <td><?php echo $item['kmllegada'];?></td>
              <td><?php echo $totalKM= $item['kmllegada']-$item['kmsalida'];?></td>
              <td><?php echo $item['totalGO'];?></td>
              <td><?php echo $item['estado'];?></td>
              <td>
                  <?
                   switch ($item['estado'])
                   {
                    case 'Pendiente':
                             ?>
                            <a href="detalleRendicion.php?id=<?php echo $item['id'];?>" class="btn btn-primary btn-sm" > Editar</a>
                            <a href="controlRendicion.php?idviaje=<?php echo $item['id'];?>" class="btn btn-primary btn-sm" > Control</a>
                            <a href="imprimirViaje.php?idviaje=<? echo $item['id']; ?>" class="btn btn-primary btn-sm"> Imprimir</a>
                            <?
                            break;

                       case 'Rendicion':
                               ?>
                              <a href="verRendicion.php?idviaje=<?php echo $item['id'];?>" class="btn btn-primary btn-sm" > Ver</a>
                               <a href="imprimirRendicion.php?idviaje=<? echo $item['id']; ?>" class="btn btn-primary btn-sm"> Imprimir</a>
                             <?
                             break;
                    }
                ?>
               
                <a class="btn btn-primary btn-sm" id="borrarRen<?php echo $item['id'];?>" > Borrar</a>

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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4>Ingresar Fechas de las Rendiciones</h4>
        </div>
        <div class="modal-body">
                  
              <form role="form" method="POST" action="excel_1.php">

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

 <footer>

 </footer>

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

     $("a[id^='borrarRen']").click(function(evento)

       {

        evento.preventDefault();

        vid = this.id.substr(9,4);

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
