<?php

namespace App\Controllers;

use Db\PDO\Connection;

class WorkerController
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
    $query = $this->connection->prepare(
      "
      SELECT t.id as id, t.nombre as nombre, t.celular as celular, t.direccion as direccion, c.nombre as nombre_cargo 
      FROM trabajador as t
      JOIN cargo as c
      ON t.id_cargo = c.id"
    );
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
    $query = $this->connection->prepare(
      "
      SELECT t.id as id, t.nombre as nombre, t.celular as celular, t.direccion as direccion, c.id as id_cargo, c.nombre as nombre_cargo 
      FROM trabajador as t
      JOIN cargo as c
      ON t.id_cargo = c.id
      WHERE t.id = ?"
    );
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
    $query = $this->connection->prepare("INSERT INTO trabajador (nombre, celular, direccion, id_cargo) VALUES (?,?,?,?)");
    $status = $query->execute([$p['nombre'], $p['celular'], $p['direccion'], $p['id_cargo']]);
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
    $query = $this->connection->prepare("UPDATE trabajador SET nombre = ?, celular = ?, direccion = ?, id_cargo = ?  WHERE id = ?");
    $status = $query->execute([$p['nombre'], $p['celular'], $p['direccion'], $p['id_cargo'], $id]);
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
    $query = $this->connection->prepare("DELETE FROM trabajador as t WHERE t.id = ?");
    $status = $query->execute([$id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
}
