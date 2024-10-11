<?php
require_once '../conexion.php';
class remitosproveedor
{
	public function lista()
	{
     $sql="SELECT
      proveedoressurexpre.`nombre` AS nombre,
      remitosproveedor.`id` AS id,
      remitosproveedor.`proveedor_id` AS proveedor_id,
      remitosproveedor.`numero` AS numero,
      remitosproveedor.`detalle` AS detalle,
      remitosproveedor.`fecha` AS fecha,
      remitosproveedor.`monto` AS monto,
      remitosproveedor.`estado` AS estado
      FROM
          `remitosproveedor`
          INNER JOIN `proveedoressurexpre` 
              ON (`remitosproveedor`.`proveedor_id` = `proveedoressurexpre`.`id`) where remitosproveedor.`estado`='Activo' ";
     $listado = consulta_mysql($sql);
     return $listado;
    }


   public function nuevo($numero,$proveedor_id,$detalle,$fecha,$monto,$estado)
   {
	 $sql="INSERT INTO `remitosproveedor`
            (`numero`,
             `proveedor_id`,
             `detalle`,
             `fecha`,
             `monto`,
             `estado`)
              VALUES ('$numero',
                      '$proveedor_id',
                      '$detalle',
                      '$fecha',
                      '$monto',
                      '$estado')";
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
	 $sql="SELECT
proveedoressurexpre.`nombre` AS nombre,
remitosproveedor.`id` AS id,
remitosproveedor.`proveedor_id` AS proveedor_id,
remitosproveedor.`numero` AS numero,
remitosproveedor.`detalle` AS detalle,
remitosproveedor.`fecha` AS fecha,
remitosproveedor.`monto` AS monto,
remitosproveedor.`estado` AS estado
FROM
    `remitosproveedor`
    INNER JOIN `proveedoressurexpre` 
        ON (`remitosproveedor`.`proveedor_id` = `proveedoressurexpre`.`id`)
         where remitosproveedor.`id`='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

    public function eliminar($id)
	{
     $sql="DELETE FROM remitosproveedor WHERE id ='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

}
?>

