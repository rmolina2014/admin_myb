<?php
require_once '../conexion.php';

class chofer
{
	public function lista()
	{
     $sql="SELECT * FROM chofer";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($nombre,$carnet,$vencecarnet,$dni,$domicilio,
        $localidad,$provincia,$telefonos,$email,$art,$polizart,
        $observaciones,$visacionanual,$categoriacarnet,
        $MIVencimiento,$MICategoria,$cursoinduccion,
        $CNRTVencimiento,$CNRTCategoria,$Activo)
   {
	$sql="INSERT INTO `chofer`
            (`nombre`,
             `carnet`,
             `vencecarnet`,
             `dni`,
             `domicilio`,
             `localidad`,
             `provincia`,
             `telefonos`,
             `email`,
             `art`,
             `polizart`,
             `observaciones`,
             `visacionanual`,
             `categoriacarnet`,
             `MIVencimiento`,
             `MICategoria`,
             `cursoinduccion`,
             `CNRTVencimiento`,
             `CNRTCategoria`,
             `Activo`)
VALUES ( '$nombre',
        '$carnet',
        '$vencecarnet',
        '$dni',
        '$domicilio',
        '$localidad',
        '$provincia',
        '$telefonos',
        '$email',
        '$art',
        '$polizart',
        '$observaciones',
        '$visacionanual',
        '$categoriacarnet',
        '$MIVencimiento',
        '$MICategoría',
        '$cursoinduccion',
        '$CNRTVencimiento',
        '$CNRTCategoría',
        '$Activo'
        )";
    $registro = consulta_mysql($sql);
    return $registro;
	}

	public function editar($id,$nombre,$carnet,$vencecarnet,$dni,$domicilio,
        $localidad,$provincia,$telefonos,$email,$art,$polizart,
        $observaciones,$visacionanual,$categoriacarnet,
        $MIVencimiento,$MICategoria,$cursoinduccion,
        $CNRTVencimiento,$CNRTCategoria,$Activo)
	{
      $sql="UPDATE `chofer`
      SET 
      `nombre` = '$nombre',
      `carnet` = '$carnet',
      `vencecarnet` = '$vencecarnet',
      `dni` = '$dni',
      `domicilio` = '$domicilio',
      `localidad` = '$localidad',
      `provincia` = '$provincia',
      `telefonos` = '$telefonos',
      `email` = '$email',
      `art` = '$art',
      `polizart` = '$polizart',
      `observaciones` = '$observaciones',
      `visacionanual` = '$visacionanual',
      `categoriacarnet` = '$categoriacarnet',
      `MIVencimiento` = '$MIVencimiento',
      `MICategoria` = '$MICategoria',
      `cursoinduccion` = '$cursoinduccion',
      `CNRTVencimiento` = '$CNRTVencimiento',
      `CNRTCategoria` = '$CNRTCategoria',
      `Activo` = '$Activo'
    WHERE `id` = '$id'";
   
         $usuarios = consulta_mysql($sql);
	 return $usuarios;
	}

  public function obtenerId($id)
	{
	 $sql="SELECT * FROM chofer where id='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
	}

    public function eliminar($id)
	{
     $sql="DELETE FROM chofer WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}

}
?>
