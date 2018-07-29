<?php

namespace application\service;

class Translater {

    private $letters;

    public function __construct() {
        $this->letters = require 'application/config/translate.php';
    }

    public function translate($word) {
        $lowercaseword = mb_strtolower($word);
        $lowercaseword = preg_replace("/\.|\?|\!|(\.\.\.)|\,|\;|\:|\-|\(|\)|\"|\s/U", "-",$lowercaseword); // знаки препинания и пробел
        $lowercaseword = preg_replace("/-{2,}/", "-", $lowercaseword); //убираем от двух - до одного
        $lowercaseword = trim($lowercaseword, "-"); // убираем с начало и конца -
        foreach($this->letters as $cyrillic=>$latinica) {
            $lowercaseword = str_replace($cyrillic, $latinica, $lowercaseword);
        }
        return $lowercaseword;
    }

}