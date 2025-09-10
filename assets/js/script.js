document.addEventListener('DOMContentLoaded', function() {

    function addItem() {
        const input = document.getElementById('newItem');
        const itemName = input.value.trim();
        
        if (itemName) {
            // In a real application, this would make an AJAX request
            // For now, we'll just show an alert
            alert('Item "' + itemName + '" would be added to the list!');
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
        fetch(`/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        });
    }

    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function() {
            deleteItem(this.dataset.id);
        });
    });

    document.getElementById('addItem').addEventListener('click', addItem);

});