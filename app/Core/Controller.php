<?php
namespace App\Core;

class Controller 
{
    protected function render($module, $view, $data = [])
    {
        // Start output buffering to capture the view content
        ob_start();
        
        // Extract data to make variables available in the view
        extract($data);
        
        // Include the specific view file
        $viewFile = __DIR__ . "/../Modules/{$module}/Views/{$view}.php";
        if (file_exists($viewFile)) {
            include $viewFile;
        }
        
        // Get the view content
        $content = ob_get_clean();
        
        // Add content to data for the layout
        $data['content'] = $content;
        
        // Extract data again for the layout
        extract($data);
        
        // Include the layout
        $layoutFile = __DIR__ . "/../Views/layout.php";
        if (file_exists($layoutFile)) {
            include $layoutFile;
        }
    }
}