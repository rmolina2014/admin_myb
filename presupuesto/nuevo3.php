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
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

<div ng-app="formLabs">
 <div ng-controller="UserController">

  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Presupuesto</h3>
     <hr>
 
  <div class="container">
  <h4>Datos Cliente</h4>
  <div class="row">
  <form>
  
   <div class="col-md-2">
    <label >DNI</label>
    <input name="dni" class="form-control" type="text" tabindex="1" required autofocus />
   </div>

   <div class="col-md-2">
    <label >Nombre Contacto</label>
    <input name="nombre" class="form-control" type="text" tabindex="2" required />
   </div>

   <div class="col-md-2">
    <label >Nombre Empresa</label>
    <input name="empresa" class="form-control" type="text" tabindex="3" required />
   </div>
  
   <div class="col-md-2">
    <label >Email </label>
    <input name="email" class="form-control" type="text" tabindex="4" required />
   </div>
  
   <div class="col-md-2"> 
    <label >Teléfono</label>
    <input name="telefono" class="form-control" type="text" tabindex="5" required />
   </div>

</div>


<h4>Detalle Presupuesto</h4>

 <div class="row" ng-init="alto=0;ancho=0;largo=0;precio1=0;peso=0;valorpeso=0;retiro=0;otros=0;seguro=0; ">
 
   <div class="col-md-2">
    <label >Alto</label>
    <input name="alto" class="form-control" ng-model="alto" type="number" step="any" tabindex="6" required />
     </div>

  <div class="col-md-2">
     <label>Ancho</label>
    <input name="ancho" class="form-control" ng-model="ancho" type="number" step="any" tabindex="7" required />
    </div>
 
    <div class="col-md-2">
    <label >Largo </label>
    <input name="largo" class="form-control" ng-model="largo" type="number" step="any" tabindex="8" required />
   </div>
  
   <div class="col-md-2">
    <label >Precio </label>
    <input name="precio1" class="form-control" type="number" step="any" tabindex="9" ng-model="precio1" required="" />
   </div>

   <div class="col-md-2">
    <label >Sub-total (alto * ancho * alto * precio)</label>
     <h3>
    <span class="label label-primary" > {{ (alto * ancho * largo) * precio1 | currency  }}</span>
    </h3>
    </div>
   </div>

 <div class="row">

     <div class="col-md-2">
        <label>Peso en Kg.</label>
        <input name="peso" class="form-control" type="number" step="any" ng-model="peso" tabindex="10" required />
     </div>
     <div class="col-md-2">
        <label >Valor por Kg.</label>
        <input name="valorpeso" class="form-control" type="number" step="any" ng-model="valorpeso" tabindex="11" required />
     </div>

      <div class="col-md-2">
   
   </div>

    <div class="col-md-2">
   
   </div>
  
    <div class="col-md-2">
      <label >Sub-total (peso*valor por kg, )</label>
       
       <h3>
        <span class="label label-primary" >{{ peso * valorpeso | currency  }} </span>
       </h3> 
   </div>
</div>


 <div class="row">

  <div class="col-md-2">
    <label >Retiro </label>
    <input name="retiro" class="form-control" type="number" step="any" ng-model="retiro" tabindex="12" required />
      
  </div>
  <div class="col-md-2">
  </div>
   <div class="col-md-2">
   
   </div>
    <div class="col-md-2">
   
   </div>
  <div class="col-md-2">
    <label >Sub-total </label>
   
     <h3>
        <span class="label label-primary" >{{ retiro | currency  }} </span>
       </h3>
  </div>
</div>

 <div class="row">
  <div class="col-md-2">
      <label >Otros </label>
      <input name="otros" class="form-control" type="number" step="any" ng-model="otros" tabindex="13" required />
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
   <label >Sub-total </label>
   
      <h3>
        <span class="label label-primary" >{{ otros| currency  }} </span>
       </h3>
  </div>
 </div>

 <div class="row">
  <div class="col-md-2">
     <label >Valor Seguro </label>
     <input name="seguro" class="form-control" type="number" step="any" ng-model="seguro" tabindex="14" required />
    </div>
 <div class="col-md-2">
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
    <label >Sub-total( (valor del seguro * 0.7)/100) </label>
   
     <h3>
        <span class="label label-primary" >{{ (seguro*0.7)/100| currency  }} </span>
       </h3>    

   
   </div>
  </div>
<div class="row">
   <div class="col-md-2">
  </div>
   <div class="col-md-2">
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-2">
    <label >Total General </label>
   <h3>
    <span class="label label-primary" >{{ ((alto * ancho * largo) * precio1) + (peso * valorpeso) + retiro + otros + ((seguro*0.7)/100)| currency  }}
   </span>
   </h3>
   </div>

</div>

<div class="row">
  <div class="col-md-10">
    <label >Detalles </label>
    <input name="detalle"  class="form-control" type="text" tabindex="15" required />
  </div>
</div>
<div class="row">

  <div class="col-md-10">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
  </div>
</form>

</div>
</div>

</div>
</div>

</div>
</div>
 <script src="../js/jquery-1.10.2.js"></script>

  <script src="../js/bootstrap.min.js" type="text/javascript"></script>

 <script type="text/javascript">

 $(document).ready(function()
  {
  
  $( "form" ).on( "submit", function( event ) {
   event.preventDefault();
   var dataString = $( this ).serialize();
        //alert('Datos serializados: '+dataString);
    $.ajax({
            type: "POST",
            url: "guardarPresupuesto.php",
            data: dataString,
            success: function(data) {
              //alert(data);
              location.href='listado.php';
            }
        });  
  });
})
</script>

<script>
    angular.module('formLabs', [])
      .controller('UserController', ['$scope', function($scope) {
       /*
        $scope.data = {};
      

        $scope.update = function() {
          console.log($scope.data);
        };

        $scope.reset = function(form) {
          $scope.data = {};
          if (form) {
            form.$setPristine();
            form.$setUntouched();
          }
        };

      $scope.list = [];
      $scope.text = 'hello';
      $scope.submit = function() {
        
      };

        $scope.reset();*/
      }]);
  </script>
</body>
</html>