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
 require_once 'hojaruta.php';
 include '../cabecera.php';
 ?>
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Hoja de Ruta</h3>
      <hr>
      <span class="label label-default"><a href="#" id="lista"><strong>Listado</strong></a></span>
      <span class="label label-default"><a href="#" id="termi"> <strong>Terminada</strong> </a></span>
      <br>
      <br>

       <div id="div_dinamico">
        <p> <a href="cabhr.php" class="btn btn-primary">Agregar Hoja de Ruta</a> </p>
         <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Chofer</th>
              <th>Camion</th>
              <th>Acoplado</th>
              <th>Destino</th>
              <th>Estado</th>
              <th>Total Valor Declarado</th>

              <th>Observación</th>
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new hojaruta();
          $usuarios = $objecto->lista();
          $i=1;
          while( $item = mysqli_fetch_array($usuarios))
          {
          ?>
           <tr>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['nombrechofer'];?></td>
              <td><?php echo $item['patentecamion'];?></td>
              <td><?php echo$item['patenteacoplado'];?></td>
              <td><?php echo$item['provincia'];?></td>
              <td><?php echo$item['estado'];?></td>
              <td>
                  <?php
                       $totalvalordeclarado = $objecto->valordeclarado($item['numero']);

                        echo '$ '.number_format($totalvalordeclarado,2,",", ".");;
                  ?>
                    
              </td>
              <td><?php echo$item['observacion'];?></td>
             
              <td>
                 <?
                   switch ($item['estado']) {
                       case 'Iniciada':
                             ?>
                            <a href="dethr.php?id=<?php echo $item['numero'];?>" class="btn btn-primary btn-sm" > Editar</a>
                             <?
                             break;
                       case 'Pendiente':
                             ?>
                              <a href="controlhr.php?id=<?php echo $item['numero'];?>" class="btn btn-primary btn-sm" > Control</a>
                             <?
                             break;
                       case 'Terminada':
                               ?>
                              <a href="verHR.php?id=<?php echo $item['numero'];?>" class="btn btn-primary btn-sm" > Ver</a>
                             <?
                             break;
                    }
                ?>
                <a href="imprimir.php?idhr=<? echo $item['numero']; ?>" class="btn btn-primary btn-sm"> Imprimir</a>
                 <a href="zonas.php?idhr=<? echo $item['numero']; ?>" class="btn btn-primary btn-sm"> Zonas</a>
                <a class="btn btn-primary btn-sm" id="borrar<?php echo $item['numero'];?>" > Borrar</a>
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


      //listado de HR Terminadas
     $("a[id^='termi']").click(function(evento)
       {
        evento.preventDefault();
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'hrterminadas.php',
          success: function(data){
            if (data)
            {
             $('#div_dinamico').html(data);
            }
        }
        })//fin ajax
        });//fin

     $("a[id^='lista']").click(function(evento)
       {
        evento.preventDefault();
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'hrlista.php',
          success: function(data){
            if (data)
            {
             $('#div_dinamico').html(data);
            }
        }
        })//fin ajax
        });//fin


 });
</script>
</body>
</html>
