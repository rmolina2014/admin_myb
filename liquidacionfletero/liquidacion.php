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
require_once '../remito/remito.php';
include '../cabecera.php';

function cambiaf_mysql($fechadb)
{
  list($yy, $mm, $dd) = explode("-", $fechadb);
  $fecha = new DateTime();
  $fecha->setDate($yy, $mm, $dd);
  echo $fecha->format('d-m-Y');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $idhrint = $_GET['id'];
?>
  <div class="container">
    <div class="row">
      <h4>Liquidacion Fletero -Hoja de Ruta Interna</h4>

      <div class="col-md-12">
        <?php
        $objecto = new liquidacionfletero();
        $listado = $objecto->cabecerahri($idhrint);
        while ($item = mysqli_fetch_array($listado)) {

        ?>

          <div class="row">

            <label> Numero : <?php echo $numeroHRI = $item['numero']; ?> </label>

            <input type="hidden" id="idhojarutainterna" value="<?php echo $numeroHRI = $item['numero']; ?>">

            <label> Fecha : <?php echo $item['fecha']; ?> </label>
            <br>

            <label> Chofer : <?php echo $item['nombrechofer']; ?> </label>

            <label> Patente Camion : <?php echo $item['patentecamion']; ?> </label>
            <br>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6 col-md-2"><label> Porcentaje Fletero :</label></div>
            <div class="col-xs-6 col-md-2"> <input type="number" id="porcentaje" name="porcentaje" class="form-control"></div>
            <div class="col-xs-6 col-md-2"> <button class="btn btn-primary" onclick="Calcular();">Calcular</button></div>
          </div>

          <br>

      </div>

    <?php
        }
    ?>

    </div>
    <br>

    <h4>Detalle</h4>

    <div id="div_dinamico">

      <div class="col-md-12">
        <!-- Listado de remitos -->
        <table id="listado" class="table">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Nº guia</th>
              <TH>Destinatario </TH>
              <TH>Proveedor </TH>
              <TH>Bultos</TH>
              <th>Nº Sur Exp.</th>
              <th>Importe</th>
              <th>Importe Dividido en 1.21</th>
              <th>Importe Fletero</th>
            </tr>
            <thead>
            <tbody>
              <?php
              $porcentaje = 0;
              setlocale(LC_MONETARY, "es_AR");

              $usuarios = $objecto->listaremito($idhrint);
              while ($item = mysqli_fetch_array($usuarios)) {
                $neto = 0;
                $a = 0;
              ?>
                <tr>
                  <td><?php echo cambiaf_mysql($item['fecha']); ?></td>
                  <td><?php echo $item['numeroremito']; ?></td>
                  <td><?php echo $item['nombrecliente']; ?></td>
                  <td><?php echo $item['nombreproveedor']; ?></td>
                  <td><?php echo $item['bultos']; ?></td>
                  <td><?php echo $item['remitose']; ?></td>
                  <td>
                    <p>
                      <span id="importe<?php echo $item['detalleinterna_id']; ?>">
                        <?php
                        if ($item['importe'] > 0) {
                          echo number_format($item['importe'], 2, ',', '.');
                        } else {
                          echo $item['importe'];
                        }
                        ?>
                      </span>
                      <!-- ... -->
                      <button type="button" class="btn btn-primary btn-xs editar" data-toggle="modal" data-target="#myModal" value="<?php echo $item['detalleinterna_id']; ?>">
                        <span class="glyphicon glyphicon-pencil"></span> Editar
                      </button>
                    </p>
                  </td>
                  <td>
                    <?php
                    if ($item['importe'] > 0) {
                      $a = round(($item['importe'] / 1.21), 2);
                      echo number_format($a, 2, ',', '.');

                      $neto = $neto + $a;
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if ($porcentaje > 0) {
                      $a = round((($neto * $porcentaje) / 100), 2);
                      echo number_format($a, 2, ',', '.');
                    }
                    ?>
                  </td>
                  <!--td> x </td-->
                </tr>
              <?php
              } //fin del while
              ?>
            </tbody>
        </table>


        <!--fin listado remitos-->
      </div>
      <!--fin listado remitos-->
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Editar Importe</h4>
          </div>

          <div class="modal-body">
            <form method="post" id="formdata" autocomplete="off">
              <div class="col">
                <!--form method="post" action="actualizar_importe.php"-->
                <input type="hidden" name="id_detallehri" id="id_detallehri" />
                <input type="text" name="e_importe" class="form-control" id="e_importe" />
                <!--input type="submit" value="Guardar">
          <form-->
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="guardarimporte();">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal -->

  </div>
  </div>
  </div>


<?php
}
?>
<script>
  function Calcular() {
    vporcentaje = $("#porcentaje").val();
    vidrutainterna = $("#idhojarutainterna").val();
    //alert(vidrutainterna);
    $.ajax({
      type: "POST",
      cache: false,
      async: false,
      url: 'calcular.php',
      data: {
        porcentaje: vporcentaje,
        id: vidrutainterna
      },
      success: function(data) {
        if (data) {
          //$('#div_dinamico').hide();
          $('#div_dinamico').html(data);
        }
      }
    }) //fin ajax*/
  }

  function guardarimporte() {
    vimporte = $("#e_importe").val();
    vidrutainterna = $("#id_detallehri").val();
    // no se porque sale alert("imp :"+vimporte+" deta: "+vidrutainterna);

    $.ajax({
      type: "POST",
      cache: false,
      async: false,
      url: 'actualizar_importe.php',
      data: {
        importe: vimporte,
        id: vidrutainterna
      },
      success: function(data) {
        if (data) {
          alert(data);
          // Recargo la página
          location.reload();
          //$('#div_dinamico').hide();
          //$('#div_dinamico').html(data);
        }
      }
    }) //fin ajax*/
  }

  $(document).ready(function() {
    $(document).on('click', '.editar', function() {
      var detalleinterna_id = $(this).val();
      var importe = $.trim($('#importe' + detalleinterna_id).text());
      $('#myModal').modal('show');
      $('#e_importe').val(importe);
      $('#id_detallehri').val(detalleinterna_id);
    });
  });
</script>