const table = document.querySelector("#trabajadores-table");
const tableBody = document.querySelector("#trabajadores-table-body");
//selecting form
const insertForm = document.querySelector("#insert-form");
const updateForm = document.querySelector("#update-form");

// selecting buttons
const btnInsert = document.querySelector("#add-worker-btn");
const clsBtnInsert = document.querySelector("#close-worker-modal-insert");
const clsBtnUpdate = document.querySelector("#close-worker-modal-update");

// selecting modals - insert
const modalWrapInsert = document.querySelector("#add-worker-modal");
const modalInsert = document.querySelector("#add-worker-modal-content");

// selecting modals - update
const modalWrapUpdate = document.querySelector("#update-worker-modal");
const modalUpdate = document.querySelector("#update-worker-modal-content");

// hide modal function
const hideModal = (m, mW) => {
  m.classList.add("slideUpAnim");
  mW.classList.add("hideAnim");
  setTimeout(() => {
    mW.style.display = "none";
    m.classList.remove("slideUpAnim");
    mW.classList.remove("hideAnim");
  }, 1000);
};

// show modal
const showModal = (mW) => {
  mW.style.display = "flex";
};

const showModalUpdate = (id) => {
  modalWrapUpdate.style.display = "flex";
  window.name = id
  fetch(`api/trabajadores?id=${id}`).then(async (res) => {
    if (res.status === 200) {
      let data = await res.json();
      console.log(data);
      let inputs = updateForm.querySelectorAll('input, select')
      inputs.forEach((elem) => {
        elem.value = data[elem.name];
      })
    }
  });
}

// assinging functions - insert
btnInsert.addEventListener("click", () => showModal(modalWrapInsert));
clsBtnInsert.addEventListener("click", () => hideModal(modalInsert, modalWrapInsert));

// assinging functions - update
clsBtnUpdate.addEventListener("click", () => hideModal(modalUpdate, modalWrapUpdate));

const getAllData = async () => {
  let res = fetch("api/trabajadores").then(async (res) => {
    return await res.json();
  });
  return res;
};

const fillSelectors = async () => {
  let selectors = document.getElementsByName("id_cargo")
  let data = await fetch("api/cargos").then(async (res) => {
    if (res.status < 300) return await res.json();
  })
  selectors.forEach((elem) => {
    data.forEach((el) => {
      let opt = document.createElement('option');
      opt.value = el.id;
      opt.innerHTML = el.nombre;
      elem.appendChild(opt);
    })
  })
}

const deleteFromTable = async (id) => {
  Swal.fire({
    title: 'Estas seguro?',
    text: "Los cambios son irreversibles!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, borrar!'
  }).then(async (res) => {
    if (res.isConfirmed) {
      fetch(`api/trabajadores?id=${id}`, { method: "DELETE" }).finally(() => {
        getAllData().then(async (res) => {
          addRowsToTable(res);
        });
      });
    }
  })
};

function addRowsToTable(data) {
  try {
    tableBody.innerHTML = '';
    let keys = Object.keys(data[0]).map((key) => key);
    data.forEach((item) => {
      const row = tableBody.insertRow();
      keys.forEach((key, idx) => {
        let cell = row.insertCell(idx);
        cell.innerHTML = item[key];
      });
      let delBtnCell = row.insertCell(keys.length);
      delBtnCell.classList.add("row");
      delBtnCell.innerHTML = `
      <button class='action-btn' onclick='showModalUpdate(${item.id})'>
        <span class='material-icons'>edit</span>
      </button>
      <button class='action-btn' onclick='deleteFromTable(${item.id})'>
        <span class='material-icons'>delete</span>
      </button>
      `;
    });
  } catch (error) {
    console.log("No data");
  }
}

// Form funcitionality
async function insertInto(e) {
  let formData = new FormData(insertForm);
  e.preventDefault();
  let data = {
    nombre: formData.get("nombre"),
    celular: formData.get("celular"),
    direccion: formData.get("direccion"),
    id_cargo: formData.get("id_cargo"),
  };
  fetch(`api/trabajadores`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then((res) => {
    if (res.status === 201) {
      Swal.fire({
        icon: "success",
        title: "Se ha registrado al trabajador exitosamente",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Algo salio mal, intenta nuevamente!",
        showConfirmButton: false,
        timer: 1500,
      });
    }
  }).finally(() => {
    // hide modal
    hideModal(modalInsert, modalWrapInsert)
    // refresh table
    getAllData().then(async (res) => {
      addRowsToTable(res);
    });
    // clean fields
    insertForm.reset();
  });
}

async function updateInTable(e) {
  let formData = new FormData(updateForm);
  e.preventDefault();
  let data = {
    id: window.name,
    nombre: formData.get("nombre"),
    celular: formData.get("celular"),
    direccion: formData.get("direccion"),
    id_cargo: formData.get("id_cargo"),
  };
  console.log(data);
  fetch(`api/trabajadores?id=${data.id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then((res) => {
    if (res.status < 400) {
      Swal.fire({
        icon: "success",
        title: "Se ha actualizado a la workera exitosamente",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Algo salio mal, intenta mas tarde!",
        showConfirmButton: false,
        timer: 1500,
      });
    }
  }).finally(() => {
    // hide modal
    hideModal(modalUpdate, modalWrapUpdate)
    // refresh table
    getAllData().then(async (res) => {
      addRowsToTable(res);
    });
    // clean fields
    updateForm.reset();
  });
}

insertForm.addEventListener("submit", (event) => insertInto(event));
updateForm.addEventListener("submit", (event) => updateInTable(event));

getAllData().then(async (res) => {
  addRowsToTable(res);
});

fillSelectors()
