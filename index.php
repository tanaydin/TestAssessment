<?php
require_once 'controllers/ShoppingListController.php';

$controller = new ShoppingListController();

// Handle different actions based on request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $controller->addItem($_POST['name'] ?? '');
                break;
            case 'toggle':
                $controller->toggleItem($_POST['id'] ?? '');
                break;
            case 'delete':
                $controller->deleteItem($_POST['id'] ?? '');
                break;
            case 'update':
                $controller->updateItem($_POST['id'] ?? '', $_POST['name'] ?? '');
                break;
        }
    }
} else {
    // Default action - show the shopping list
    $controller->index();
}
?>