<!DOCTYPE html>
<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <script defer src="js/autos.js"></script>
  <title>Autos</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="main-container" style="padding-top: 6rem;">
    <!-- text -->
    <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
      <div>
        <h1>Autos</h1>
        <h3 style="font-weight: 500; color: gray; width: 90%;">En la siguiente tabla se muestra la información de todos
          las autos registradas en la base de datos.</h3>
      </div>
      <button id="add-car-btn">agregar</button>
    </div>
    <!-- insert modal -->
    <div id="add-car-modal" class="modal-wrapper">
      <div class="modal" id="add-car-modal-content">
        <button id="close-car-modal-insert" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>auto</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás agregar un nueva auto a la
          aplicación</p>
        <form method="POST" id="insert-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="placa">Placa</label>
            <input type="text" name="placa" id="placa_id" required>
          </div>
          <div>
            <label for="color">Color</label>
            <input type="text" name="color" id="color_id" required>
          </div>
          <div>
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca_id" required>
          </div>
          <div>
            <label for="no_puertas">No Puertas</label>
            <select name="no_puertas" title="no_puertas" id="noPuertas_id" required>
              <option value="2">2</option>
              <option value="4">4</option>
              <option value="6">6</option>
              <option value="8">8</option>
            </select>
          </div>
          <div>
            <label for="id_persona">Dueño</label>
            <select name="id_persona" title="id_persona" id="id_persona_id" required></select>
          </div>
          <button style="width: 100%;">ingresar</button>
        </form>
      </div>
    </div>
    <!-- update modal -->
    <div id="update-car-modal" class="modal-wrapper">
      <!-- <button id="close-car-modal"></button> -->
      <div class="modal" id="update-car-modal-content">
        <button id="close-car-modal-update" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>auto</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás editar la información de la auto a la seleccionada</p>
        <form method="POST" id="update-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
          <div>
            <label for="placa">Placa</label>
            <input type="text" name="placa" id="placa_id" required>
          </div>
          <div>
            <label for="color">color</label>
            <input type="text" name="color" id="color_id" required>
          </div>
          <div>
            <label for="marca">marca</label>
            <input type="text" name="marca" id="marca_id" required>
          </div>
          <div>
            <label for="no_puertas">No Puertas</label>
            <select name="no_puertas" title="no_puertas" id="noPuertas_id" required>
              <option value="2">2</option>
              <option value="4">4</option>
              <option value="6">6</option>
              <option value="8">8</option>
            </select>
          </div>
          <div>
            <label for="id_persona">Dueño</label>
            <select name="id_persona" title="id_persona" id="id_persona_id" required></select>
          </div>
          <button style="width: 100%;">actualizar</button>
        </form>
      </div>
    </div>
    <table id="autos-table" class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Placa</th>
          <th>Color</th>
          <th>Marca</th>
          <th>No Puertas</th>
          <th>Dueño</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="autos-table-body"></tbody>
    </table>
  </div>
</body>

</html>
