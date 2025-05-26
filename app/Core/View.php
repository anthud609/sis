<?php
// app/Core/View.php
class View {
    public static function render($path, $data = []) {
        extract($data);
        $viewFile = VIEW_PATH . "/$path.php";
        require LAYOUT_PATH . '/header.php';
        require $viewFile;
        require LAYOUT_PATH . '/footer.php';
    }
}
