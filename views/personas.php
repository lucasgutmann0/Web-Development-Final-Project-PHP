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
    <!-- modal -->
    <div id="add-person-modal" class="modal-wrapper">
      <!-- <button id="close-person-modal"></button> -->
      <div class="modal" id="add-person-modal-content">
        <button id="close-person-modal" class="close-btn" style="position: absolute; right:20px; top: 20px;">x</button>
        <h1>Persona</h1>
        <p style="width: 60%; padding-bottom: 10px;">En el siguiente formulario podrás agregar a una nueva persona a la
          aplicación</p>
        <form method="POST" id="insert-form"
          style="display: flex; align-items:start; flex-direction: column; width: 100%; gap: 20px;">
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
            <input type="text" name="direccion" id="direccion_id" required>
          </div>
          <div>
            <label for="estrato">Estrato</label>
            <input type="text" name="estrato" id="estrato_id" required>
          </div>
          <button style="width: 100%;">ingresar</button>
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

  <script>
    // selecting buttons
    const btn = document.querySelector("#add-person-btn");
    const clsBtn = document.querySelector("#close-person-modal");
    // selecting modals
    const modalWrap = document.querySelector("#add-person-modal");
    const modal = document.querySelector("#add-person-modal-content");

    // hide modal function
    const hideModal = () => {
      modal.classList.add("slideUpAnim");
      modalWrap.classList.add("hideAnim");
      setTimeout(() => {
        modalWrap.style.display = "none";
        modal.classList.remove("slideUpAnim");
        modalWrap.classList.remove("hideAnim");
      }, 1000);
    };

    // show modal
    const showModal = () => {
      modalWrap.style.display = "flex";
    };

    // assinging functions
    btn.addEventListener("click", () => showModal());

    clsBtn.addEventListener("click", () => hideModal());
  </script>
</body>

</html>