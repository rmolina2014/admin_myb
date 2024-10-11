<?php
require_once '../conexion.php';
class factura_proveedor
{
	public function lista()
	{
     $sql="SELECT
            proveedoressurexpre.`nombre` AS nombre,
            facturaproveedor.`id` AS id,
            facturaproveedor.`numero` AS numero,
            facturaproveedor.`proveedor_id` AS proveedor_id,
            facturaproveedor.`detalle` AS detalle,
            facturaproveedor.`fecha` AS fecha,
            facturaproveedor.`estado` AS estado,
            facturaproveedor.`monto` AS monto
            FROM
                `facturaproveedor`
                INNER JOIN `proveedoressurexpre` 
                    ON (`facturaproveedor`.`proveedor_id` = `proveedoressurexpre`.`id`);";
     $listado = consulta_mysql($sql);
     return $listado;
    }

  public function nuevo($numero,$proveedor_id,$detalle,$fecha,$monto,$estado)
  {
	 $sql="INSERT INTO `facturaproveedor`
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
                '$estado');";
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
	 $sql="SELECT * FROM facturaproveedor where id='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

  
  public function buscar_remito_proveedor($proveedor_id)
  {
   $sql="SELECT `id`,`numero`,
                `proveedor_id`,
                `detalle`,
                `fecha`,
                `monto`,
                `estado`
                FROM `remitosproveedor`
                where proveedor_id='$proveedor_id' and  `estado`='Activo' ";
   $registro = consulta_mysql($sql);
   return $registro;
  }

  public function eliminar($id)
	{
     $sql="DELETE FROM facturaproveedor WHERE id ='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

  public function datos_factura($factura_id)
  {
   $sql="SELECT
            proveedoressurexpre.`nombre` AS nombre,
            facturaproveedor.`id` AS id,
            facturaproveedor.`numero` AS numero,
            facturaproveedor.`proveedor_id` AS proveedor_id,
            facturaproveedor.`detalle` AS detalle,
            facturaproveedor.`fecha` AS fecha,
            facturaproveedor.`estado` AS estado,
            facturaproveedor.`monto` AS monto
            FROM
                `facturaproveedor`
                INNER JOIN `proveedoressurexpre` 
                    ON (`facturaproveedor`.`proveedor_id` = `proveedoressurexpre`.`id`) where `facturaproveedor`.`id`=$factura_id";
   $registro = consulta_mysql($sql);
   return $registro;
  }

  //24042017
  public function marcar($id_remito,$id_factura)
  {
   $fecha= date('Y-m-d'); 
   $sql="INSERT INTO `factura_remito`
            (`factura_id`,`remito_id`,`fecha`)
            VALUES ('$id_factura','$id_remito','$fecha')";
   $registro = consulta_mysql($sql);

   $sql="UPDATE `remitosproveedor`
          SET  `estado` = 'Cancelado'
          WHERE `id` = '$id_remito'";
    $registro = consulta_mysql($sql);       
   return $registro;
  }


}
?>

