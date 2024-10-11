<?php
session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
   $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
   $permiso=$_SESSION['sesion_permisos'];
 }
  else { header ("Location: index.php"); }
 //-----------------
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin-2015 </title>
    <!-- Bootstrap Styles-->
    <!--link href="css/bootstrapFlaty.css" rel="stylesheet" /-->
    <link href="css/bootstrapYeti.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <script src="js/jquery-1.10.2.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <style media="screen">
       google-map{height:600px;}
     </style>
</head>
<body>
<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">

		<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Navegación Toggle</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="#">Admin2015</a>
		</div>
		 <?
        if ($sucursal=='Rosario')
        {
        ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
           <li>
             <a href="remito/listado.php">Remito</a>
           </li>

            <li>
             <a href="hojaruta/listado.php">Hoja de Ruta</a>
           </li>

           <li>
             <a href="cliente/listado.php">Clientes</a>
           </li>
          

           <li>
             <a href="chofer/listado.php">Chofer</a>
           </li>
           <li>
             <a href="camion/listado.php">Camion</a>
           </li>
           <li>
             <a href="acoplado/listado.php">Acoplado</a>
           </li>
           <li>
             <a href="salir.php">Salir</a>
           </li>
           </ul>

             <ul class="nav navbar-nav navbar-right">
             <li>
               <a href="#">Usuario : <? echo $nombre;?></a>
             </li>
             <li>
                <a href="#">Sucursal : <? echo $sucursal;?></a>
             </li>
           </ul>
       </div>
     </nav>
   </div>
      <?
        }
        else
         {
           ?>
           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav">
              <li>
                <a href="remito/listado.php">Remito</a>
              </li>

              <li>
                <a href="consultas/listado.php">Consultas</a>
              </li>

              <? if ($permiso < 3 )
              {
                ?>
              <li>
                <a href="hojaruta/listado.php">Hoja de Ruta</a>
              </li>
              <li>
                <a href="hojarutainterna/listado.php">Hoja de Ruta Interna</a>
              </li>
               <li>
                  <a href="liquidacionfletero/listado.php">Liquidación Fletero</a>
                </li>
              <li>
                <a href="rastreo/listado.php">Rastreo</a>
              </li>
              <li >
                <a href="usuario/listado.php">Usuarios</a>
              </li>
              <li>
                <a href="cliente/listado.php">Clientes</a>
              </li>
              <li>
                <a href="rendicion/listado.php">Rendiciones</a>
              </li>
              <li>
                <a href="tipogasto/listado.php">Tipo Gasto</a>
              </li>
              <li>
                <a href="chofer/listado.php">Chofer</a>
              </li>
              <li>
               <a href="camion/listado.php">Camion</a>
              </li>
              <li>
               <a href="acoplado/listado.php">Acoplado</a>
              </li>
               <li>
                <a href="provincia/listado.php">Provincias</a>
              </li>
              <li>
               <a href="taller/listado.php">Taller</a>
              </li>
               <li>
                <a href="tipotrabajo/listado.php">Tipo Trabajo</a>
              </li>
            <li>
              <a href="presupuesto/listado.php">Presupuesto</a>
            </li>

            <li>
              <a href="remitos_proveedor/listado.php">Compras</a>
            </li>

            <li>
              <a href="lista_distribucion/index.php">Lista Distribución</a>
            </li>


               <!--li>
                <a href="almacen/listado.php">Almacen</a>
              </li>
               <li>
                <a href="mercaderia/listado.php">Stock</a>
              </li>
              <li>
                <a href="remito/vereestadoremito.php">Ver Estado</a>
              </li-->
              <? }?>
              <li>
                <a href="salir.php">Salir</a>
              </li>
              </ul>

                <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="#">Usuario : <? echo $nombre;?></a>
                </li>
                <li>
                   <a href="#">Sucursal : <? echo $sucursal;?></a>
                </li>
              </ul>
          </div>
        </nav>
      </div>
     <?
        }
        ?>
	</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				Bienvenido al Sistema de Administración.
			</div>
      
		</div>
	</div>

</div>


</body>
</html>
