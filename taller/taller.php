<?php
require_once '../conexion.php';
class taller
{
	public function lista()
	{
     $sql="SELECT
                taller.`id` AS id,taller.`patente_id` AS patente_id,
                taller.`fechaservicio` AS fechaservicio, taller.`kmingreso` AS kmingreso,tipotrabajo.`nombre` tipotrabajo,taller.`costo` AS costo,taller.`lugar` AS lugar,taller.`observacion` AS observacion
                FROM
                    `taller`
                    INNER JOIN `tipotrabajo` 
                        ON (`taller`.`tipotrabajo_id` = `tipotrabajo`.`id`);";
     $listado = consulta_mysql($sql);
     return $listado;
    }


   public function nuevo($patente_id,$fechaservicio,$kmingreso,$tipotrabajo_id,$costo,$lugar,$observacion,$tipo)
   {
	  $sql="INSERT INTO `taller`
            (`patente_id`,
             `fechaservicio`,
             `kmingreso`,
             `tipotrabajo_id`,
             `costo`,
             `lugar`,
             `observacion`,
             `tipo`)
            VALUES ('$patente_id',
                    '$fechaservicio',
                    '$kmingreso',
                    '$tipotrabajo_id',
                    '$costo',
                    '$lugar',
                    '$observacion',
                    '$tipo');";
                   
     $registro = consulta_mysql($sql);
     return $registro;
   }


  public function editar($id,$patente_id,$fechaservicio,$kmingreso,$tipotrabajo_id,$costo,$lugar,$observacion,$tipo)
  {
    $sql="UPDATE `taller`
          SET 
            `patente_id` = '$patente_id',
            `fechaservicio` = '$fechaservicio',
            `kmingreso` = '$kmingreso',
            `tipotrabajo_id` = '$tipotrabajo_id',
            `costo` = '$costo',
            `lugar` = '$lugar',
            `observacion` = '$observacion',
            `tipo` = '$tipo'
          WHERE `id` = '$id';";
    $registro = consulta_mysql($sql);
  	return $registro;
	}


  public function obtenerId($id)
  {
	 $sql="SELECT * FROM taller where id='$id'";
   $registro = consulta_mysql($sql);
   return $registro;
	}

  public function eliminar($id)
	{
    $sql="DELETE FROM taller WHERE id ='$id'";
    $registro = consulta_mysql($sql);
    return $registro;
	}

  public function consultaPatente($patente,$fechaDesde,$fechaHasta)
  {
     $sql="SELECT
                taller.`id` AS id,
                taller.`patente_id` AS patente,taller.`fechaservicio` AS fechaservicio, taller.`kmingreso` AS kmingreso,tipotrabajo.`nombre` tipotrabajo,taller.`costo` AS costo,taller.`lugar` AS lugar,taller.`observacion` AS observacion
                FROM
                    `taller`
                    INNER JOIN `tipotrabajo` 
                        ON (`taller`.`tipotrabajo_id` = `tipotrabajo`.`id`)
                         where `taller`.`patente_id` ='$patente' and taller.`fechaservicio`>='$fechaDesde' and taller.`fechaservicio`<='$fechaHasta' ";
     $listado = consulta_mysql($sql);
     return $listado;
    }

}
?>

