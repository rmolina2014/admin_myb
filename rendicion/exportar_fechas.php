 <div class="container">
 <div class="row">
 <div class="col-md-12">
  <h4>Ingresar Fechas de las Rendiciones</h4>
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
</div>
</div>
