<?php

namespace App\Controllers;

use Db\PDO\Connection;

class ChargeController
{

  private $connection;

  public function __construct()
  {
    $this->connection = Connection::getInstance()->getDbInstance();
  }
  /**
   * @return string|bool
   */
  public function getAll(): string|bool
  {
    $query = $this->connection->prepare("SELECT * FROM cargo");
    $query->execute();
    $res = $query->fetchAll(\PDO::FETCH_ASSOC);
    $json = json_encode($res);
    return $json;
  }
  /**
   * @return string|bool
   * @param mixed $id
   */
  public function getOne($id): string|bool
  {
    $query = $this->connection->prepare("SELECT * FROM cargo WHERE id = ?");
    $query->execute([$id]);
    $res = $query->fetch(\PDO::FETCH_ASSOC);
    $json = json_encode($res);
    return $json;
  }
  /**
   * @return array
   * @param mixed $p
   */
  public function insert($p): array
  {
    $query = $this->connection->prepare("INSERT INTO cargo (nombre, descripcion) VALUES (?, ?)");
    $status = $query->execute([$p['nombre'], $p['descripcion']]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
  /**
   * @return array
   * @param mixed $p
   * @param mixed $id
   */
  public function update($p, $id): array
  {
    $query = $this->connection->prepare("UPDATE cargo SET nombre = ?, descripcion = ? WHERE id = ?");
    $status = $query->execute([$p['nombre'], $p['descripcion'], $id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
  /**
   * @return array
   * @param mixed $id
   */
  public function destroy($id): array
  {
    $query = $this->connection->prepare("DELETE FROM cargo WHERE cargo.id = ?");
    $status = $query->execute([$id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
}
