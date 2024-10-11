<?php
require_once '../conexion.php';
class remito
{
    // 02112015 se agrego la marca de borrado para los remitos
    // 03082017 se agrego el orden de la lista
     // 01-12-2017 modificado se agrego historico
	public function lista()
	{
     //$sql="SELECT * FROM `remito` where estado <> 'Entregado' and marca <> 'Borrado' order by id DESC";
     $sql="SELECT * FROM `remito` where estado <> 'Entregado' and marca <> 'Borrado' and historico='NO' order by id DESC";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   
    // 01-12-2017 modificado se agrego historico
    public function listaRemEnt()
    {
        // antes  $sql="SELECT * FROM `remito` where estado like 'Entregado' order by id DESC";
     $sql="SELECT * FROM `remito` where estado='Entregado' and historico='NO' order by id DESC";
     $listado = consulta_mysql($sql);
     return $listado;
    }
   
   public function nuevo($valordeclarado,$tipocomprobante,$contrareembolso,$idcliente,$idproveedor,$numero,$fecha,
             $bultos,$descripcion,$estado,$fechaestado,$fechaingreso,$marca,$fechaMarca,$origen)
   {
     $cliente="SELECT nombrereal, domicilio, cuit FROM cliente where id=".$idcliente;
     $listado = consulta_mysql($cliente);

     while( $item = mysqli_fetch_array($listado))

     {

      $nomcliente=$item['nombrereal'];

     $dircliente=$item['domicilio'];

     $cuitcliente=$item['cuit'];

     }



     $pro="SELECT nombrereal, domicilio, cuit FROM cliente where id=".$idproveedor;

     $listado = consulta_mysql($pro);

    while( $item = mysqli_fetch_array($listado))
   {
     $nomproveedor=$item['nombrereal'];
     $dirproveedor=$item['domicilio'];
     $cuitproveedor=$item['cuit'];
    }

      $sql="INSERT INTO `remito`
            (`nomcliente`,
             `dircliente`,
             `cuitcliente`,
             `nomproveedor`,
             `dirproveedor`,
             `cuitproveedor`,
             `valordeclarado`,`tipocomprobante`,`contrareembolso`,`idcliente`,`idproveedor`,`numero`,`fecha`,
             `bultos`,`descripcion`,`estado`,`fechaestado`,`fechaingreso`,`marca`,`fechaMarca`,`origen`)
VALUES ('$nomcliente',
       '$dircliente',
        '$cuitcliente',
        '$nomproveedor',
        '$dirproveedor',
        '$cuitproveedor',
        '$valordeclarado',
        '$tipocomprobante',
        '$contrareembolso',
        '$idcliente','$idproveedor','$numero','$fecha',
             '$bultos','$descripcion','$estado','$fechaestado','$fechaingreso','$marca','$fechaMarca','$origen')";
             
             
            
           
       $registro = consulta_mysql($sql);
       return $registro;

     }




	public function editar($id,$usuario,$password,$nombre,$email)

	{

    $sql="UPDATE `remito`

          SET

            `nomcliente` = '$nomcliente',

            `dircliente` = '$dircliente',

            `cuitcliente` = '$cuitcliente',

            `nomproveedor` = '$nomproveedor',

            `dirproveedor` = '$dirproveedor',

            `cuitproveedor` = '$cuitproveedor',

            `valordeclarado` = '$valordeclarado',

            `tipocomprobante` = '$tipocomprobante',

            `contrareembolso` = '$contrareembolso',

            `idcliente` = '$idcliente',

            `idproveedor` = '$idproveedor',

            `numero` = '$numero',

            `fecha` = '$fecha',

            `bultos` = '$bultos',

            `descripcion` = '$descripcion',

            `estado` = '$estado'

            `fechaestado` = '$fechaestado'

          WHERE `id` = '$id'; ";

    $registro = consulta_mysql($sql);

    return $registro;

	}



  public function obtenerId($id)

	{

	 $sql="SELECT * FROM remito where id='$id'";

     $alumnos = consulta_mysql($sql);

     return $alumnos;

	}



    public function verestado($id)
    {
     $sql="SELECT * FROM remito where idproveedor='$id'";
     $alumnos = consulta_mysql($sql);
     return $alumnos;
    }

   public function eliminar($id)
	{
     $fechaActual=date('Y-m-d H:i:s');   
     $sql=" UPDATE `remito` 
            SET  `marca` = 'Borrado',
                 `fechaMarca` = '$fechaActual'
            WHERE id ='$id'";
     $resultado = consulta_mysql($sql);
     return $resultado;
	}



    /*listado de remitos con estado igual a deposito destino para la HR*/

    public function listaremitohr()

    {

     $sql="SELECT * FROM `remito` where estado like '%Origen%'";

     $listado = consulta_mysql($sql);

     return $listado;

    }



	/*listado de remitos con estado igual a deposito destino o a pendiente para la HR interna*/

    public function listaremitohri()
    {

     $sql="SELECT * FROM `remito` where estado like '%Deposito Destino%' or estado like '%Pendiente%' ";

     $listado = consulta_mysql($sql);

     return $listado;

    }

     //devuelve si esta repetido un numero de remito
   public function validarNumeroRemito($numero)
   {
     $sql="SELECT count(numero) as cantidad FROM remito WHERE numero ='$numero'";
     $resultado = consulta_mysql($sql);
     $item = mysqli_fetch_array($resultado);
     $repetido=$item['cantidad'];
     return $repetido;
   }
   
   //devuelve si esta repetido un numero de remito
   public function consulta_datos_remito_hr($numero)
   {
    $sql="SELECT
            remito.`numero` AS numero,
            chofer.`nombre` AS chofer,
            hojaruta.`id` AS hojaruta,
            hojaruta.`estado` AS hr_estado,
            camion.`patente` AS camion
            FROM
                `detallehr`
                INNER JOIN `remito` 
                    ON (`detallehr`.`idremito` = `remito`.`id`)
                INNER JOIN `hojaruta` 
                    ON (`detallehr`.`idhojaruta` = `hojaruta`.`id`)
                INNER JOIN `chofer` 
                    ON (`hojaruta`.`idchofer` = `chofer`.`id`)
                INNER JOIN `camion` 
                    ON (`camion`.`id` = `hojaruta`.`idcamion`)
                            WHERE `remito`.`id`='$numero'";
     $resultado = consulta_mysql($sql);
     return $resultado;
   }


   //devuelve si esta repetido un numero de remito
   public function consulta_datos_remito_hri($numero)
   {
    $sql="SELECT
             remito.`numero` AS numero,
             chofer.`nombre` AS chofer,
             camion.`patente` AS camion,
             hojarutainterna.`id` AS numero_hri,
             hojarutainterna.`estado` AS estado
            FROM
                `hojarutainterna`
                INNER JOIN `camion` 
                    ON (`hojarutainterna`.`idcamion` = `camion`.`id`)
                INNER JOIN `chofer` 
                    ON (`hojarutainterna`.`idchofer` = `chofer`.`id`)
                INNER JOIN `detalleinterna` 
                    ON (`detalleinterna`.`idinterna` = `hojarutainterna`.`id`)
                INNER JOIN `remito` 
                    ON (`detalleinterna`.`idremito` = `remito`.`id`)
                                        WHERE `remito`.`id`='$numero'";
                 $resultado = consulta_mysql($sql);
                 return $resultado;
   }


}
?>

