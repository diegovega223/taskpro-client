var deleteButtons = document.querySelectorAll('.delete-btn');
var modal = document.getElementById('deleteModal');
var confirmDeleteButton = document.getElementById('confirmDelete');
var cancelButton = document.getElementById('cancelButton');

deleteButtons.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        var projectId = this.getAttribute('data-id');
        confirmDeleteButton.href = '/delete-project/' + projectId;
        modal.style.display = "flex";
    });
});

cancelButton.addEventListener('click', function() {
    modal.style.display = "none";
});

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};