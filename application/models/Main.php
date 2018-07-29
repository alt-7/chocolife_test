<?php

namespace application\models;

use application\core\Model;
use application\service\Parser;

class Main extends Model {

    protected $table = 'csv';

    public function getData() {
        $result = $this->db->row('SELECT * FROM csv');
        return $result;
    }

    public function createTable() {
        $result = $this->db->create($this->table);
        return $result;
    }

    public function uploadCsv() {
        $parser = new Parser('file.csv');
        foreach ($parser->getRows() as $key => $row) {
            $result = "INSERT into csv (id, name, start_date, end_date, status)
                        values ('".$row[0]."','".$row[1]."','".strtotime($row[2])."','".strtotime($row[3])."','".$row[4]."')";
            $result = $this->db->insertData($result);
        }

        if(!isset($result))
        {
            echo "Неверный файл: загрузите файл CSV.";
        }
        else {
            echo "Файл CSV был успешно импортирован.";
        }
    }
}

