<?php

namespace App\Controllers;

use Db\PDO\Connection;

class StatusController
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
    $query = $this->connection->prepare("SELECT * FROM estado");
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
    $query = $this->connection->prepare("SELECT * FROM estado WHERE id = ?");
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
    $query = $this->connection->prepare("INSERT INTO estado (nombre) VALUES (?)");
    $status = $query->execute([$p['nombre']]);
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
    $query = $this->connection->prepare("UPDATE estado SET nombre = ? WHERE id = ?");
    $status = $query->execute([$p['nombre'], $id]);
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
    $query = $this->connection->prepare("DELETE FROM estado WHERE estado.id = ?");
    $status = $query->execute([$id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
}
