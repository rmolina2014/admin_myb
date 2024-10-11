<?php
require_once '../conexion.php';
class consulta
{
	public function remitosPorFecha($fechaDesde,$fechaHasta)
    {
    $sql="SELECT
          `id`,
          `nomcliente`,
          `dircliente`,
          `cuitcliente`,
          `nomproveedor`,
          `dirproveedor`,
          `cuitproveedor`,
          `valordeclarado`,
          `tipocomprobante`,
          `contrareembolso`,
          `idcliente`,
          `idproveedor`,
          `numero`,
          `fecha`,
          `bultos`,
          `descripcion`,
          `estado`,
          `fechaestado`,
          `fechaingreso`,
          `marca`,
          `fechaMarca`,
          `origen`
        FROM `remito` WHERE fechaingreso BETWEEN '$fechaDesde' AND '$fechaHasta' ";
     $listado = consulta_mysql($sql);
     return $listado;
    }
  
}
?>

