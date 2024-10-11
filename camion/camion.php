<?php
require_once '../conexion.php';
class camion
{
	public function lista()
	{
     $sql="SELECT * FROM camion";
     $listado = consulta_mysql($sql);
     return $listado;
    }


   public function nuevo($marca,$modelo,$patente,$provincia,
             $aseguradora,$vencseguro,$vencrevisiontecnica,$observaciones,
             $vencruta,$activo)
   {
	 $sql="INSERT INTO `camion`
            (`marca`,
             `modelo`,
             `patente`,
             `provincia`,
             `aseguradora`,
             `vencseguro`,
             `vencrevisiontecnica`,
             `observaciones`,
             `vencruta`,
             `activo`)
        VALUES ('$marca',
                '$modelo',
                '$patente',
                '$provincia',
                '$aseguradora',
                '$vencseguro',
                '$vencrevisiontecnica',
                '$observaciones',
                '$vencruta',
                '$activo');";
     $registro = consulta_mysql($sql);
     return $registro;
   }


   public function editar($id,$marca,$modelo,$patente,$provincia,
             $aseguradora,$vencseguro,$vencrevisiontecnica,$observaciones,
             $vencruta,$activo)
    {
     $sql="UPDATE `camion`
            SET 
              `marca` = '$marca',
              `modelo` = '$modelo',
              `patente` = '$patente',
              `provincia` = '$provincia',
              `aseguradora` = '$aseguradora',
              `vencseguro` = '$vencseguro',
              `vencrevisiontecnica` = '$vencrevisiontecnica',
              `observaciones` = '$observaciones',
              `vencruta` = '$vencruta',
              `activo` = '$activo'
               WHERE `id` = '$id'";
    $registro = consulta_mysql($sql);
  	return $registro;
	}


  public function obtenerId($id)
   {
	 $sql="SELECT * FROM camion where id='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

    public function eliminar($id)
	{
     $sql="DELETE FROM camion WHERE id ='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

}
?>

