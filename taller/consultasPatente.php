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

 require_once 'taller.php';
 include '../cabecera.php';
?> 
<div class="container">
  <div class="row" >
    <h3>Consulta por Patente</h3>
 <div class="row" >
<div class="col-md-3">
    <label >Camion </label>
    <select name="camion" id="camion" class="form-control" tabindex="1" >
     <option value=""> </option>
     <?  
     $sql="SELECT id,patente FROM camion";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['patente'];?>"> <?echo $item['patente'];?> </option>
      <?
    } 
    ?>
    </select>
  </div>
  <div class="col-md-3">
    <label >Acoplado </label>
    <select name="acoplado" id="acoplado" class="form-control" tabindex="1" >
    <option value=""> </option>
     <?  
     $sql="SELECT id,patente FROM acoplado";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['patente'];?>"> <?echo $item['patente'];?> </option>
      <?
    } 
    ?>
    </select>
  </div>
  </div>
<hr>
 <div class="row" >
  <div class="col-md-4">
    <label >Patente</label>
    <input name="patente_id" id="patente_id" class="form-control" type="text" required />
  </div>


    <div class="col-md-4">
      <label >Fecha Desde</label>
      <input name="fechaDesde" id="fechaDesde" class="form-control" type="date" tabindex="2" required />
    </div>
     <div class="col-md-4">
      <label >Fecha Hasta</label>
      <input name="fechaHasta" id="fechaHasta" class="form-control" type="date" tabindex="3" required />
    </div>

    <div class="col-md-4">
    <br>

      <button class="btn btn-primary" id="consultasPatente" >Consulta por Patente </button>
    </div>
    </div>
    </div>
  <hr>
   <div id="div_dinamico"></div>
  </div>

 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 $(document).ready(function()
  {
      var valor=0; 
     // llamada ajax
      $('#consultasPatente').click(function(){
        var patente=$('#patente_id').val();
        var fechaDesde=$('#fechaDesde').val();
        var fechaHasta=$('#fechaHasta').val();
        $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: 'resultadoConsulta.php',
                data: { patente:patente,fechaDesde:fechaDesde, fechaHasta:fechaHasta },
                success: function(data) {
                          if (data)
                          {
                           $('#div_dinamico').html(data);
                          }
                      }
                  });
        });

      $('#camion').change(function(){
        var pat=$('#camion').val();
        $('#patente_id').val(pat);
         $('#tipo').val('camion');
      
      });

      $('#acoplado').change(function(){
       var pat=$('#acoplado').val();
        $('#patente_id').val(pat);
         $('#tipo').val('acoplado');
        
      });
  
 });
</script>
</body>
</html>
