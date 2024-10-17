<?php
require_once '../conexion.php';
class liquidacionfletero
{
    public function lista()
    {
        $sql1 = "SELECT 
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
            ON (`hojarutainterna`.`idcamion` = `camion`.`id`)                 
            WHERE estado <> 'Terminado' ORDER BY numero DESC";

        $sql2 = "SELECT 
    chofer.`nombre` AS nombrechofer,
    camion.`patente` AS patentecamion,
    hojarutainterna.`fecha` AS fecha,
    hojarutainterna.`id` AS numero,
	hojarutainterna.`estado` AS estado,
    hojarutainterna.`importefletero` AS importefletero,
    hojarutainterna.`porcentaje_fletero` AS porcentaje_fletero
	FROM
        `hojarutainterna`
        INNER JOIN `chofer`
            ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
        INNER JOIN `camion`
            ON (`hojarutainterna`.`idcamion` = `camion`.`id`)                 
             ORDER BY numero DESC";



        $sql = "SELECT     chofer.`nombre` AS nombrechofer,
    camion.`patente` AS patentecamion,
    hojarutainterna.`fecha` AS fecha,
    hojarutainterna.`id` AS numero,
    hojarutainterna.`estado` AS estado,
    hojarutainterna.`importe_fletero` AS importe_fletero,
    hojarutainterna.`porcentaje_fletero` AS porcentaje_fletero
      FROM
        `hojarutainterna`
    INNER JOIN `camion` 
        ON (`hojarutainterna`.`idcamion` = `camion`.`id`)
    INNER JOIN `chofer` 
        ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
        ORDER BY numero DESC";



        $listado = consulta_mysql($sql);
        return $listado;
    }

