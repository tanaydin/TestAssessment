<?php
require_once 'models/item.php';

$items = Item::getAll();
?>

<html>

<body>
    <h1>Shopping List</h1>
    <ul>
        <?php foreach ($items as $item): ?>
            <li>
                <input type="checkbox" <?php echo $item->completed ? 'checked' : ''; ?>>
                <?php echo htmlspecialchars($item->name); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <input type="text" placeholder="Add Item">
    <button>Add Item</button>
</body>

</html>