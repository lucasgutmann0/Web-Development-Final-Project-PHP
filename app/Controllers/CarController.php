<?php

namespace App\Controllers;

use Db\PDO\Connection;

class CarController
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
      SELECT a.id as id, a.placa as placa, a.color as color, a.marca as marca, a.no_puertas as no_puertas, p.nombre as nombre_persona 
      FROM auto as a
      JOIN persona as p
      ON a.id_persona = p.id"
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
      SELECT a.id as id, a.placa as placa, a.color as color, a.marca as marca, a.no_puertas as no_puertas, p.id as id_persona, p.nombre as nombre_persona 
      FROM auto as a
      JOIN persona as p
      ON a.id_persona = p.id
      WHERE a.id = ?"
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
    $query = $this->connection->prepare("INSERT INTO auto (placa, color, marca, no_puertas, id_persona) VALUES (?,?,?,?,?)");
    $status = $query->execute([$p['placa'], $p['color'], $p['marca'], $p['no_puertas'], $p['id_persona']]);
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
    $query = $this->connection->prepare("UPDATE auto SET placa = ?, color = ?, marca = ?, no_puertas = ?, id_persona = ? WHERE id = ?");
    $status = $query->execute([$p['placa'], $p['color'], $p['marca'], $p['no_puertas'], $p['id_persona'], $id]);
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
    $query = $this->connection->prepare("DELETE FROM auto WHERE auto.id = ?");
    $status = $query->execute([$id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
}
