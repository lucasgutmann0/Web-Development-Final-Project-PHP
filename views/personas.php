<!DOCTYPE html>
<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <script defer src="js/personas.js"></script>
  <title>Personas</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="main-container" style="padding-top: 6rem;">
    <!-- text -->
    <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
      <div>
        <h1>Personas</h1>
        <h3 style="font-weight: 500; color: gray; width: 90%;">En la siguiente tabla se muestra la información de todos
          las personas registradas en la base de datos.</h3>
      </div>
      <button id="add-person-btn">agregar</button>
    </div>
    <!-- insert modal -->
    <div id="add-person-modal" class="modal-wrapper">
      <!-- <button id="close-person-modal"></button> -->
      <div class="modal" id="add-person-modal-content">
        <button id="close-person-modal-insert" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>Persona</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás agregar a una nueva persona a la
          aplicación</p>
        <form method="POST" id="insert-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre_id" required>
          </div>
          <div>
            <label for="celular">Celular</label>
            <input type="number" name="celular" id="celular_id" required>
          </div>
          <div>
            <label for="dirección">Dirección</label>
            <input type="text" name="dirección" id="direccion_id" required>
          </div>
          <div>
            <label for="estrato">Estrato</label>
            <select name="estrato" id="estrato_id" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
            <!-- <input type="number" name="estrato" id="estrato_id" required> -->
          </div>
          <button style="width: 100%;">ingresar</button>
        </form>
      </div>
    </div>
    <!-- update modal -->
    <div id="update-person-modal" class="modal-wrapper">
      <!-- <button id="close-person-modal"></button> -->
      <div class="modal" id="update-person-modal-content">
        <button id="close-person-modal-update" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>Persona</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás editar la información de la persona a la seleccionada</p>
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
            <label for="direccion">Dirección</label>
            <input type="text" name="dirección" id="direccion_id" required>
          </div>
          <div>
            <label for="estrato">Estrato</label>
            <select name="estrato" id="estrato_id" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
            <!-- <input type="text" name="estrato" id="estrato_id" required> -->
          </div>
          <button style="width: 100%;">actualizar</button>
        </form>
      </div>
    </div>
    <table id="personas-table" class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Celular</th>
          <th>Direccion</th>
          <th>Estrato</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="personas-table-body"></tbody>
    </table>
  </div>
</body>

</html>
