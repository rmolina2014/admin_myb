<?php
require_once '../conexion.php';
class rastreo
{
	public function lista()
	{
     $sql="SELECT
cliente.`nombrereal` AS nombre,
cliente.`id` AS clienteid,
rastreo.`fecha` AS fecha,
rastreo.`id` AS id,
rastreo.`idcliente` AS idcliente,
rastreo.`nombreusuario` AS nombreusuario,
rastreo.`password` AS password
FROM
    `cliente`
    INNER JOIN `rastreo` 
        ON (`cliente`.`id` = `rastreo`.`idcliente`);";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($idcliente,$nombreusuario,$password,$fecha)
   {
	    //$password=md5($password);
      $sql="INSERT INTO `rastreo`
            (`idcliente`,
             `nombreusuario`,
             `password`,
             `fecha`)
VALUES ('$idcliente',
        '$nombreusuario',
        '$password',
        '$fecha')";
       $registro = consulta_mysql($sql);
       return $registro;
	 }


	public function editar($id,$usuario,$nombre,$email,$sucursal)
	{
   $sql="UPDATE `usuario`
           SET  `usuario` = '$usuario',
               `nombre` = '$nombre',
          `email` = '$email',
          `sucursal` = '$sucursal'
           WHERE `id` = '$id'";
   $usuarios = consulta_mysql($sql);
	 return $usuarios;
	}

  public function obtenerId($id)
	{
	 $sql="SELECT * FROM rastreo where id='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
	}

  public function eliminar($id)
	{
     $sql="DELETE FROM rastreo WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}

}
?>
