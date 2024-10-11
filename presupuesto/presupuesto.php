<?php
require_once '../conexion.php';
class presupuesto
{
	public function lista()
	{
     $sql="SELECT * FROM presupuesto where estado='Pendiente' order by fecha desc";
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function lista_presupuesto_historico()
  {
     $sql="SELECT * FROM presupuesto where estado='Historico'order by fecha desc ";
     $listado = consulta_mysql($sql);
     return $listado;
    }


   public function nuevo($dni,$nombre,$empresa,$email,$telefono,$ancho,$alto,$largo,$precio1,$peso,$valorpeso,
        $retiro,$otros,$seguro,$detalle,$fecha,$s_total1,$s_total2,$s_total3,$s_total4,$s_total5,$totalgeneral,$estado)
   {
	$sql="INSERT INTO `presupuesto`
            (`dni`,
             `nombre`,
             `empresa`,
             `email`,
             `telefono`,
             `ancho`,
             `alto`,
             `largo`,
             `precio1`,
             `peso`,
             `valorpeso`,
             `retiro`,
             `otros`,
             `seguro`,
             `detalle`,
             `fecha`,
             `s_total1`,
             `s_total2`,
             `s_total3`,
             `s_total4`,
             `s_total5`,
             `totalgeneral`,
             `estado`)
VALUES ('$dni',
        '$nombre',
        '$empresa',
        '$email',
        '$telefono',
        '$ancho',
        '$alto',
        '$largo',
        '$precio1',
        '$peso',
        '$valorpeso',
        '$retiro',
        '$otros',
        '$seguro',
        '$detalle',
        '$fecha',
        '$s_total1',
        '$s_total2',
        '$s_total3',
        '$s_total4',
        '$s_total5',
        '$totalgeneral',
        '$estado'
        )";
     $registro = consulta_mysql($sql);
     return $registro;
   }

   public function editar($id,$dni,$nombre,$empresa,$email,$telefono,$ancho,$alto,$largo,$precio1,$peso,$valorpeso,
        $retiro,$otros,$seguro,$detalle,$fecha,$s_total1,$s_total2,$s_total3,$s_total4,$s_total5,$totalgeneral,$estado)
   {
      $sql="UPDATE `presupuesto`
            SET 
              `dni` = '$dni',
              `nombre` = '$nombre',
              `empresa` = '$empresa',
              `email` = '$email',
              `telefono` = '$telefono',
              `ancho` = '$ancho',
              `alto` = '$alto',
              `largo` = '$largo',
              `precio1` = '$precio1',
              `peso` = '$peso',
              `valorpeso` = '$valorpeso',
              `retiro` = '$retiro',
              `otros` = '$otros',
              `seguro` = '$seguro',
              `detalle` = '$detalle',
              `fecha` = '$fecha',
              `s_total1` = '$s_total1',
              `s_total2` = '$s_total2',
              `s_total3` = '$s_total3',
              `s_total4` = '$s_total4',
              `s_total5` = '$s_total5',
              `totalgeneral` = '$totalgeneral',
              `estado` = '$estado'
               WHERE `id` = '$id';";

     $registro = consulta_mysql($sql);
  	 return $registro;
	 }

  public function obtenerId($id)
  {
	 $sql="SELECT * FROM presupuesto where id='$id'";
   $registro = consulta_mysql($sql);
   return $registro;
	}

  public function eliminar($id)
	{
     $sql="DELETE FROM presupuesto WHERE id ='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

}
?>