    public function listaterminados()
    {
        $sql = " SELECT
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

    /*cabecera hrinterna*/
    public function cabecerahri($idhr)
    {
        $sql = "SELECT chofer.`nombre` AS nombrechofer, camion.`patente` AS patentecamion, hojarutainterna.`fecha` AS fecha, hojarutainterna.`id` AS numero,
    hojarutainterna.`importe_fletero` AS importe,
    hojarutainterna.`porcentaje_fletero` AS porcentaje
     FROM hojarutainterna INNER JOIN `camion` 
ON (`hojarutainterna`.`idcamion` = `camion`.`id`)
 INNER JOIN `chofer` ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
  WHERE hojarutainterna.`id`=$idhr";
        //echo $sql; exit();                                
        $listado = consulta_mysql($sql);
        return $listado;
    }

    public function obtenerId($id)
    {
        $sql = "SELECT * FROM hojarutainterna where id='$id'";
        $alumnos = consulta_mysql($sql);
        return $alumnos;
    }

    public function listaremito($idhr)
    {
        $sql_antes = "SELECT
		        remito.`id` AS remitoid,
		        remito.`fecha` AS fecha,
				remito.`numero` AS numeroremito,
				remito.`nomcliente` AS nombrecliente,
				remito.`nomproveedor` AS nombreproveedor,
				remito.`bultos` AS bultos,
				remito.`descripcion` AS descripcion,
				detalleinterna.`id` AS detalleinterna_id,
                detalleinterna.`remitose` AS remitose,
                detalleinterna.`importe` AS importe,
                detalleinterna.`importefletero` AS importefletero
         	FROM
	    `hojarutainterna`
	    INNER JOIN `detalleinterna`
	        ON (`hojarutainterna`.`id` = `detalleinterna`.`idinterna`)
	    INNER JOIN `remito`
	        ON (`detalleinterna`.`idremito` = `remito`.`id`) where `detalleinterna`.`idinterna`=$idhr";
        // se fuerza el orden de impresion
        $sql = "SELECT remito.`id` AS remitoid, remito.`fecha` AS fecha, remito.`numero` AS numeroremito, remito.`nomcliente` AS nombrecliente, remito.`nomproveedor` AS nombreproveedor, remito.`bultos` AS bultos, remito.`descripcion` AS descripcion, detalleinterna.`remitose` AS remitose, detalleinterna.`importe` AS importe,detalleinterna.`importefletero` AS importefletero, detalleinterna.`id` as orden,	detalleinterna.`id` AS detalleinterna_id FROM `hojarutainterna` INNER JOIN `detalleinterna` ON (`hojarutainterna`.`id` = `detalleinterna`.`idinterna`) INNER JOIN `remito` ON (`detalleinterna`.`idremito` = `remito`.`id`) where `detalleinterna`.`idinterna`=$idhr order by orden";
        $listado = consulta_mysql($sql);
        return $listado;
    }

    //actualizar h r i con porcentaje
    public function actualizarhrint($idhrint, $porcentaje, $total)
    {
        $sql = "UPDATE `hojarutainterna`
            SET 
              `porcentaje_fletero` = '$porcentaje',
  `importe_fletero` = '$total'
            WHERE `id` = '$idhrint';";
        $listado = consulta_mysql($sql);
        return $listado;
    }

    //actualizar h r i con porcentaje
    public function actualizar_importe($id, $importe)
    {
        $sql = "UPDATE `detalleinterna`
            SET 
            `importe` = '$importe'
            WHERE `id` = '$id';";
        $listado = consulta_mysql($sql);
        return $listado;
    }

    //listar los montos de una DHRI
    public function traer_importe_DHRI($idhrint)
    {
        $sql = "SELECT
            chofer.`nombre` AS chofer,
            hojarutainterna.`id` AS id_hri,
            detalleinterna.`id` AS id_dhri,
            detalleinterna.`importe` AS importe
            FROM
                `detalleinterna`
                INNER JOIN `hojarutainterna` 
                    ON (`detalleinterna`.`idinterna` = `hojarutainterna`.`id`)
                INNER JOIN `chofer` 
                    ON (`hojarutainterna`.`idchofer` = `chofer`.`id`) WHERE idinterna =" . $idhrint;

        $listado = consulta_mysql($sql);
        return $listado;
    }

    /** TRAE LOS ID Y LOS IMPORTES PARA CAULCULAR EL IMPORTE DEL FLETERO**/
    public function lista_detalleHRI($id)
    {
        $sql = "SELECT
          detalleinterna.`id` AS detalleHRI, detalleinterna.`importe` AS importe
          FROM   `hojarutainterna`
          INNER JOIN `detalleinterna` 
          ON (`hojarutainterna`.`id` = `detalleinterna`.`idinterna`)
          WHERE `hojarutainterna`.`id`=" . $id;
        $listado = consulta_mysql($sql);
        return $listado;
    }

    /** ACTUALIZAR LOS IMPORTES_FLETERO DE dhri **/
    public function actualizar_importe_fletero($id, $importe_fletero)
    {
        $sql = "UPDATE `detalleinterna`
            SET 
            `importefletero` = '$importe_fletero'
            WHERE `id` = '$id';";
        $listado = consulta_mysql($sql);
        return $listado;
    }

    /** ACTUALIZAR HRI con el porcentaje y el total del fletero **/
    public function actualizar_porcentaje_importe_fletero($id, $total_fletero, $porcentaje)
    {
        $sql = "UPDATE `hojarutainterna`
          SET 
            `porcentaje_fletero` = '$porcentaje',
            `importe_fletero` = '$total_fletero'
          WHERE `id` = '$id'";
        $listado = consulta_mysql($sql);
        return $listado;
    }

    public function obtenerDatosLiquidacion($id)
    {
        $sql = "SELECT * FROM hojarutainterna WHERE id = $id";
        $datos = consulta_mysql($sql);
        return mysqli_fetch_assoc($datos);
    }

    /**
     * Obtiene un resumen de una hoja de ruta interna especifica por ID.
     *
     * Esta funci n ejecuta una consulta SQL para obtener detalles sobre una hoja de ruta interna
     * particular, incluyendo su fecha, chofer asociado, porcentaje para el fletero y montos de importe.
     *
     * @param int $id El ID de la hoja de ruta interna a obtener.
     * @return array|false Un arreglo asociativo con los detalles del resumen, o false en caso de error.
     */
    public function listaResumen($id)
    {
        $sql = "SELECT
hojarutainterna.`id` AS id,
hojarutainterna.`fecha` AS fecha,
chofer.`nombre` AS chofer,
hojarutainterna.`porcentaje_fletero` AS porcentaje,
hojarutainterna.`importe_fletero` AS hri_importe_fletero
FROM
    `hojarutainterna`        
    INNER JOIN `chofer` 
        ON (`chofer`.`id` = `hojarutainterna`.`idchofer`) WHERE hojarutainterna.`id`=" . $id;
        $datos = consulta_mysql($sql);
        return mysqli_fetch_assoc($datos);
    }
}
