<?php
namespace App\Core;

class Controller
{
    protected function render($module, $view, $data = [])
    {
        extract($data);
        $viewPath = VIEW_PATH . "/$module/Views/$view.php";
        require LAYOUT_PATH . '/header.php';
        require $viewPath;
        require LAYOUT_PATH . '/footer.php';
    }
}
