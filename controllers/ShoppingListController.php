<?php

require_once 'models/item.php';

class ShoppingListController {
    
    public function index() {
        // Get all items from the model
        $items = Item::getAll();
        
        // Include the view
        include 'views/shopping_list.php';
    }
    
    public function addItem($name) {
        if (!empty(trim($name))) {
            $item = new Item(null, trim($name), false);
            $item->save();
        }
        
        // Redirect back to index to prevent duplicate submissions
        header('Location: ../index.php');
        exit;
    }
    
    public function toggleItem($id) {
        $items = Item::getAll();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $item->completed = !$item->completed;
                $item->save();
                break;
            }
        }
        
        // Redirect back to index
        header('Location: ../index.php');
        exit;
    }
    
    public function deleteItem($id) {
        Item::delete($id);
        
        // Redirect back to index
        header('Location: ../index.php');
        exit;
    }
}
