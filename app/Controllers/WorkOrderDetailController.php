<?php

namespace App\Controllers;

use Db\PDO\Connection;

class WorkOrderDetailController
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
    $query = $this->connection->prepare("
      SELECT *
      FROM detalle_orden_de_trabajo 
      ");
    $query->execute();
    $res = $query->fetchAll(\PDO::FETCH_ASSOC);
    $json = json_encode($res);
    return $json;
  }
  /**
   * @return string|bool
   * @param mixed $id
   */
  public function getMultipleById($id): string|bool
  {
    $query = $this->connection->prepare("
      SELECT dot.id, est.nombre as estado, t.nombre as trabajador, dot.trabajo, dot.valor, dot.tiempo 
      FROM detalle_orden_de_trabajo as dot
      INNER JOIN estado as est 
      ON est.id = dot.id_estado
      INNER JOIN trabajador as t
      ON t.id = dot.id_trabajador 
      WHERE dot.id_orden = ?
      ");
    $query->execute([$id]);
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
    $query = $this->connection->prepare("SELECT * FROM detalle_orden_de_trabajo WHERE id = ?");
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
    $query = $this->connection->prepare("
      INSERT INTO detalle_orden_de_trabajo
      (id_orden, id_auto, id_trabajador, id_estado, direccion, trabajo, tiempo, valor)
      VALUES(?, ?, ?, ?, (SELECT p.dirección FROM auto as a JOIN persona as p ON p.id = a.id_persona LIMIT 1), ?, ?, ?); 
      ");
    $status = $query->execute(
      [
        $p["id_orden"],
        $p["id_auto"],
        $p["id_trabajador"],
        $p["id_estado"],
        $p["trabajo"],
        $p["tiempo"],
        $p["valor"],
      ]
    );
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
    $query = $this->connection->prepare("
      UPDATE detalle_orden_de_trabajo
      SET id_orden = ?, id_auto = ?, id_trabajador = ?, id_estado = ?, direccion = ?, trabajo = ?, tiempo = ?, valor = ?
      WHERE id = ?;
      ");
    $status = $query->execute(
      [
        $p["id_orden"],
        $p["id_auto"],
        $p["id_trabajador"],
        $p["id_estado"],
        $p["direccion"],
        $p["trabajo"],
        $p["tiempo"],
        $p["valor"],
        $id
      ]
    );
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
    $query = $this->connection->prepare("DELETE FROM detalle_orden_de_trabajo WHERE id = ?");
    $status = $query->execute([$id]);
    $res = [
      "success" => $status,
      "rows_affected" => $query->rowCount()
    ];
    return $res;
  }
}
