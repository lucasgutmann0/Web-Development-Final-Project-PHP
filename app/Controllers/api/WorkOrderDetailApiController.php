<?php

namespace App\Controllers\api;

use App\Controllers\WorkOrderDetailController;

// get global variables
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $_SERVER['REQUEST_URI'])[3];
$method = $_SERVER['REQUEST_METHOD'];
$query = explode('&', $_SERVER['QUERY_STRING']);

$work_order_detail_controller = new WorkOrderDetailController();

switch ($method) {
  case 'GET':
    if (count($query) < 2) {
      $charges = $work_order_detail_controller->getAll();
      echo $charges;
    } else {
      $id = explode('=', $query[1])[1];
      $charge = $work_order_detail_controller->getMultipleById($id);
      print_r($charge);
    }
    break;
  case 'POST':
    // String $_POST body data
    $reqBody = file_get_contents('php://input');
    // convert from String to JSON
    $json = json_decode($reqBody, TRUE);
    // insert into db
    $status = $work_order_detail_controller->insert($json);

    // check status of the query
    if ($status['success'] == true && $status['rows_affected'] > 0) {
      // change http status code - CREATED
      http_response_code(201);
      // create a response message
      $res = array("message" => "The data was successfully saved");
      // return message
      echo json_encode($res);
    } else {
      // change http status code - CREATED
      http_response_code(500);
      // create a response message
      $res = array("message" => "The query didn't succeed");
      // return message
      echo json_encode($res);
    }
    break;

  case 'DELETE':
    // get id from params in path
    $id = explode('=', $query[1])[1];
    // delete from db
    $status = $work_order_detail_controller->destroy($id);

    print_r($status);

    // check status of the query
    if ($status['success'] == true && $status['rows_affected'] > 0) {
      // change http status code - CREATED
      http_response_code(200);
      // create a response message
      $res = array("message" => "That row was successfully deleted");
      // return message
      echo json_encode($res);
    } else {
      // change http status code - CREATED
      http_response_code(500);
      // create a response message
      $res = array("message" => "The query didn't succeed");
      // return message
      echo json_encode($res);
    }
    break;
  case 'PUT':
    // get id from params in path
    $id = explode('=', $query[1])[1];

    // get body data  body data
    $reqBody = file_get_contents('php://input');
    // convert from String to JSON
    $json = json_decode($reqBody, TRUE);
    // insert into db
    $status = $work_order_detail_controller->update($json, $id);

    // check status of the query
    if ($status['success'] == true && $status['rows_affected'] > 0) {
      // change http status code - CREATED
      http_response_code(200);
      // create a response message
      $res = array("message" => "The data was successfully saved");
      // return message
      echo json_encode($res);
    } else {
      // change http status code - CREATED
      http_response_code(500);
      // create a response message
      $res = array("message" => "The query didn't succeed");
      // return message
      echo json_encode($res);
    }

    break;
  case 'PATCH':
    print_r('PATCH REQUEST');
    break;
  default:
    # code...
    break;
}
