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
if( isset($_POST['id']) && !empty($_POST['id']) )
{
 $id_hri=(int)$_POST['id'];
 $contador=0;
 $objeto = new liquidacionfletero();
 $total=0;
 $listado = $objeto->traer_importe_DHRI($id_hri);
 $chofer="a";
 
  while( $item = mysqli_fetch_array($listado))
  {
     $chofer=$item['chofer']; 
    //echo $item['importe'];
    // validar los importes primero si es un decimal
   //  echo "<br>";
    if (!is_numeric($item['importe'])) 
    {
       $total++;
    }
  }

  if ($total>0) 
  {
   // armar un json

    $url='<a href="liquidacion.php?id='.$id_hri.'"> Editar </a>';

    $lista[] = array('id'=> $id_hri, 'chofer'=> $chofer, 'url'=>$url);
  /*
   
   ?>
     <li class='list-group-item list-group-item-danger'>
      <? echo $id_hri." : ".$chofer;?>
      <a href="liquidacion.php?id=<?echo $id_hri; ?>"> Editar </a>
     </li>
    <?
      //exit();*/
    } else {

      $lista[] = array('id'=> $id_hri, 'chofer'=> $chofer,'url'=>0);
      
      /*?>
      
        <li class='list-group-item'>  
        <? echo $id_hri." : ".$chofer ;?>
      </li>
    <?*/
    }

    $json_string = json_encode($lista);
echo $json_string;
}
?>
