 <?php
 //------------------
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
  $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
 }
  else { header ("Location: ../index.php"); }
 //-----------------
require_once 'presupuesto.php';
include '../cabecera.html';
?>

<style type="text/css" media="print">
@media print {
  body { 
         font-size:20px;
         }
        
#noimprimir {display:none;}
#parte2 {display:none;}

}
</style>
<?
function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
//si viniera en otro formato, adaptad el explode y el orden de las variables a lo que necesitéis
//creamos un objeto DateTime (existe desde PHP 5.2)
    $fecha = new DateTime();
//definimos la fecha pasándole las variabes antes extraídas
        $fecha->setDate($yy, $mm, $dd);
//y ahora el propio objeto nos permite definir el formato de fecha para imprimir que queramos       
    echo $fecha->format('d-m-Y');
}

if( isset($_GET['id']) && !empty($_GET['id']) )
{
  $id= $_GET['id'];
?>
 <div class="container">
 <div class="row">
  
  <div class="col-xs-12">
    <h2>Presupuesto Nº : <?echo $id;?> </h2>
    <br>

   <?  
     $listado = presupuesto::obtenerId($id);
     while( $item = mysqli_fetch_array($listado))
     {
        $fecha=$item['fecha']
     ?> 
      <h3> Fecha : <?echo cambiaf_mysql($item['fecha']);?> </h3>
        <br>
     <hr>
     <div class="row">
       <div class="col-xs-8">
        <h3> Contacto : <?echo $item['nombre'];?> </h3>
        <h3> Empresa  : <?echo $item['empresa'];?> </h3>
        <h3> Email    : <?echo $item['email'];?> </h3>
        <h3> Telefono : <?echo $item['telefono'];?> </h3>
       
       </div>
       <div class="col-xs-12">
         <hr>
         <h5> Alto : <?echo $item['alto'];?> Ancho : <?echo $item['ancho'];?> Largo : <?echo $item['largo'];?>...............$ <?echo $item['s_total1'];?></h5>
         
         <h5> Peso en Kg.: <?echo $item['peso'];?> ...............$ <?echo $item['s_total2'];?></h5>
         <h5> Retiro       : ...............$ <?echo $item['s_total3'];?></h5>
         <h5> Otros        : ...............$ <?echo $item['s_total4'];?></h5>
         <h5> Valor Seguro : ...............$ <?echo $item['s_total5'];?></h5>
           <br>
         <hr>
         <h3>Total : $ <?echo $item['totalgeneral'];?></h3>
        <hr>
          <br>
        <h4> Detalles: <?echo $item['detalle'];?></h4> 
        <!--fin listado remitos-->
<?}?>
</div>
</div>
</div>
</div>


 <!--fin listado remitos-->
<div id='noimprimir'>
<button onclick="window.print();" class="btn btn-primary"> Imprimir </button>

</div>
</div>
<?}?>



