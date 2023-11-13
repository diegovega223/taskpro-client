document.addEventListener('DOMContentLoaded', function () {
  const selectElements = document.querySelectorAll('.input-project');

  selectElements.forEach((select) => {
      select.addEventListener('change', (event) => {
          const selectedValue = event.target.value;
          const taskCard = event.target.closest('.task-card');
          const kanbanBoard = document.querySelector('.kanban-board');
          const cardId = taskCard.id;
          taskCard.remove();
          kanbanBoard.querySelector(`.${selectedValue}`).appendChild(taskCard);
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