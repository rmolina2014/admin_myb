<?php
session_name("sesion_prest");
session_start();

if (isset($_SESSION['sesion_usuario'])) {
  $ID = $_SESSION['sesion_id'];
  $nombre = $_SESSION['sesion_usuario'];
  $sucursal = $_SESSION['sesion_sucursal'];
  $permiso = $_SESSION['sesion_permisos'];
} else {
  header("Location: ../index.php");
}

require_once 'liquidacionfletero.php';

include '../cabecera.php';
?>
<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">

      <h3>Liquidación Fletero</h3>
      <hr>

      <p>
        <a class="btn btn-primary" href="agregarHRI.php">Agregar Porcentaje a Varias HRI</a>
        <button id="generarResumenMultiple" class="btn btn-success">Generar Resumen de Seleccionados</button>

      </p>
      <!--span class="label label-default"><a href="#" id="lista"><strong>Listado</strong></a></span-->
      <!--span class="label label-default"><a href="#" id="termi"> <strong>Terminada</strong> </a></span-->

      <div id="div_dinamico">

        <!--p> <a href="cabhrint.php" class="btn btn-primary">Agregar Hoja de Ruta Interna</a> </p-->

        <table id="listado" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><input type="checkbox" id="selectAll" /> Seleccionar todos</th>
              <th>Fecha</th>
              <th>Chofer</th>
              <th>Patente</th>
              <th>N° HRI</th>
              <th>Porcentaje</th>
              <th>Importe</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $objecto = new liquidacionfletero();
            $listado = $objecto->lista();
            while ($item = mysqli_fetch_array($listado)) {
            ?>
              <tr>
                <td><input type="checkbox" class="liquidacionCheck" value="<?php echo $item['numero']; ?>" /></td>
                <td><?php echo $item['fecha']; ?></td>
                <td><?php echo $item['nombrechofer']; ?></td>
                <td><?php echo $item['patentecamion']; ?></td>
                <td><?php echo $item['numero']; ?></td>
                <td><?php echo $item['porcentaje_fletero']; ?></td>
                <td><?php echo $item['importe_fletero']; ?></td>
                <td><?php echo $item['estado']; ?></td>
                <td>
                  <?php
                  if ($item['porcentaje_fletero'] != '' && $item['importe_fletero'] > 0) {
                  ?>
                    <a href="imprimir_liquidacion.php?idhrint=<?php echo $item['numero']; ?>" class="btn btn-primary btn-sm">Imprimir</a>
                    
                  <?php
                  } else {
                  ?>
                    <a href="liquidacion.php?id=<?php echo $item['numero']; ?>" class="btn btn-primary btn-sm">Liquidación</a>
                  <?php
                  }
                  if ($item['porcentaje_fletero'] >0 and $item['importe_fletero'] > 0  )
                  {
                    ?>
                    <a href="liquidacion.php?id=<?php echo $item['numero'];?>" class="btn btn-primary btn-sm" > Editar</a>
                    <?php
                 }  
                  ?>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>


      </div>
    </div>
  </div>
</div>

<!-- /. ROW  -->

<footer>
  <p> Admin -2015 </p>
</footer>

</div><!-- /. PAGE INNER  -->

</div><!-- /. PAGE WRAPPER  -->

<script src="../js/jquery-1.10.2.js"></script>

<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {

    //listado de HR Terminadas
    $("a[id^='termi']").click(function(evento) {
      evento.preventDefault();
      $.ajax({
        type: "POST",
        cache: false,
        async: false,
        url: 'hrterminadas.php',
        success: function(data) {
          if (data) {
            $('#div_dinamico').html(data);
          }
        }
      }) //fin ajax
    }); //fin

    $("a[id^='lista']").click(function(evento) {
      evento.preventDefault();
      $.ajax({
        type: "POST",
        cache: false,
        async: false,
        url: 'hrlista.php',
        success: function(data) {
          if (data) {
            $('#div_dinamico').html(data);
          }
        }
      }) //fin ajax
    }); //fin


    ///nuevo 13102024
    // Seleccionar o deseleccionar todos los checkboxes
    $("#selectAll").click(function() {
      $(".liquidacionCheck").prop('checked', $(this).prop('checked'));
    });

    // Guardar el valor de los checkboxes seleccionados en una lista
    var selectedLiquidaciones = [];
    $(".liquidacionCheck").click(function() {
      if ($(this).prop('checked')) {
        selectedLiquidaciones.push($(this).val());
      } else {
        selectedLiquidaciones.splice(selectedLiquidaciones.indexOf($(this).val()), 1);
      }
    });

    // Generar resumen para múltiples liquidaciones
    $("#generarResumenMultiple").click(function() {
      if (selectedLiquidaciones.length > 0) {
        $.ajax({
          url: 'imprimir_resumen.php',
          method: 'POST',
          data: { lista: selectedLiquidaciones },
          success: function(response) {
            if (response.success) {
              var newWindow = window.open('', '_blank');
              newWindow.document.write(response.html);
              newWindow.document.close();
            } else {
              alert("Error: " + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error("Error en la llamada AJAX:", error);
            alert("Hubo un error al generar el resumen. Por favor, inténtalo de nuevo.");
          }
        });
      } else {
        alert("Por favor, seleccione al menos una liquidación.");
      }
    });
  }); // Cierre de $(document).ready
</script>

</body>

</html>
