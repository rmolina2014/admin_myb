<?
require_once 'presupuesto.php';
$objecto = new presupuesto();
if( isset($_POST['idPresupuesto']) && !empty($_POST['idPresupuesto']) )

 {
        $idPresupuesto= $_POST['idPresupuesto'];
        $dni= $_POST['dni'];
        $telefono= $_POST['telefono'];
        $email= $_POST['email'];
        $empresa= $_POST['empresa'];
        $nombre= $_POST['nombre'];

        $ancho= $_POST['ancho'];
        $alto= $_POST['alto'];
        $largo= $_POST['largo'];
        $precio1= $_POST['precio1'];

        $peso= $_POST['peso'];
        $valorpeso= $_POST['valorpeso'];

        $retiro= $_POST['retiro'];
        $otros= $_POST['otros'];
        $seguro= $_POST['seguro'];
        $detalle= $_POST['detalle'];
        $fecha= date('Y-m-d');
        $s_total1=($ancho*$alto*$largo*$precio1);
        $s_total2=($peso*$valorpeso);
        $s_total3=($retiro);
        $s_total4=($otros);
        $s_total5=(($seguro*0.7)/100);
        
        $totalgeneral=($s_total1+$s_total2+$s_total3+$s_total4+$s_total5);
        $estado=$_POST['estado'];
    

  $todobien = $objecto->editar($idPresupuesto,$dni,$nombre,$empresa,$email,$telefono,$ancho,$alto,$largo,$precio1,$peso,$valorpeso,
        $retiro,$otros,$seguro,$detalle,$fecha,$s_total1,$s_total2,$s_total3,$s_total4,$s_total5,$totalgeneral,$estado);

  if($todobien){
      echo "se Registro en la BD";
      echo "<script language=Javascript> location.href=\"listado.php\"; </script>";
      //header('Location: listado.php');
      exit;
    }
    else {
    ?>
         <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
         <button data-dismiss="alert" class="close" type="button">×</button>
         Lo sentimos, no se pudo guardar ...
         </div>
    <?
    }
}
else
{
  echo 'faltan datos';
 
  }
 ?>
