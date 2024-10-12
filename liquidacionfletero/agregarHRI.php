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
 else
  { header ("Location: ../index.php"); }
 
 require_once 'liquidacionfletero.php';
  include '../cabecera.php';
 
 ?>
 <style type="text/css" media="print">

@media print {

body { font-size:10px; }

#noimprimir {display:none;}

#parte2 {display:none;}

}

</style>
 <div class="container-fluid">
  <div id='noimprimir'>
   <div class="row">
    <div class="col-md-12">
     <h3>Liquidación Fletero</h3>
     <hr>
   </div>
   </div>

   <div class="container">
   <div class="row">
    <div class="col-md-8">

   <select name="idchofer" id="idchofer" class="form-control" required>
    <option value="" >Seleccionar HRI...</option>
    <?php  
     $sql="SELECT hojarutainterna.`id` AS id_hri, chofer.`nombre` AS chofer
          FROM `hojarutainterna`
          INNER JOIN `chofer` 
              ON (`hojarutainterna`.`idchofer` = `chofer`.`id`) order by id_hri desc;";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?php echo $item['id_hri'];?>"> <?php echo $item['id_hri'];?> : <?php echo $item['chofer'];?> </option>
      <?php
    } 
    ?>
    </select> 
    <hr>
   </div>
   </div>

<div class="row" >
  <div class="col-md-8">
  <ul id="tabla" class="list-group">
    
  </ul>
</div>
</div>

<div class="row">
  <div class="col-xs-2">
      <label> Porcentaje Fletero :</label>
  </div>
  <div class="col-xs-2"> <input type="number" id="porcentaje" name="porcentaje" class="form-control">
  </div>
  <div class="col-xs-2">
    <button id="enviar" class="btn btn-default">Aplicar Porcentaje.</button>
  </div>
</div>
   

</div>

</div>

<br>
<br>
<div class="container">
<div class="row">
      <div class="col-md-12">

        <div id="parte2">
       
        <hr>
        <h3>Para Imprimir</h3>
        <hr>
        <br>
      </div>
        <div id="seleccion">
          <div id="resultado">
         </div>  
     </div>
      </div>
</div> 
</div>   

 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
  function imprSelec(nombre) {
    var ficha = document.getElementById(nombre);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( ficha.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
  }
 $(document).ready(function()
  {
   
     var listaHRI = [];
     $('#idchofer').change(function()
     {        
        var id_hri = $("#idchofer option:selected").val(); 
         //alert(id_hri);
        var v_chofer = tmp = $("#idchofer option:selected").text();
        var fila='';
        // validar los importes
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'validar_importe_DHRI.php',
          data: { id: id_hri},
          success: function(data){
            if (data)
            {
            //alert(data);
             var content = JSON.parse(data);
             console.log(content);
             if(content[0].url=='0')
             {// si no tiene url
              //alert(content[0].url);
              fila="<li class='list-group-item'>"+content[0].id+" : "+content[0].chofer+"</li>";
              listaHRI.push(content[0].id);
               console.log(listaHRI);
             }
             else fila="<li class='list-group-item list-group-item-danger'>"+content[0].id+" : "+content[0].chofer+"<a href='liquidacion.php?id="+content[0].id+"'> Editar Importes HRI </a></li>";
     
             $('#tabla').append(fila);
            }
        }
      });//fin ajax

     });//fin change


     // pasar arreglo por ajax a un php
     $('#enviar').click(function() {
          var vpor= $("#porcentaje").val(); 

          if ($('#porcentaje').val() == "")
          {
           alert('Ingrese Porcentaje.');
           return false;
          }

          $.ajax({
           type: "POST",
           url: "calcular_varias_hri.php",
           data: {lista: JSON.stringify(listaHRI), porcentaje: vpor},
           success: function(datos){

                console.log(datos);
                //alert("Aviso:"+datos);
                $('#resultado').html(datos);
                $('#tabla').empyt();
            },
           failure: function(errMsg) {
                alert("Error:"+errMsg);
           }
        });
        
    });

  })
</script>
</body>
</html>
