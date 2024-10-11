<?php
require_once '../conexion.php';
class tipotrabajo
{
  public function lista()
  {
     $sql="SELECT * FROM tipotrabajo";
     $listado = consulta_mysql($sql);
     return $listado;
    }
   public function nuevo($nombre)
   {
      $sql="INSERT INTO `tipotrabajo`
            (`nombre`)
            VALUES ('$nombre'); ";
       $registro = consulta_mysql($sql);
       return $registro;
   }

  public function editar($id,$nombre)
  {
   $sql="UPDATE `tipotrabajo`
            SET `id` = '$id',
              `nombre` = '$nombre'
            WHERE `id` = '$id';";
     $usuarios = consulta_mysql($sql);
   return $usuarios;
  }

  public function obtenerId($id)
  {
   $sql="SELECT * FROM tipotrabajo where id='$id'";
   $alumnos = consulta_mysql($sql);
   return $alumnos;
  }

  public function eliminar($id)
  {
     $sql="DELETE FROM tipotrabajo WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
  }

}
?>
