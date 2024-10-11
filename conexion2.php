<?
function consulta_mysql($sql){
$conexion= mysql_connect('localhost','root','haciendaroot');
	mysql_select_db('se2015',$conexion);
	$result = mysql_query($sql,$conexion);
     if (mysql_error())
		{echo mysql_error();
		echo "ERROR <br/> SQL: $sql<br/>";
		} 
	return $result;
}//fin de la funcion
?>