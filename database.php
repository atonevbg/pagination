<?php

class Database {

    private $host = 'localhost';
    private $db_name = 'mytest';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConenction() {

        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->db_name . '', $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }

        return $this->conn;
    }

    public function getNames($iOffset, $iLimit) {
        $conn = $this->getConenction();

        $sSQL = 'SELECT SQL_CALC_FOUND_ROWS * FROM mytest LIMIT ' . $iOffset . ', ' . $iLimit . '';
        $sth = $conn->prepare($sSQL);
        $sth->execute();
        $result['names'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        $query = 'SELECT FOUND_ROWS() as total';
        $sth1 = $conn->prepare($query);
        $sth1->execute();
        $result['count'] = $sth1->fetchColumn();

        return $result;
    }

}
