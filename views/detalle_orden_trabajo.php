<!DOCTYPE html>
<html lang="en">

<?php
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $_SERVER['REQUEST_URI'])[2];
$path_clean = explode('?', $path);
$id = explode("=", $path_clean[1])[1];
?>

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <script defer src="js/detalle_orden_trabajo.js"></script>
  <title>Detalle Orden de Trabajo</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="main-container" style="padding-top: 6rem;">
    <!-- text -->
    <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
      <div>
        <h1>Detalles de Orden de Trabajo</h1>
      </div>
      <button style="display: flex; align-items: center; gap: 8px; justify-content: space-between;">
        <a href="generar_pdf?id=<?php echo $id ?>" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
          <span class="material-icons">picture_as_pdf</span>
          Descargar informe
        </a>
      </button>
    </div>
    <div class="row" style="align-items: flex-start; margin-top: 20px">
      <div class="modal" id="add-detail-work-order-modal-content" style="animation-name: none; min-height: 50vh; width: 100%; text-align: center; overflow-y: hidden">
        <form method="POST" id="insert-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; height: 100%;gap: 20px;">
          <div class="row">
            <div>
              <label>Id de la Orden</label>
              <input placeholder="Id orden" name="id_orden" id="orden-id" readonly>
            </div>
            <div>
              <label>Vehículo</label>
              <select name="id_auto" id="auto-selector-id">
                <option>Vehiculo</option>
              </select>
            </div>
          </div>
          <div class="row">
            <select name="id_estado" id="estado-selector-id">
              <option>Estado</option>
            </select>
            <select name="id_trabajador" id="trabajador-selector-id">
              <option>Trabajador</option>
            </select>
            <select name="trabajo" id="work-selector-id">
              <option>Trabajo</option>
              <option value="Cambio de aceite">Cambio de aceite</option>
              <option value="Balanceo">Balanceo</option>
              <option value="Calibracion de bujias">Calibración de bujias</option>
              <option value="Revisión Tecnomecanica">Revisión Tecnomecanica</option>
              <option value="Cambio de neumatico">Cambio de neumatico</option>
              <option value="Pintado de carro">Pintado de carro</option>
              <option value="Polarizado de espejos">Polarizado de espejos</option>
            </select>
            <div class="row">
              <label>Valor</label>
              <input placeholder="$0" name="valor" id="valor-id">
            </div>
            <div class="row">
              <label>Tiempo</label>
              <input placeholder="días" name="tiempo" id="tiempo-id">
            </div>
            <button style="width: 50%;">guardar</button>
          </div>
        </form>
        <div style="width: 100%;">
          <table id="detalle-orden-trabajo-table" class="content-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Trabajador</th>
                <th>Trabajo</th>
                <th>Valor</th>
                <th>Tiempo</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody id="detalle-orden-trabajo-table-body">
            </tbody>
            <tfoot>
              <tr>
                <th scope="row" colspan="4">Total</th>
                <td id="total_valor">0</td>
                <td id="total_tiempo">0</td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
