<?php

class ConnectionDB {

    private $motor;
    private $user;
    private $pass;
    private $host;
    private $db;
    private $pdo;
    
    public static $MNG_PG = "PG";
    public static $MNG_MS = "MS";

//    private function connectMySQL() {
//
//        $this->motor = 'mysql';
//        $this->user = 'linux';
//        $this->pass = 'mundolinux';
//        $this->host = '190.14.247.68';
//        $this->db = 'Narino_personas';
//    }

    private function connectPostgreSQL() {

        $this->motor = 'pgsql';
        $this->user = 'postgres';
        $this->pass = 'bpid2017';
        $this->host = '192.168.1.111';
        $this->db = 'celab';
    }

    private function connect($manager) {
        
        if ($manager === self::$MNG_MS)
            $this->connectMySQL();
        else if ($manager === self::$MNG_PG)
            $this->connectPostgreSQL();

        try {

            $this->pdo = new PDO("$this->motor:host=$this->host;dbname=$this->db;", $this->user, $this->pass);
            $this->pdo->query("SET NAMES 'utf8'");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return 'Error connection: ' . $e->getMessage();
        }
    }

    public function consult($manager, $sql) {

        $this->connect($manager);        
        $rt = null;

        try {

            $query = $this->pdo->prepare($sql);
            $query->execute();
            $rt = $query;
        } catch (PDOException $e) {
            return $e->getMessage() . ", " . $sql;
        }
        
        $this->closeConnection();

        return $rt;
    }

    public function afect($manager,$sql) {

        $this->connect($manager);    
        $res = 0;

        try {

            $this->pdo->exec($sql);
            $res = 1;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        $this->closeConnection();
        
        return $res;
    }

    private function closeConnection() {

        $this->pdo = null;
        
    }

}

?>