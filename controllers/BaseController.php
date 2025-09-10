<?php

require_once 'views/BaseView.php';

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
     * Include a view file using BaseView
     * 
     * @param string $view The view file to include
     * @param array $data Optional data to pass to the view
     */
    protected function view($view, $data = []) {
        $baseView = new BaseView($data);
        $baseView->renderWithLayout($view);
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
