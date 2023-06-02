<!DOCTYPE html>
<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <script defer src="js/cargo.js"></script>
  <title>Cargos</title>
</head>

<body style="background: #27272a;">
  <?php include(dirname(__DIR__) . "/components/navbar.php") ?>
  <div class="main-container" style="padding-top: 6rem;">
    <!-- text -->
    <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
      <div>
        <h1>Cargos</h1>
        <h3 style="font-weight: 500; color: gray; width: 90%;">En la siguiente tabla se muestra la información de todos
          las cargos registradas en la base de datos.</h3>
      </div>
    </div>
    <div class="row" style="align-items: flex-start; margin-top: 20px">
      <table id="cargos-table" class="content-table" style="margin-top: 0;">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="cargos-table-body"></tbody>
      </table>
      <div class="modal" id="add-charge-modal-content" style="animation-name: none; height: 100%; text-align: center;">
        <h1>Cargo</h1>
        <p style="width: 90%; padding-bottom: 10px;">En el siguiente formulario podrás agregar un nueva auto a la
          aplicación</p>
        <form method="POST" id="insert-form" style="display: flex; align-items:start; flex-direction: column; width: 100%; height: 100%;gap: 20px;">
          <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre_id" required>
          </div>
          <div>
            <label for="descripcion">Descripcion</label>
            <textarea type="text" name="descripcion" id="descripcion_id" required></textarea>
          </div>
          <button style="width: 100%;">ingresar</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
