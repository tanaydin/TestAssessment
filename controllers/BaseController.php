<?php

class BaseController {
    
    /**
     * Redirect to a given URL
     * 
     * @param string $url The URL to redirect to
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
    
    /**
     * Include a view file
     * 
     * @param string $view The view file to include
     * @param array $data Optional data to pass to the view
     */
    protected function view($view, $data = []) {
        // Extract data array to variables for the view
        extract($data);
        
        // Include the view file
        include $view;
    }
    
    /**
     * Get the base URL for redirects
     * 
     * @return string The base URL
     */
    protected function getBaseUrl() {
        return '../index.php';
    }
}
