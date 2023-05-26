const table = document.querySelector("#personas-table");
const tableBody = document.querySelector("#personas-table-body");
//selecting form
const insertForm = document.querySelector("#insert-form");
const updateForm = document.querySelector("#update-form");


// selecting buttons
const btnInsert = document.querySelector("#add-person-btn");
const clsBtnInsert = document.querySelector("#close-person-modal-insert");
const clsBtnUpdate = document.querySelector("#close-person-modal-update");

// selecting modals - insert
const modalWrapInsert = document.querySelector("#add-person-modal");
const modalInsert = document.querySelector("#add-person-modal-content");

// selecting modals - update
const modalWrapUpdate = document.querySelector("#update-person-modal");
const modalUpdate = document.querySelector("#update-person-modal-content");

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
  fetch(`api/personas?id=${id}`).then(async (res) => {
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
  let res = fetch("api/personas").then(async (res) => {
    return await res.json();
  });
  return res;
};

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
      fetch(`api/personas?id=${id}`, { method: "DELETE" }).finally(() => {
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
      let delBtnCell = row.insertCell(5);
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
    direccion: formData.get("dirección"),
    estrato: formData.get("estrato"),
  };
  fetch(`api/personas`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then((res) => {
    if (res.status === 201) {
      Swal.fire({
        icon: "success",
        title: "Se ha registrado a la persona exitosamente",
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
    direccion: formData.get("dirección"),
    estrato: formData.get("estrato"),
  };
  console.log(data);
  fetch(`api/personas?id=${data.id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then((res) => {
    if (res.status < 400) {
      Swal.fire({
        icon: "success",
        title: "Se ha actualizado a la persona exitosamente",
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
