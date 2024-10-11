<?php
require_once '../conexion.php';
class cliente
{
	public function lista()
	{
     $sql="SELECT * FROM cliente";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($nombrefantasia,$nombrereal,$responsable,$situacioniva,$cuit,$numerobrutos,$email,$observaciones,$domicilio,$localidad,$zona,$origen)
   {
             $nombrefantasia = strtoupper($nombrefantasia );
             $nombrereal = strtoupper($nombrereal );
             $responsable = strtoupper($responsable );

	    $sql="INSERT INTO `cliente`
            (`nombrefantasia`,
             `nombrereal`,
             `responsable`,
             `situacioniva`,
             `cuit`,
             `numerobrutos`,
             `email`,
             `observaciones`,
             `domicilio`,
             `localidad`,
             `zona`,`origen`)
           VALUES ('$nombrefantasia',
        '$nombrereal',
        '$responsable',
        '$situacioniva',
        '$cuit',
        '$numerobrutos',
        '$email',
        '$observaciones',
        '$domicilio',
        '$localidad',
        '$zona','$origen')";

       $registro = consulta_mysql($sql);

       return $registro;

	 }



	public function editar($id,$nombrefantasia,$nombrereal,$responsable,$situacioniva,$cuit,

				$numerobrutos,$email,$observaciones,$domicilio,$localidad,$zona)

	{

  	 $sql="UPDATE `cliente`

  SET `nombrefantasia` = '$nombrefantasia',

  `nombrereal` = '$nombrereal',

  `responsable` = '$responsable',

  `situacioniva` = '$situacioniva',

  `cuit` = '$cuit',

  `numerobrutos` = '$numerobrutos',

  `email` = '$email',

  `observaciones` = '$observaciones',

  `domicilio` = '$domicilio',

  `localidad` = '$localidad',

  `zona` = '$zona'

WHERE `id` = '$id'";

   $usuarios = consulta_mysql($sql);

	 return $usuarios;

	}



  public function obtenerId($id)
	{
	  $sql="SELECT * FROM cliente where id='$id'";
    $alumnos = consulta_mysql($sql);
    return $alumnos;
	}



    public function eliminar($id)

	{

     $sql="DELETE FROM cliente WHERE id ='$id'";

     $usuarios = consulta_mysql($sql);

     return $usuarios;

	}



   //devuelve si esta repetido un cuit

   public function validarcuit($cuit)

   {

     $sql="SELECT count(cuit) as cantidad FROM cliente WHERE cuit ='$cuit'";

     $resultado = consulta_mysql($sql);

     $item = mysql_fetch_array($resultado);

     $repetido=$item['cantidad'];

     return $repetido;

   }



}

?>