document.addEventListener('DOMContentLoaded', function() {
    // Focus on the add item input field on page load
    document.getElementById('newItem').focus();

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

    // Handle item name editing
    document.querySelectorAll('.item-name').forEach(itemName => {
        itemName.addEventListener('click', function() {
            if (!this.classList.contains('editing')) {
                startEditing(this);
            }
        });
    });

    function startEditing(element) {
        const currentName = element.dataset.name;
        const id = element.dataset.id;
        
        // Create input field
        const input = document.createElement('input');
        input.type = 'text';
        input.value = currentName;
        input.className = 'edit-input';
        
        // Add editing class and replace content
        element.classList.add('editing');
        element.innerHTML = '';
        element.appendChild(input);
        
        // Focus and select text
        input.focus();
        input.select();
        
        // Handle save on Enter or blur
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                saveEdit(element, input.value, id);
            } else if (e.key === 'Escape') {
                cancelEdit(element, currentName);
            }
        });
        
        input.addEventListener('blur', function() {
            saveEdit(element, input.value, id);
        });
    }
    
    function saveEdit(element, newName, id) {
        const trimmedName = newName.trim();
        if (trimmedName && trimmedName !== element.dataset.name) {
            postAction('update', { id: id, name: trimmedName });
        } else {
            cancelEdit(element, element.dataset.name);
        }
    }
    
    function cancelEdit(element, originalName) {
        element.classList.remove('editing');
        element.innerHTML = originalName;
    }

});