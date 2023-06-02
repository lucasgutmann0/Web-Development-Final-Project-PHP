<?php

use App\Controllers\WorkOrderDetailController;

// get global variables
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $_SERVER['REQUEST_URI'])[2];
$path_clean = explode('?', $path);
$id = explode("=", $path_clean[1])[1];

$word_controller = new WorkOrderDetailController();
$json = $word_controller->getMultipleById($id);
$data = json_decode($json);

$total_value = 0;
$total_tiempo = 0;

foreach ($data as $d) {
  $total_value = $total_value + $d->valor;
  $tiempo_clean = explode(' ', $d->tiempo)[0];
  $total_tiempo = $total_tiempo + $tiempo_clean;
}

?>

<html lang="en">

<head>
  <?php require(dirname(__DIR__) . '/utils/header.php'); ?>
  <style>
    body {
      background-color: white;
      color: black;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: center;
      padding: 8px;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #b91c1c;
      color: white;
    }

    .spec-style {
      background-color: #b91c1c;
      color: white;
    }
  </style>
</head>

<body>
  <h1 id="title">Orden de trabajo - ID <?php echo $id ?></h1>
  <p>En el siguiente informe se lista la información relacionada a la orden con el ID <?php echo $id ?> para la persona</p>
  <table id='detalle-orden-trabajo-table'>
    <thead>
      <tr>
        <th>ID</th>
        <th>Estado</th>
        <th>Trabajador</th>
        <th>Trabajo</th>
        <th>Valor</th>
        <th>Tiempo</th>
      </tr>
    </thead>
    <tbody id='detalle-orden-trabajo-table-body'>
      <?php
      foreach ($data as $el) {
        echo "
        <tr>
          <td>" . $el->id . "</td>
          <td>" . $el->estado . "</td>
          <td>" . $el->trabajador . "</td>
          <td>" . $el->trabajo . "</td>
          <td>" . $el->valor . "</td>
          <td>" . $el->tiempo . "</td>
        </tr>";
      };
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th scope='row' colspan='4'>Total</th>
        <td class="spec-style"><?php echo $total_value ?></td>
        <td class="spec-style"><?php echo $total_tiempo ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</body>


<script>
</script>

</html>
