<?php
require_once '../conexion.php';
class hojaruta
{
	public function lista()
	{
    $sql="SELECT
    chofer.`nombre` AS nombrechofer,
    camion.`patente` AS patentecamion,
    acoplado.`patente` AS patenteacoplado,
    provincia.`nombre` AS provincia,
    hojaruta.`fecha` AS fecha,
    hojaruta.`estado` AS estado,
    hojaruta.`id` AS numero,
    hojaruta.`observacion` AS observacion
    FROM `hojaruta`
        INNER JOIN `chofer`
            ON (`hojaruta`.`idchofer` = `chofer`.`id`)
        INNER JOIN `camion`
            ON (`hojaruta`.`idcamion` = `camion`.`id`)
        INNER JOIN `acoplado`
            ON (`hojaruta`.`idacoplado` = `acoplado`.`id`)
        INNER JOIN `provincia`
            ON (`hojaruta`.`iddestino` = `provincia`.`id`)
             where estado <> 'Terminada'
              order by numero desc ";

     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function listaterminados()
    {
    $sql="SELECT
    chofer.`nombre` AS nombrechofer,
    camion.`patente` AS patentecamion,
    acoplado.`patente` AS patenteacoplado,
    provincia.`nombre` AS provincia,
    hojaruta.`fecha` AS fecha,
    hojaruta.`estado` AS estado,
    hojaruta.`id` AS numero,
    hojaruta.`observacion` AS observacion
    FROM `hojaruta`
        INNER JOIN `chofer`
            ON (`hojaruta`.`idchofer` = `chofer`.`id`)
        INNER JOIN `camion`
            ON (`hojaruta`.`idcamion` = `camion`.`id`)
        INNER JOIN `acoplado`
            ON (`hojaruta`.`idacoplado` = `acoplado`.`id`)
        INNER JOIN `provincia`
            ON (`hojaruta`.`iddestino` = `provincia`.`id`) where estado like 'Terminada' order by numero desc limit 500 ";

     $listado = consulta_mysql($sql);
     return $listado;
    }


   public function nuevo($fecha,$idchofer,$idcamion,$idacoplado,$iddestino,$observacion,$estado,$origen)

   {

	   $sql="INSERT INTO `hojaruta`

            (`fecha`,

             `idchofer`,

             `idcamion`,

             `idacoplado`,

             `iddestino`,

             `observacion`,`estado`,`origen`)

							VALUES ('$fecha',

							        '$idchofer',

							        '$idcamion',

							        '$idacoplado',

							        '$iddestino',

							        '$observacion','$estado','$origen')";
							        
							        

       $registro = consulta_mysql($sql);
       $link = mysqli_connect("localhost","surexpre_nuevo","rawson2018$","surexpre_2018");
       $id=mysqli_insert_id($link); //ultimo id insertado
       return $id;
	 }



   /*cabecera hr*/

    public function cabecerahr($idhr)
    {
       $sql="SELECT
            chofer.`nombre` AS nombrechofer,
             chofer.`carnet` AS carnetchofer,
            camion.`patente` AS patentecamion,
            acoplado.`patente` AS patenteacoplado,
            provincia.`nombre` AS provincia,
            hojaruta.`fecha` AS fecha,
            hojaruta.`id` AS numero,
            hojaruta.`estado` AS estado,
             hojaruta.`observacion` AS observacion,
             hojaruta.`origen` AS origen
            FROM
                `hojaruta`
                INNER JOIN `chofer`
                    ON (`hojaruta`.`idchofer` = `chofer`.`id`)
                INNER JOIN `camion`
                    ON (`hojaruta`.`idcamion` = `camion`.`id`)
                INNER JOIN `acoplado`
                    ON (`hojaruta`.`idacoplado` = `acoplado`.`id`)
                INNER JOIN `provincia`
                    ON (`hojaruta`.`iddestino` = `provincia`.`id`)
                     where hojaruta.`id`=$idhr";
                   
     $listado = consulta_mysql($sql);
     return $listado;
    }



    public function listaremito($idhr)
    {
      $sql="SELECT
        remito.`id` as remitoid,
        remito.`fecha` AS fecha,
        remito.`numero` AS numeroremito,
        remito.`nomcliente` AS nombrecliente,
        remito.`nomproveedor` AS nombreproveedor,
        remito.`valordeclarado` AS valordeclarado,
        remito.`bultos` AS bultos,
        remito.`estado` AS estado,
        remito.`descripcion` AS descripcion
        FROM
            `detallehr`
            INNER JOIN `hojaruta`
                ON (`detallehr`.`idhojaruta` = `hojaruta`.`id`)
            INNER JOIN `remito`
                ON (`detallehr`.`idremito` = `remito`.`id`) where detallehr.`idhojaruta`=$idhr";
     $listado = consulta_mysql($sql);
     return $listado;
    }

    public function valordeclarado($idhr)
    {
      $total=0;
      $sql="SELECT         
        sum( remito.`valordeclarado`) as total_valordeclarado
            FROM
            `hojaruta`
            INNER JOIN `detallehr` 
                ON (`hojaruta`.`id` = `detallehr`.`idhojaruta`)
            INNER JOIN `remito` 
                ON (`detallehr`.`idremito` = `remito`.`id`)
                         where detallehr.`idhojaruta`=$idhr";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
          {
            $total=$item['total_valordeclarado'];
          }
     return $total;

    }



	public function cambiarEstado($id,$estado)
	{
     $sql="UPDATE`hojaruta`
          SET  `estado` = '$estado'
    		WHERE `id` = '$id'";
     $listado = consulta_mysql($sql);
 	 return $listado;
	}

    public function obtenerId($id)
	{
	 $sql="SELECT * FROM hojaruta where id='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
	}

    public function eliminar($id)
	{
     $sql="DELETE FROM hojaruta WHERE id ='$id'";
     $usuarios = consulta_mysql($sql);
     return $usuarios;
	}

    /** 05012018 listado por zona de clientes **/
   public function zona_cliente($idhr)
   {

      $sql="SELECT
            hojaruta.`id` AS hojaruta_id,
            remito.`id` AS remito_id,
            remito.`idcliente` AS cliente_id,
            remito.`numero` AS remito_numero,
            remito.`bultos` AS bultos,
            cliente.`nombrefantasia` AS nombre,
            cliente.`domicilio` AS domicilio,
            cliente.`zona` AS zona
            FROM
                `detallehr`
                INNER JOIN `hojaruta` 
                    ON (`detallehr`.`idhojaruta` = `hojaruta`.`id`)
                INNER JOIN `remito` 
                    ON (`detallehr`.`idremito` = `remito`.`id`)
                INNER JOIN `cliente` 
                    ON (`remito`.`idcliente` = `cliente`.`id`)
                    WHERE `hojaruta`.`id`=$idhr
                    ORDER BY cliente.`zona` ASC;";

     $listado = consulta_mysql($sql);
     return $listado;
    } 


}

?>

