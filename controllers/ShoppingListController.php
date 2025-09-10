<?php

require_once 'models/item.php';
require_once 'BaseController.php';

class ShoppingListController extends BaseController {
    
    public function index() {
        // Get all items from the model
        $items = Item::getAll();
        
        // Include the view
        $this->view('views/shopping_list.php', ['items' => $items]);
    }
    
    public function addItem($name) {
        if (!empty(trim($name))) {
            $item = new Item(null, trim($name), false);
            $item->save();
        }
        
        // Redirect back to index to prevent duplicate submissions
        $this->redirect($this->getBaseUrl());
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
        $this->redirect($this->getBaseUrl());
    }
    
    public function deleteItem($id) {
        Item::delete($id);
        
        // Redirect back to index
        $this->redirect($this->getBaseUrl());
    }
    
    public function updateItem($id, $name) {
        if (!empty(trim($name))) {
            $items = Item::getAll();
            foreach ($items as $item) {
                if ($item->id == $id) {
                    $item->name = trim($name);
                    $item->save();
                    break;
                }
            }
        }
        
        // Redirect back to index
        $this->redirect($this->getBaseUrl());
    }
}
