<?php
require_once '../conexion.php';
class tipogasto
{
	public function lista()
	{
     $sql="SELECT * FROM tipogasto";
     $listado = consulta_mysql($sql);
     return $listado;
    }
   public function nuevo($nombre)
   {
      $sql="INSERT INTO `tipogasto`
            (`descripcion`)
            VALUES ('$nombre'); ";
       $registro = consulta_mysql($sql);
       return $registro;
	 }

	public function editar($id,$nombre)
	{
 	 $sql="UPDATE `tipogasto`
            SET `id` = '$id',
              `descripcion` = '$nombre'
            WHERE `id` = '$id';";
     $usuarios = consulta_mysql($sql);
	 return $usuarios;
	}

  public function obtenerId($id)
	{
	 $sql="SELECT * FROM tipogasto where id='$id'";
   $alumnos = consulta_mysql($sql);
   return $alumnos;
	}

  public function eliminar($id)
	{
     $sql="DELETE FROM tipogasto WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}

}
?>
