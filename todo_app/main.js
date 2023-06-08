document.addEventListener("DOMContentLoaded", function() {
  const taskForm = document.getElementById("task-form");
  const taskInput = document.getElementById("task-input");
  const taskList = document.getElementById("task-list");

  function addTask(event) {
    event.preventDefault();

    const taskText = taskInput.value.trim();
    if (taskText !== "") {
      const status = document.querySelector('input[name="status"]:checked').value;

      const newTask = document.createElement("li");
      newTask.classList.add("task-item");
      newTask.innerHTML = `
        <span class="task-status ${status.toLowerCase()}">${status}</span>
        <span class="task-text">${taskText}</span>
        <button class="edit">Edit</button>
        <button class="update">Update</button>
        <button class="delete">Delete</button>
      `;

      taskList.appendChild(newTask);
      taskInput.value = "";


      const editButton = newTask.querySelector('.edit');
      const updateButton = newTask.querySelector('.update');
      const deleteButton = newTask.querySelector('.delete');

      editButton.addEventListener('click', function() {
        const textElement = newTask.querySelector('.task-text');
        const taskText = textElement.innerText;
        taskInput.value = taskText;
        taskList.removeChild(newTask);
      });

      updateButton.addEventListener('click', function() {
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
          const status = document.querySelector('input[name="status"]:checked').value;

          newTask.querySelector('.task-status').className = `task-status ${status.toLowerCase()}`;
          newTask.querySelector('.task-status').innerText = status;
          newTask.querySelector('.task-text').innerText = taskText;

          taskInput.value = "";
        }
      });

      deleteButton.addEventListener('click', function() {
        taskList.removeChild(newTask);
      });
    }
  }

  taskForm.addEventListener("submit", addTask);
});
