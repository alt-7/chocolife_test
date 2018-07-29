<?php

namespace application\service;
class Parser {
    private $rows;

    public function __construct($filePath)
    {
        $data = file_get_contents($filePath);
        $rows = $this->parse($data);

        $this->rows = $rows;
    }

    private function parse($data) {
        $arr = [];
        foreach(explode("\n", $data) as $row) {
            $arr[] = explode(";", $row);
        }
        return $arr;
    }

    public function getRows() {
        return $this->rows;
    }

}