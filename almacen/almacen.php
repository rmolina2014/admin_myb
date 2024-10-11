<?php
require_once '../conexion.php';
class almacen
{
  
  public function disponible($id)
  {
    $sql="SELECT `espaciodisponible`
              FROM `almacen`
              where id=$id";

     $listado = consulta_mysql($sql);

     $item = mysql_fetch_array($listado);

     return $item['espaciodisponible'];
    }

  public function lista()
  {
     $sql="SELECT
                `id`,
                `nombre`,
                `espaciototal`,
                `unidad`,
                `espaciodisponible`,
                `provincia_id`
              FROM `almacen`
              LIMIT 0, 1000; ";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($provincia_id,$tiempo,$espacio,$fechaingreso,$fechasalida,$cliente_id,$estado)
   {
    $sql="INSERT INTO `almacen`
            (`provincia_id`,
             `tiempo`,
             `espacio`,
             `fechaingreso`,
             `fechasalida`,`cliente_id`,`estado`)
        VALUES ('$provincia_id',
        '$tiempo',
        '$espacio',
        '$fechaingreso',
        '$fechasalida','$cliente_id','$estado');";
    $registro = consulta_mysql($sql);
    return $registro;
	 }


	public function editar($id,$provincia_id,$tiempo,$espacio,$fechaingreso,$fechasalida,$cliente_id,$estado)
	{
   	 $sql="UPDATE `almacen`
            SET `provincia_id` = '$provincia_id',
              `tiempo` = '$tiempo',
              `espacio` = '$espacio',
              `fechaingreso` = '$fechaingreso',
              `fechasalida` = '$fechasalida',
               `cliente_id` = '$cliente_id',
               `estado` = '$estado'
            WHERE `id` = '$id';";
     $registro = consulta_mysql($sql);
  	 return $registro;
	}

  public function obtenerId($id)
	{
  	 $sql="SELECT * FROM almacen where id='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	}

   public function eliminar($id)
   {
     $sql="DELETE FROM almacen WHERE id ='$id'";
     $registro = consulta_mysql($sql);
     return $registro;
	 }

}

?>
