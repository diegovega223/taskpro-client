document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('.add-task-button');
    const inputField = document.querySelector('.input-project[name="subtask-title"]');
    const subtaskList = document.querySelector('.subtask-box ol');

    button.addEventListener('click', function() {
        const inputValue = inputField.value.trim();
        
        if (inputValue) {
            const listItem = document.createElement('li');
            listItem.classList.add('subtask');
            listItem.textContent = inputValue;
            
            const closeButton = document.createElement('span');
            closeButton.classList.add('material-icons');
            closeButton.textContent = 'highlight_off';
            
            closeButton.addEventListener('click', function() {
                subtaskList.removeChild(listItem);
            });
            
            listItem.appendChild(closeButton);
            subtaskList.appendChild(listItem);

            inputField.value = '';
        }
    });
});
