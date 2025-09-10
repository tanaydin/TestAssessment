document.addEventListener('DOMContentLoaded', function() {

    function postAction(action, data = {}) {
        const formData = new FormData();
        formData.append('action', action);
        Object.entries(data).forEach(([key, value]) => formData.append(key, value));
        return fetch('index.php', {
            method: 'POST',
            body: formData
        }).then(() => {
            location.reload();
        });
    }

    function getItemIdFromElement(element) {
        return element?.dataset?.id || element?.closest('.item')?.querySelector('.delete-item')?.dataset?.id;
    }

    function addItem() {
        const input = document.getElementById('newItem');
        const itemName = input.value.trim();
        
        if (itemName) {
            postAction('add', { name: itemName });
            
            input.value = '';
        }
    }
    
    // Allow adding items with Enter key
    document.getElementById('newItem').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            addItem();
        }
    });

    function deleteItem(id) {
        postAction('delete', { id });
    }

    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function() {
            deleteItem(this.dataset.id);
        });
    });

    // Handle checkbox toggle
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const id = getItemIdFromElement(this);
            if (id) {
                postAction('toggle', { id });
            }
        });
    });

    document.getElementById('addItem').addEventListener('click', addItem);

});