<?php

require_once 'config/DataBase.php';

class EstadoCuenta{
   public $db;
   
   public function __construct() {
      $this->db = Database::connect();
   }
   public function EstadoCuenta() {
      $sql = "SELECT SUM(valor) as total , SUM(utilidad) AS utilidad, SUM(valorcuota) AS totalCuota FROM prestamos_cliente WHERE saldo > 0";
      $resl = $this->db->query($sql);
      return $resl;
   }
   public function TotalPrestamos() {
      $sql = "SELECT SUM(valor) as total , SUM(utilidad) AS utilidad FROM prestamos_cliente WHERE saldo = 0";
      $resl = $this->db->query($sql);
      return $resl;
   }
}
