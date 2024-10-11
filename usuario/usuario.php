<?php
require_once '../conexion.php';
class usuario
{
	public function lista()
	{
     $sql="SELECT * FROM usuario";
     $listado = consulta_mysql($sql);
     return $listado;
    }

   public function nuevo($usuario,$password,$nombre,$email,$sucursal,$permiso)
   {
  	  $password=md5($password);
      $sql="INSERT INTO `usuario`
            (`usuario`,
             `password`,
             `nombre`,
             `email`, `sucursal`,permiso)
       VALUES ('$usuario',
        '$password',
        '$nombre',
        '$email','$sucursal','$permiso')";
       $registro = consulta_mysql($sql);
       return $registro;
	 }

	public function editar($id,$usuario,$nombre,$email,$sucursal,$password,$permiso)
	{
	 $sql="UPDATE `usuario`
           SET  `usuario` = '$usuario',
                `nombre` = '$nombre',
                `email` = '$email',
                `sucursal` = '$sucursal',
                `password` = '$password',
                `permiso` = '$permiso'
                 WHERE `id` = '$id'";
   $usuarios = consulta_mysql($sql);
	 return $usuarios;
	}



  public function obtenerId($id)

	{

	 $sql="SELECT * FROM usuario where id='$id'";

     $alumnos = consulta_mysql($sql);

     return $alumnos;

	}

  public function obtenerPass($id)
  {
    $sql="SELECT password FROM usuario where id='$id'";
    $usuarios = consulta_mysql($sql);
    $item = mysqli_fetch_array($usuarios);
    return $item['password'];
  }



   public function eliminar($id)
  	{
      $sql="DELETE FROM usuario WHERE id ='$id'";
      $usuarios = consulta_mysql($sql);
     
      return $item;

	}







}



?>



