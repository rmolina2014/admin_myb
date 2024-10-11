<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin2015 </title>
    <!-- Bootstrap Styles-->
    <!--link href="css/bootstrapFlaty.css" rel="stylesheet" /-->
    <link href="css/bootstrapYeti.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="css/font-awesome.css" rel="stylesheet" />
   
    <script src="js/jquery-1.10.2.js"></script>
     <script src="js/bootstrap.min.js"></script>
      <script src="js/bootstrap.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default navbar-inverse" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Navegación Toggle</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="#">Admin2015</a>
				</div>
				
				
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				
                <div class="panel-heading">
                       Ingreso al Sistema de Administración
                </div>
                <div class="panel-body">
                <div class="row">
                <div class="col-lg-4">
                <?
                if(isset($_GET['mensaje']) )
                {
                   echo "<script language=Javascript> alert(".$_GET['mensaje']."); </script>";
                }
                ?>

                <form action="validar.php" method="POST">
                   <div class="form-group">
                        <input type="text" name="usuario" class="form-control" placeholder="Nombre de Usuario" autofocus required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required />
                    </div>          
                
               <div class="form-group">                                                            
                    <button type="submit" >Iniciar</button>  
                     
                </div>
                    

                </form>

			</div>
		</div>
	</div>
</div>
  <!-- jQuery Js -->
    <script src="js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="js/bootstrap.min.js"></script>
	 </body>
	 </html>