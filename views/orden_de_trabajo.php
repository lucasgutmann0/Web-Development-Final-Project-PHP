<!DOCTYPE html>
<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <script defer src="js/orden_de_trabajo.js"></script>
  <title>orden_de_trabajo</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="main-container" style="padding-top: 6rem;">
    <!-- text -->
    <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
      <div>
        <h1>Orden de trabajo</h1>
        <h3 style="font-weight: 500; color: gray; width: 90%;">En la siguiente tabla se muestra la información de todas
          las ordenes de trabajo registradas en la base de datos.</h3>
      </div>
      <button id="add-work-order-btn">agregar</button>
    </div>
    <!-- insert modal -->
    <div id="add-work-order-modal" class="modal-wrapper">
      <!-- <button id="close-work-order-modal"></button> -->
      <div class="modal" id="add-work-order-modal-content">
        <button id="close-work-order-modal-insert" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>Orden de trabajo</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás agregar a una nueva orden de trabajo a la
          aplicación</p>
        <form method="POST" id="insert-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" id="fecha_id" required>
          </div>
          <div>
            <label for="descripcion">Descripcion</label>
            <textarea type="text" name="descripcion" id="descripcion_id" required></textarea>
          </div>
          <button style="width: 100%;">ingresar</button>
        </form>
      </div>
    </div>
    <!-- update modal -->
    <div id="update-work-order-modal" class="modal-wrapper">
      <!-- <button id="close-work-order-modal"></button> -->
      <div class="modal" id="update-work-order-modal-content">
        <button id="close-work-order-modal-update" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>Orden de trabajo</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás editar la información de la orden de trabajo a la seleccionada</p>
        <form method="POST" id="update-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="fecha">Fecha</label>
            <input type="text" name="fecha" id="fecha_id" required>
          </div>
          <div>
            <label for="descripcion">Descripcion</label>
            <textarea type="text" name="descripcion" id="descripcion_id" required></textarea>
          </div>
          <button style="width: 100%;">actualizar</button>
        </form>
      </div>
    </div>
    <table id="orden_de_trabajo-table" class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descripcion</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="orden_de_trabajo-table-body"></tbody>
    </table>
  </div>
</body>

</html>
