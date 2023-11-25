document.addEventListener('DOMContentLoaded', function () {
  const selectElements = document.querySelectorAll('.input-project');

  selectElements.forEach((select) => {
      select.addEventListener('change', (event) => {
          let selectedValue = event.target.value;
          const taskCard = event.target.closest('.task-card');
          const kanbanBoard = document.querySelector('.kanban-board');
          const cardId = taskCard.id;
          taskCard.remove();
          kanbanBoard.querySelector(`.${selectedValue}`).appendChild(taskCard);

          // Convert selectedValue
          switch(selectedValue) {
            case 'toDo':
              selectedValue = 'por hacer';
              break;
            case 'doing':
              selectedValue = 'en curso';
              break;
            case 'done':
              selectedValue = 'listo';
              break;
          }

          // Fetch request
          const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          fetch(`/changeStateTask/${selectedValue}/${cardId}`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-Token": token,
            },
            body: JSON.stringify({estado: selectedValue}),
          })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              console.log(data.message);
            }
          })
          .catch((error) => console.error("Error:", error));
      });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const taskCards = document.querySelectorAll('.task-card');

  taskCards.forEach((card) => {
      const header = card.querySelector('.header-task');
      const content = card.querySelector('.task-content');

      header.addEventListener('click', () => {
          content.classList.toggle('collapsed');
      });
  });
});