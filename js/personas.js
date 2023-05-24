const table = document.querySelector("#personas-table");
const tableBody = document.querySelector("#personas-table-body");
//selecting form
const insertForm = document.querySelector("#insert-form");

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
      <button class='action-btn'>
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
      hideModal();
      getAllData().then(async (res) => {
        addRowsToTable(res);
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
  });
}

insertForm.addEventListener("submit", (event) => insertInto(event));

getAllData().then(async (res) => {
  addRowsToTable(res);
});
