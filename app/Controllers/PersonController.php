<?php

namespace App\Controllers;

use Db\PDO\Connection;

class PersonController
{

  private $connection;

  public function __construct()
  {
    $this->connection = Connection::getInstance()->getDbInstance();
  }

  public function getAll()
  {
    $query = $this->connection->prepare("SELECT * FROM persona");
    $query->execute();
    $res = $query->fetchAll(\PDO::FETCH_ASSOC);
    $json = json_encode($res);
    return $json;
  }

  public function insert($p)
  {
    $query = $this->connection->prepare("INSERT INTO persona (nombre, celular, dirección, estrato) VALUES (?,?,?,?)");
    $status = $query->execute([$p['nombre'], $p['celular'], $p['direccion'], $p['estrato']]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }

  public function destroy($id)
  {
    $query = $this->connection->prepare("DELETE FROM persona WHERE persona.id = ?");
    $status = $query->execute([$id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
}