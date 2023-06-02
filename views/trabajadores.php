<!DOCTYPE html>
<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <script defer src="js/trabajador.js"></script>
  <title>Trabajadores</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="main-container" style="padding-top: 6rem;">
    <!-- text -->
    <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
      <div>
        <h1>Trabajadores</h1>
        <h3 style="font-weight: 500; color: gray; width: 90%;">En la siguiente tabla se muestra la información de todos
          las trabajadores registrados en la base de datos.</h3>
      </div>
      <button id="add-worker-btn">agregar</button>
    </div>
    <!-- insert modal -->
    <div id="add-worker-modal" class="modal-wrapper">
      <div class="modal" id="add-worker-modal-content">
        <button id="close-worker-modal-insert" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>trabajador</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás agregar un nueva trabajador a la
          aplicación</p>
        <form method="POST" id="insert-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre_id" required>
          </div>
          <div>
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular_id" required>
          </div>
          <div>
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" id="direccion_id" required>
          </div>
          <div>
            <label for="id_cargo">Cargo</label>
            <select name="id_cargo" title="id_cargo" id="id_cargo_id" required></select>
          </div>
          <button style="width: 100%;">ingresar</button>
        </form>
      </div>
    </div>
    <!-- update modal -->
    <div id="update-worker-modal" class="modal-wrapper">
      <!-- <button id="close-worker-modal"></button> -->
      <div class="modal" id="update-worker-modal-content">
        <button id="close-worker-modal-update" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>trabajador</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás editar la información de la trabajador a la seleccionada</p>
        <form method="POST" id="update-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre_id" required>
          </div>
          <div>
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular_id" required>
          </div>
          <div>
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" id="direccion_id" required>
          </div>
          <div>
            <label for="id_cargo">Dueño</label>
            <select name="id_cargo" title="id_cargo" id="id_cargo_id" required></select>
          </div>
          <button style="width: 100%;">actualizar</button>
        </form>
      </div>
    </div>
    <table id="trabajadores-table" class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Celular</th>
          <th>Dirección</th>
          <th>Cargo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="trabajadores-table-body"></tbody>
    </table>
  </div>
</body>

</html>
