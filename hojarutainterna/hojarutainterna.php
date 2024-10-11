<?php
require_once '../conexion.php';
class hojarutainterna
{
	public function lista()
	{
     $sql=" SELECT
    chofer.`nombre` AS nombrechofer,
    camion.`patente` AS patentecamion,
    hojarutainterna.`fecha` AS fecha,
    hojarutainterna.`id` AS numero,
	hojarutainterna.`estado` AS estado
    FROM
        `hojarutainterna`
        INNER JOIN `chofer`
            ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
        INNER JOIN `camion`
            ON (`hojarutainterna`.`idcamion` = `camion`.`id`) where estado <> 'Terminado' order by numero desc";
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function listaterminados()
	{
     $sql=" SELECT
    chofer.`nombre` AS nombrechofer,
    camion.`patente` AS patentecamion,
    hojarutainterna.`fecha` AS fecha,
    hojarutainterna.`id` AS numero,
	hojarutainterna.`estado` AS estado
    FROM
        `hojarutainterna`
        INNER JOIN `chofer`
            ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
        INNER JOIN `camion`
            ON (`hojarutainterna`.`idcamion` = `camion`.`id`) where estado like 'Terminado' order by numero desc";
            
          
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($fecha,$estado,$idchofer,$idcamion)
   {
		 $sql="INSERT INTO `hojarutainterna`
            (`fecha`,
             `estado`,
             `idchofer`,
             `idcamion`)
				VALUES ('$fecha',
				        '$estado',
				        '$idchofer',
				        '$idcamion');";
		 $listado = consulta_mysql($sql);
	  $link = mysqli_connect("localhost","surexpre_nuevo","rawson2018$","surexpre_2018");
       $id=mysqli_insert_id($link); //ultimo id insertado
       return $id;
	 }

	 /*cabecera hrinterna*/
	public function cabecerahr($idhr)
	{
		$sql="SELECT
					chofer.`nombre` AS nombrechofer,
					camion.`patente` AS patentecamion,
					hojarutainterna.`fecha` AS fecha,
					hojarutainterna.`id` AS numero
					FROM `hojarutainterna`
							INNER JOIN `chofer`
									ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
							INNER JOIN `camion`
									ON (`hojarutainterna`.`idcamion` = `camion`.`id`)
									 where hojarutainterna.`id`=$idhr";
	 $listado = consulta_mysql($sql);
	 return $listado;
	}

	public function listaremito($idhr)
	{
		$sql_antes="SELECT
		        remito.`id` AS remitoid,
		        remito.`fecha` AS fecha,
				remito.`numero` AS numeroremito,
				remito.`nomcliente` AS nombrecliente,
				remito.`nomproveedor` AS nombreproveedor,
				remito.`bultos` AS bultos,
				remito.`descripcion` AS descripcion,
                detalleinterna.`remitose` AS remitose,
                detalleinterna.`importe` AS importe
         	FROM
	    `hojarutainterna`
	    INNER JOIN `detalleinterna`
	        ON (`hojarutainterna`.`id` = `detalleinterna`.`idinterna`)
	    INNER JOIN `remito`
	        ON (`detalleinterna`.`idremito` = `remito`.`id`) where `detalleinterna`.`idinterna`=$idhr";
	 // se fuerza el orden de impresion
    $sql="SELECT remito.`id` AS remitoid, remito.`fecha` AS fecha, remito.`numero` AS numeroremito, remito.`nomcliente` AS nombrecliente, remito.`nomproveedor` AS nombreproveedor, remito.`bultos` AS bultos, remito.`descripcion` AS descripcion, detalleinterna.`remitose` AS remitose, detalleinterna.`importe` AS importe, detalleinterna.id as orden FROM `hojarutainterna` INNER JOIN `detalleinterna` ON (`hojarutainterna`.`id` = `detalleinterna`.`idinterna`) INNER JOIN `remito` ON (`detalleinterna`.`idremito` = `remito`.`id`) where `detalleinterna`.`idinterna`=$idhr order by orden";         
	 $listado = consulta_mysql($sql);
	 return $listado;
	}

    public function obtenerId($id)
	{
	 $sql="SELECT * FROM hojarutainterna where id='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
	}

    public function eliminar($id)
	{
     $sql="DELETE FROM hojarutainterna WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}

	public function cambiarEstado($id,$estado)
	{
	$sql="UPDATE`hojarutainterna`
					SET  `estado` = '$estado'
					WHERE `id` = '$id'";
	$listado = consulta_mysql($sql);
	return $listado;
	}

}
?>