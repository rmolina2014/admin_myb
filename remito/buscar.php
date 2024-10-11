<?php
session_name("sesion_prest");
session_start();
if (isset($_SESSION['sesion_usuario'])){
 $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
}
else { header ("Location: index.html");} 

require_once '../cliente/cliente.php';
require_once '../conexion.php';
?>

 <form class="form-inline" action="buscar.php" method="post">
      <fieldset>
      <legend>Buscador</legend>
     <label for="textfield">Buscador Por Cuit:</label>
     <input name="cuit" type="text" id="cuit" size="15" maxlength="13" />
     <label for="textfield">Buscador Por Nombre:</label>
     <input name="nombre" type="text" id="nombre" size="15" maxlength="70" />
     <button type="submit" >Buscar</button>
 </form>
 <hr>
 <?
 if (isset($_POST['cuit']) or isset($_POST['nombre']) )
 {
   $cuil=$_POST['cuit'];
   $nombre=$_POST['nombre'];
 ?>
  <table id="listado" class="table">
   <thead>
    <tr>
    <?

  if ($cuit) $sql="SELECT id,nombrefantasia, nombrereal, cuit FROM cliente where cuit REGEXP '$cuit' ";
  if ($nombre) $sql="SELECT id,nombrefantasia, nombrereal, cuit FROM cliente where nombrefantasia REGEXP '$nombre' or nombrereal REGEXP '$nombre' ";
  $lista = consulta_mysql($sql);
  $i=0;
 ?>
 <th>  Nombre Fantasia  </th>
 <th>  Nombre Real  </th>
 <th>  Cuil  </th>
 </tr>
  <?
 while( $campos = mysqli_fetch_array($lista))
  {
  ?>
  <tr>
  <td><?echo $campos['nombrefantasia'];?></td>
  <td><?echo $campos['nombrereal'];?></td>
  <td><?echo $campos['cuit'];?></td>
  <td>
      <button name="cliID<? echo $campos['id'];?>" id="cliID<? echo $campos['id'];?>" class="btn btn-primary btn-xs" >Agregar</button>
  </td>
  </tr>
  <?
  }
  ?>
  </thead>
  <tbody>
   <div id="cliente"></div>
  <?
  }
?>
<script type="text/javascript">
$(document).ready(function(){
  
 //borra arancel 21072014
 $("button[id^='cliID']").click(function(evento){
    evento.preventDefault();
    idcliente = this.id.substr(5,10);
    $.post('traerdatos.php',
           {id:idcliente},
           function(data){
          
            $("#cliente").append(data);


           }, "html");
    location.reload();
  });//fin clic

 
})// fin jquery


</script>
</head>
<body>