<?php
require_once 'models/item.php';

// Sample test data
$testItems = [
    ['name' => 'Milk', 'completed' => false],
    ['name' => 'Eggs', 'completed' => false],
    ['name' => 'Bread', 'completed' => true],
    ['name' => 'Butter', 'completed' => false],
    ['name' => 'Apples', 'completed' => false],
    ['name' => 'Cheese', 'completed' => true]
];

echo "Inserting test data...\n";

foreach ($testItems as $itemData) {
    $item = new Item(null, $itemData['name'], $itemData['completed']);
    if ($item->save()) {
        echo "✓ Inserted: {$itemData['name']} (ID: {$item->id})\n";
    } else {
        echo "✗ Failed to insert: {$itemData['name']}\n";
    }
}

echo "\nTest data insertion completed!\n";
echo "You can now view the items in your shopping list.\n";
?>
