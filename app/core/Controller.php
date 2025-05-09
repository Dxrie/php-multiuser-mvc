<?php
namespace App\Core;

class Controller
{
    /**
     * @param mixed $view
     * @param mixed $data
     */
    public function view($view, $data = []): void
    {
        require_once BASE_PATH . "/views/" . $view . ".php";
    }

    public function model($model)
    {
        require_once BASE_PATH . "/models/" . $model . ".php";

        return new $model();
    }
}
