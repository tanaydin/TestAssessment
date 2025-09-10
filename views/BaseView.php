<?php

class BaseView {
    protected $data = [];
    protected $pageTitle = 'Shopping List';
    
    public function __construct($data = []) {
        $this->data = $data;
    }
    
    public function setData($key, $value) {
        $this->data[$key] = $value;
    }
    
    public function getData($key, $default = null) {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }
    
    public function setPageTitle($title) {
        $this->pageTitle = $title;
    }
    
    public function getPageTitle() {
        return $this->pageTitle;
    }
    
    public function render($viewFile, $data = []) {
        // Merge additional data with existing data
        $viewData = array_merge($this->data, $data);
        
        // Extract data to variables for use in the view
        extract($viewData);
        
        // Set page title for header
        $pageTitle = $this->pageTitle;
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        include $viewFile;
        
        // Get the content and clean the buffer
        $content = ob_get_clean();
        
        return $content;
    }
    
    public function renderWithLayout($viewFile, $data = []) {
        // Set page title for header
        $pageTitle = $this->pageTitle;
        
        // Merge additional data with existing data
        $viewData = array_merge($this->data, $data);
        
        // Extract data to variables for use in the view
        extract($viewData);
        
        // Include header
        include 'layouts/header.php';
        
        // Include the main view content
        include $viewFile;
        
        // Include footer
        include 'layouts/footer.php';
    }
    
    public function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    
    public function redirect($url) {
        header("Location: $url");
        exit();
    }
}
