<?php
require_once '../conexion.php';
require_once '../almacen/almacen.php';
class mercaderia
{
 
  public function validarEspacio($id,$espacio)
  {
     $sql="SELECT
                `espaciodisponible`
            FROM `almacen`
            WHERE id=$id";
     $listado = consulta_mysql($sql);
     
     if (!$listado) {
       die('No se pudo consultar:'.mysql_error());
     }
     
     $espaciodisponible=mysql_result($listado, 0); 
     
     if ($espaciodisponible >= $espacio)
      { 
        return 1;
      }
       else { return 0;}
 
   }


  public function lista()
  {
     $sql="SELECT `id`,
          `cliente_id`,
          `tipomercaderia`,
          `cantidad`,
          `almacen_id`,
          `espacio`,
          `unidad`,
          `fechaingreso`,
          `fechasalida`,
          `estado`
        FROM `mercaderia`";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($cliente_id,$tipomercaderia,$cantidad,$almacen_id,$espacio,$unidad,$fechaingreso,$fechasalida,$estado)
   {
    $sql="INSERT INTO `mercaderia`
            ( `cliente_id`,
             `tipomercaderia`,
             `cantidad`,
             `almacen_id`,
             `espacio`,
             `unidad`,
             `fechaingreso`,
             `fechasalida`,
             `estado`)
              VALUES ('$cliente_id',
                      '$tipomercaderia',
                      '$cantidad',
                      '$almacen_id',
                      '$espacio',
                      '$unidad',
                      '$fechaingreso',
                      '$fechasalida',
                      '$estado');";
    $registro = consulta_mysql($sql);

    /*obtener el espacio disponible*/
    $sql="SELECT `espaciodisponible`
              FROM `almacen`
              WHERE id=$almacen_id";
    $registro = consulta_mysql($sql);
    $espaciodisponible=mysql_result($registro, 0); 
    $espaciodisponible=$espaciodisponible-$espacio;



    /*actualizar el espacio disponible*/
    $sql="UPDATE `almacen`
              SET `espaciodisponible` = '$espaciodisponible'
                WHERE `id` = '$almacen_id';";
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
