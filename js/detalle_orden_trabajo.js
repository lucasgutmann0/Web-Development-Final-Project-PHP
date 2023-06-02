const table = document.querySelector("#detalle-orden-trabajo-table");
const tableBody = document.querySelector("#detalle-orden-trabajo-table-body");
//selecting form
const insertForm = document.querySelector("#insert-form");

const id = window.location.search.substring(1).split('=')[1];

const getAllData = async () => {
  let res = fetch(`api/detalle_orden_de_trabajo?id=${id}`).then(async (res) => {
    return await res.json();
  });
  return res;
};

function formatMoney(number) {
  return number.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
}

const calcTotals = (res) => {
  const total_time = document.querySelector("#total_tiempo");
  const total_value = document.querySelector("#total_valor");
  let total_tiempo = 0;
  let total_valor = 0;

  console.log(res)
  res.forEach(v => {
    total_valor += v.valor;
    total_tiempo += v.tiempo;
  });
  total_time.innerHTML = `${total_tiempo} días`;
  total_value.innerHTML = `${formatMoney(total_valor)}`;
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
      fetch(`api/detalle_orden_de_trabajo?id=${id}`, { method: "DELETE" }).finally(() => {
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
      <button class='action-btn' onclick='deleteFromTable(${item.id})'>
        <span class='material-icons'>delete</span>
      </button>
      `;
    });
    calcTotals(data);
  } catch (error) {
    console.log("No data");
  }
}

// Form funcitionality
async function insertInto(e) {
  let formData = new FormData(insertForm);
  e.preventDefault();
  let data = {
    id_orden: formData.get('id_orden'),
    id_auto: formData.get('id_auto'),
    id_trabajador: formData.get('id_trabajador'),
    id_estado: formData.get('id_estado'),
    trabajo: formData.get("trabajo"),
    tiempo: formData.get("tiempo"),
    valor: formData.get("valor"),
  };
  fetch(`api/detalle_orden_de_trabajo`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then((res) => {
    if (res.status === 201) {
      Swal.fire({
        icon: "success",
        title: "Se ha registrado la orden exitosamente",
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
    // refresh table
    getAllData().then(async (res) => {
      addRowsToTable(res);
    });
    // clean fields
    /* insertForm.reset(); */
  });
}

async function updateInTable(e) {
  let formData = new FormData(updateForm);
  e.preventDefault();
  let data = {
    id: window.name,
    descripcion: formData.get("descripcion"),
    fecha: formData.get("fecha"),
  };
  fetch(`api/orden_de_trabajo?id=${data.id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then((res) => {
    if (res.status < 400) {
      Swal.fire({
        icon: "success",
        title: "Se ha actualizado la orden de trabajo exitosamente",
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

const fillSelectors = async () => {
  /* selectors */
  const order = document.querySelector("#orden-id")
  order.value = id;
  const worker_selector = document.querySelector("#trabajador-selector-id")
  /* const work_selector = document.getElementsByName("trabajo-selector") */
  const car_selector = document.querySelector("#auto-selector-id")
  const status_selector = document.querySelector("#estado-selector-id")

  let workers = await fetch(`api/trabajadores`).then(async (res) => { if (res.status < 300) return await res.json(); })
  let statuses = await fetch(`api/estados`).then(async (res) => { if (res.status < 300) return await res.json(); })
  let cars = await fetch(`api/autos`).then(async (res) => { if (res.status < 300) return await res.json(); })

  cars.forEach((el) => {
    let opt = document.createElement('option');
    opt.value = el.id;
    opt.innerHTML = el.placa;
    car_selector.appendChild(opt);
  })

  workers.forEach((el) => {
    let opt = document.createElement('option');
    opt.value = el.id;
    opt.innerHTML = el.nombre;
    worker_selector.appendChild(opt);
  })

  statuses.forEach((el) => {
    let opt = document.createElement('option');
    opt.value = el.id;
    opt.innerHTML = el.nombre;
    status_selector.appendChild(opt);
  })
}

insertForm.addEventListener("submit", (event) => insertInto(event));
/* updateForm.addEventListener("submit", (event) => updateInTable(event)); */

getAllData().then(async (res) => {
  addRowsToTable(res);
});

fillSelectors()
