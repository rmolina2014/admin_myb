<?php
require_once '../conexion.php';

class provincia
{
	public function lista()
	{
     $sql="SELECT * FROM provincia";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($nombre)
   {
      $sql="INSERT INTO `provincia`
            (`nombre`)
VALUES ('$nombre'); ";
       $registro = consulta_mysql($sql);
       return $registro;
	 }


	public function editar($id,$nombre)
	{
 	 $sql="UPDATE `provincia`
            SET `id` = '$id',
              `nombre` = '$nombre'
            WHERE `id` = '$id';";
     $usuarios = consulta_mysql($sql);
	 return $usuarios;
	}

  public function obtenerId($id)
	{
	 $sql="SELECT * FROM provincia where id='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
	}

    public function eliminar($id)
	{
     $sql="DELETE FROM provincia WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}

}
?>
