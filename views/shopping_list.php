<?php include 'layouts/header.php'; ?>
        
        <?php if (empty($items)): ?>
            <div class="empty-state">
                Your shopping list is empty. Add some items below!
            </div>
        <?php else: ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($items as $item): ?>
                    <li style="display: flex;" class="item <?php echo $item->completed ? 'completed' : ''; ?>">
                        <input type="checkbox" <?php echo $item->completed ? 'checked' : ''; ?>>
                        <?php echo htmlspecialchars($item->name); ?>
                        <button class="delete-item" data-id="<?php echo $item->id; ?>" style="margin-left: auto;">X</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <div class="add-item">
            <input type="text" placeholder="Add new item..." id="newItem">
            <button id="addItem">Add Item</button>
        </div>

<?php include 'layouts/footer.php'; ?>
