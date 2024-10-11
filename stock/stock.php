<?php
require_once '../conexion.php';
class stock
{
  public function lista()
  {
     $sql="SELECT
          cliente.`nombrereal` AS cliente, stock.`comEgreso` AS comEgreso, stock.`comIngreso` AS comIngreso, stock.`descripcion` AS descripcion, stock.`estado` AS estado, stock.`fechaingreso` AS fechaingreso, stock.`fechasalida` AS fechasalida, stock.`id` AS id
          FROM
              `stock`
              INNER JOIN `cliente` 
                  ON (`stock`.`cliente_id` = `cliente`.`id`);";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($cliente_id,$comIngreso,$comEgreso,$descripcion,$fechaingreso,$fechasalida,$estado)
   {
    $sql="INSERT INTO `stock`
            (`cliente_id`,
             `comIngreso`,
             `comEgreso`,
             `descripcion`,
             `fechaingreso`,
             `fechasalida`,
             `estado`)
        VALUES (
        '$cliente_id',
        '$comIngreso',
        '$comEgreso',
        '$descripcion',
        '$fechaingreso',
        '$fechasalida',
        '$estado');";
    $registro = consulta_mysql($sql);
    return $registro;
	 }


	public function editar($id,$cliente_id,$comIngreso,$comEgreso,$descripcion,$fechaingreso,$fechasalida,$estado)
	{
   	 $sql="UPDATE `stock`
            SET
              `cliente_id` = '$cliente_id',
              `comIngreso` = '$comIngreso',
              `comEgreso` = '$comEgreso',
              `descripcion` = '$descripcion',
              `fechaingreso` = '$fechaingreso',
              `fechasalida` = '$fechasalida',
              `estado` = '$estado'
            WHERE `id` = '$id';";
     $registro = consulta_mysql($sql);
  	 return $registro;
	}

  public function obtenerId($id)
	{
  	 $sql="SELECT * FROM stock where id='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

   public function eliminar($id)
   {
     $sql="DELETE FROM stock WHERE id ='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	 }

}
?>
