<?php
require_once '../conexion.php';
class rendicion
{
	public function lista()
	{
    $sql="SELECT
            viaje.`id` AS id,
            viaje.`fecha` AS fecha,
            viaje.`flete` AS flete,
            viaje.`kmsalida` AS kmsalida,
            viaje.`kmllegada` AS kmllegada,
            viaje.`comision` AS comision,
            viaje.`totalGO` AS totalGO,
            viaje.`totalKM` AS totalKM,
            viaje.`estado` AS estado,
            viaje.`patente` AS patente,
            chofer.`nombre` AS nombrechofer
            FROM
                `viaje`
                INNER JOIN `chofer` 
                    ON (`viaje`.`chofer_id` = `chofer`.`id`) order by id desc;";
    
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function listaExcel($fechaDesde,$fechaHasta)
    {
    $sql="SELECT
            viaje.`id` AS id,
            viaje.`fecha` AS fecha,
            viaje.`flete` AS flete,
            viaje.`kmsalida` AS kmsalida,
            viaje.`kmllegada` AS kmllegada,
            viaje.`comision` AS comision,
            viaje.`totalGO` AS totalGO,
            viaje.`totalKM` AS totalKM,
            viaje.`estado` AS estado,
            viaje.`patente` AS patente,
            chofer.`nombre` AS nombrechofer
            FROM
                `viaje`
                INNER JOIN `chofer` 
                    ON (`viaje`.`chofer_id` = `chofer`.`id`)
                    where viaje.`fecha`>='$fechaDesde' and viaje.`fecha` <= '$fechaHasta' and  viaje.`estado`='Rendicion' ";
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function listarCliente($viaje_id)
    {
        $sql="SELECT
                        viajecliente.`cliente_id` AS cliente_id,
                        viajecliente.`id` AS viajecliente_id,
                        viajecliente.`remitos` AS remitos,
                        viajecliente.`viaje_id` AS viaje_id,
                        viajecliente.`fecha` AS fecha,
                        cliente.`nombrereal` AS nombrereal,
                        provincia.`nombre` AS provincia
                    FROM
                        `viajecliente`
                        INNER JOIN `viaje` 
                            ON (`viajecliente`.`viaje_id` = `viaje`.`id`)
                        INNER JOIN `cliente` 
                            ON (`viajecliente`.`cliente_id` = `cliente`.`id`)
                        INNER JOIN `provincia` 
                            ON (`viajecliente`.`provincia_id` = `provincia`.`id`)
                            where viajecliente.`viaje_id`=".$viaje_id;

     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function nuevo($fecha,$chofer_id,$flete,$comision,$kmsalida,$kmllegada,$estado,$porcentaje,$totalKM,$totalGO,$patente)
    {
       $sql="INSERT INTO `viaje`
            (`fecha`,
             `chofer_id`,
             `flete`,
             `comision`,
             `kmsalida`,
             `kmllegada`,
             `estado`,`porcentaje`,`totalKM`,`totalGO`,`patente`)
        VALUES ( '$fecha',
                '$chofer_id',
                '$flete',
                '$comision',
                '$kmsalida',
                '$kmllegada',
                '$estado',
                '$porcentaje',
                '$totalKM',
                '$totalGO',
                '$patente');";
        $registro = consulta_mysql($sql);
       $link = mysqli_connect("localhost","surexpre_nuevo","rawson2018$","surexpre_2018");
       $id=mysqli_insert_id($link); //ultimo id insertado
       return $id;

       
    }

   
    public function insertarCliente($viaje_id,$cliente_id,$remitos,$provincia_id,$fecha)
    {
      $sql="INSERT INTO `viajecliente`
            (`viaje_id`,
             `cliente_id`,
             `remitos`,`provincia_id`,`fecha`)
            VALUES ('$viaje_id',
        '$cliente_id',
        '$remitos','$provincia_id','$fecha');";
        $registro = consulta_mysql($sql);
       return $viaje_id;
    }

     public function eliminarCliente($viajecliente_id,$viaje_id)
    {
     $sql="DELETE
            FROM `viajecliente`
            WHERE `viaje_id` ='$viaje_id' and `id`= '$viajecliente_id'";
            
     $resultado = consulta_mysql($sql);
     return $resultado;
    }
   /****************** A CUENTA********************/
    public function listarACuenta($viaje_id)
    {
     $sql="SELECT *
            FROM `acuenta`
                 where `viaje_id`=".$viaje_id;
     $listado = consulta_mysql($sql);
     return $listado;
    }

     public function insertarACuenta($descripcion,$numero,$banco,$importe,$viaje_id)
    {
      $sql="INSERT INTO `acuenta`
            (`descripcion`,
             `numero`,
             `banco`,
             `importe`,
             `viaje_id`)
VALUES ('$descripcion',
        '$numero',
        '$banco',
        '$importe',
        '$viaje_id'); ";
      $registro = consulta_mysql($sql);
      return $viaje_id;
    }

    public function eliminarACuenta($id)
    {
     $sql="DELETE
            FROM `acuenta`
            WHERE `id` = '$id';";
     $resultado = consulta_mysql($sql);
     return $resultado;
    }



    /****************** GASTOS VARIOS********************/
 public function listarGastosVarios($viaje_id)
    {
     $sql="SELECT
            tipogasto.`descripcion` AS descripcion,
            gastosvarios.`id` AS idgastosvarios,
            gastosvarios.`fecha` AS fecha,
            gastosvarios.`importe` AS importe,
            gastosvarios.`numerocomprobante` AS comprobante,
            gastosvarios.`viaje_id` AS viaje_id
            FROM
                `gastosvarios`
                INNER JOIN `tipogasto` 
                    ON (`gastosvarios`.`tipogasto_id` = `tipogasto`.`id`)
                             where gastosvarios.`viaje_id`=".$viaje_id;
                             
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function insertarGastosVarios($fecha,$tipogasto_id,$numerocomprobante,$importe,$viaje_id)
    {
      $sql="INSERT INTO `gastosvarios`
            (`fecha`,
             `tipogasto_id`,
             `numerocomprobante`,
             `importe`,
             `viaje_id`)
                VALUES ('$fecha',
                        '$tipogasto_id',
                        '$numerocomprobante',
                        '$importe',
                        '$viaje_id'); ";
                      $registro = consulta_mysql($sql);
     return $viaje_id;
    }
    
    public function eliminarGV($id)
    {
     $sql="DELETE
            FROM `gastosvarios`
            WHERE `id` = '$id';";
     $resultado = consulta_mysql($sql);
     return $resultado;
    }

    /*****************************/

 /****************** GASTOS COMBUSTIBLE********************/
 public function listarGastosComb($viaje_id)
    {
     $sql="select * from gastocombustible where viaje_id=".$viaje_id;
     $listado = consulta_mysql($sql);
     return $listado;
    }

 public function insertarGastosComb($fecha,$nombre,$numerocomprobante,$litros,
        $importe,$cuentacorriente,$viaje_id)
    {
      $sql="INSERT INTO `gastocombustible`
            ( `fecha`,
             `nombre`,
             `numerocomprobante`,
             `litros`,
             `importe`,
             `cuentacorriente`,
             `viaje_id`)
VALUES ('$fecha',
        '$nombre',
        '$numerocomprobante',
        '$litros',
        '$importe',
        '$cuentacorriente',
        '$viaje_id');";
     $registro = consulta_mysql($sql);
     return $viaje_id;
    }

public function eliminarGComb($id)
    {
     $sql="DELETE
            FROM `gastocombustible`
            WHERE `id` = '$id';";
     $resultado = consulta_mysql($sql);
     return $resultado;
    }



    public function cabeceraRendicion($id)
    {
     $sql="SELECT
            viaje.`id` AS id,
            viaje.`fecha` AS fecha,
            viaje.`flete` AS flete,
            viaje.`kmsalida` AS kmsalida,
            viaje.`kmllegada` AS kmllegada,
            viaje.`comision` AS comision,
            viaje.`estado` AS estado,
            viaje.`porcentaje` AS porcentaje,
            viaje.`patente` AS patente,
            chofer.`nombre` AS nombrechofer
            FROM
                `viaje`
                INNER JOIN `chofer` 
                    ON (`viaje`.`chofer_id` = `chofer`.`id`)
                    where viaje.`id`=".$id;
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function eliminar($id)
    {
     
     $sql="DELETE
            FROM `viaje`
            WHERE `id` = '$id';";
     $resultado = consulta_mysql($sql);

     $sql="DELETE
        FROM `viajecliente`
        WHERE `viaje_id` = '$id'";
        $resultado = consulta_mysql($sql);

        $sql="DELETE
        FROM `gastocombustible`
        WHERE `id` = '$id'";
        $resultado = consulta_mysql($sql);
        
         $sql="DELETE
        FROM `gastocombustible`
        WHERE `id` = '$id'";
        $resultado = consulta_mysql($sql);

        $sql="DELETE
        FROM `gastosvarios`
        WHERE `id` = '$id'";
        $resultado = consulta_mysql($sql);

     return $resultado;
    }

     /****** 09062017por numero de rendicion ***********/
    /*********consultas de rendicion************/

    public function datosCombustible($viaje_id)
    {
      $sql="SELECT
        viaje.`id` AS rendicion, gastocombustible.`cuentacorriente` AS pago, gastocombustible.`importe` AS importe
        FROM
            `viaje`
            INNER JOIN `gastocombustible` 
                ON (`viaje`.`id` = `gastocombustible`.`viaje_id`) WHERE viaje.`estado`='Rendicion' and `viaje`.`id` =$viaje_id";
             
                   
     $listado = consulta_mysql($sql);
     return $listado;
    }

    /*********consultas de rendicion************/

    public function datosGastosVarios($viaje_id)
    {
     $sql="SELECT
        viaje.id AS viaje, tipogasto.`descripcion` AS gasto , gastosvarios.`importe`
        FROM
            `viaje`
            INNER JOIN `gastosvarios` 
                ON (`viaje`.`id` = `gastosvarios`.`viaje_id`)
            INNER JOIN `tipogasto` 
                ON (`gastosvarios`.`tipogasto_id` = `tipogasto`.`id`) WHERE viaje.`id`=$viaje_id";
           
     $listado = consulta_mysql($sql);
     return $listado;
    }

    /*********consultas de rendicion************/
    public function listarTipoGastos()
    {
     $sql="SELECT * FROM `tipogasto` ";
     $listado = consulta_mysql($sql);
     return $listado;
    }

     /****** 09062017 por chofer ***********/
    /*********consultas de rendicion************/
    
    public function buscarRendicionesChofer($chofer_id)
    {
     $sql="SELECT `id` FROM `viaje` WHERE `chofer_id`=$chofer_id and `estado`='Rendicion'";
           
     $listado = consulta_mysql($sql);
     return $listado;
    }
   
  
}
?>

