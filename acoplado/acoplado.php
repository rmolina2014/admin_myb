<?php

require_once '../conexion.php';

class acoplado

{

  public function lista()
  {
     $sql="SELECT * FROM acoplado";
     $listado = consulta_mysql($sql);
     return $listado;
    }



   public function nuevo($fechacompra,$marca,$modelo,$fabricacion,$patente,
             $registroautomotor,$provincia,$aseguradora,$vencseguro,$vencreviciontecnica,
             $observaciones,$vencruta,
             $activo)
   {
    $sql="INSERT INTO `acoplado`
            (`fechacompra`,
             `marca`,
             `modelo`,
             `fabricacion`,
             `patente`,
             `registroautomotor`,
             `provincia`,
             `aseguradora`,
             `vencseguro`,
             `vencreviciontecnica`,
             `observaciones`,
             `vencruta`,
             `activo`)
VALUES ('$fechacompra',
        '$marca',
        '$modelo',
        '$fabricacion',
        '$patente',
        '$registroautomotor',
        '$provincia',
        '$aseguradora',
        '$vencseguro',
        '$vencreviciontecnica',
        '$observaciones',
        '$vencruta',
        '$activo');";
       $registro = consulta_mysql($sql);
       return $registro;
	 }



	public function editar($id,$fechacompra,$marca,$modelo,$fabricacion,$patente,
             $registroautomotor,$provincia,$aseguradora,$vencseguro,$vencreviciontecnica,
             $observaciones,$vencruta,
             $activo)

	{
   	 $sql="UPDATE `acoplado`
            SET 
              `fechacompra` = '$fechacompra',
              `marca` = '$marca',
              `modelo` = '$modelo',
              `fabricacion` = '$fabricacion',
              `patente` = '$patente',
              `registroautomotor` = '$registroautomotor',
              `provincia` = '$provincia',
              `aseguradora` = '$aseguradora',
              `vencseguro` = '$vencseguro',
              `vencreviciontecnica` = '$vencreviciontecnica',
              `observaciones` = '$observaciones',
              `vencruta` = '$vencruta',
              `activo` = '$activo'
            WHERE `id` = '$id';";
     $registro = consulta_mysql($sql);
  	 return $registro;
	}

  public function obtenerId($id)
	{
	 $sql="SELECT * FROM acoplado where id='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
	}

  public function eliminar($id)
	{
     $sql="DELETE FROM acoplado WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}
}
?>

