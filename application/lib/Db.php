<?php

namespace application\lib;

use PDO;

class Db {

    //protected $db;

    public function __construct() {
        $config = require 'application/config/db.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
    }

    public function create($table) {
        $sql_create_csv_tbl = <<<EOSQL
            CREATE TABLE $table (
              id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, 
                    name VARCHAR( 250 ) NOT NULL, 
                    start_date INT(11) NOT NULL, 
                    end_date INT(11) NOT NULL,
                    status VARCHAR(10) NOT NULL
            ) ENGINE=InnoDB
EOSQL;

        $createTable = $this->db->exec($sql_create_csv_tbl);

        if ($createTable !== false)
        {
            echo "Таблица $table - создана!<br /><br />";
        }else {
            echo "Таблица $table уже существует! <br /><br />";
        }
    }

    public function insertData($sql) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function query($sql, $params = []) {
        $result = $this->db->prepare($sql);
        if(!empty($params)) {
            foreach ($params as $key => $val) {
                $result->bindValue(':'.$key, $val);
            }
        }

        $result->execute();
        return $result;

    }

    public function row($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}