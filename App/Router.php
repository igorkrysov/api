<?php

namespace App;

use App\Controllers\CheckListController;

final class Router {

    public static function route() {
        $url = $_SERVER["REQUEST_URI"];
        $params = explode('/', $url);
        // var_dump($params);

        $alias = isset($params[2]) ? $params[2] : null;

        switch($alias) {
            case 'checklist': 
                $checklist = new CheckListController();
                $checklist->index();
                break;
            default: 
                echo "Page is not exits!";
                break;
        }       
    }
}