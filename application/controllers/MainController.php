<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;
use application\service\Parser;
use application\service\Translater;

class MainController extends Controller {

    public function indexAction(){
        $translate = new Translater();
        $this->model->createTable();
        $this->model->uploadCsv();

        $result = $this->model->getData();
        $vars = [
            'items' => $result,
            'translate' => $translate
        ];
        $this->view->render('Главная страница',$vars);
    }

}