document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.getElementById('taskInput');
    const addTaskBtn = document.getElementById('addTaskBtn');
    const taskList = document.getElementById('taskList');
    const filter = document.getElementById('filter');
    const menuIcon = document.querySelector('.menu-icon');
    const editModal = document.getElementById('editModal');
    const editTaskInput = document.getElementById('editTaskInput');
    const saveEditBtn = document.getElementById('saveEditBtn');
    const closeModal = document.querySelector('.close');

    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    let currentEditIndex = null; //track sa edited

    // Function sa tasks
    function renderTasks() {
        taskList.innerHTML = '';
        tasks.forEach((task, index) => {
            if (filter.value === 'completed' && !task.completed) return;
            if (filter.value === 'pending' && task.completed) return;

            const li = document.createElement('li');
            li.textContent = task.text;
            li.className = task.completed ? 'completed' : '';
            li.setAttribute('data-index', index);

            // Create remove button
            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'Remove';
            removeBtn.className = 'remove-btn';
            removeBtn.addEventListener('click', () => {
                tasks.splice(index, 1);
                saveTasks();
                renderTasks();
            });

            // Add event listeners for task completion and removal
            li.addEventListener('click', () => {
                tasks[index].completed = !tasks[index].completed;
                saveTasks();
                renderTasks();
            });

            // edit button
            const editBtn = document.createElement('button');
            editBtn.textContent = 'Edit';
            editBtn.className = 'edit-btn';
            editBtn.addEventListener('click', () => {
                currentEditIndex = index; // Set para sa index for task being edited
                editTaskInput.value = task.text; 
                editModal.style.display = 'block'; // Show the modal
            });
            
            li.appendChild(editBtn);
            li.appendChild(removeBtn);
            taskList.appendChild(li);
        });
    }

    // save tasks sa local storage
    function saveTasks() {
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    function addTask() {
        const taskText = taskInput.value.trim();
        if (taskText) {
            tasks.push({ text: taskText, completed: false });
            taskInput.value = '';
            saveTasks();
            renderTasks();
        }
    }

    // Event listener sa saving edits
    saveEditBtn.addEventListener('click', () => {
        if (currentEditIndex !== null) {
            const newTaskText = editTaskInput.value.trim();
            if (newTaskText !== '') {
                tasks[currentEditIndex].text = newTaskText; // Update sa task text
                saveTasks();
                renderTasks();
                editModal.style.display = 'none'; // Hide for modal haman sa saving
                currentEditIndex = null; // Reset the edit index
            }
        }
    });

    // Event listener for closing the modal
    closeModal.addEventListener('click', () => {
        editModal.style.display = 'none'; // Hide the modal
        currentEditIndex = null; // Reset the edit index
    });

    addTaskBtn.addEventListener('click', addTask);
    filter.addEventListener('change', renderTasks);
    menuIcon.addEventListener('click', () => {
        const menu = document.querySelector('.header');
        menu.classList.toggle('visible');
    });


    addTaskBtn.addEventListener('click', addTask);


    filter.addEventListener('change', renderTasks);

    menuIcon.addEventListener('click', () => {
        const menu = document.querySelector('.header');
        menu.classList.toggle('visible');
    });

    ditTaskInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && event.shiftKey) {
            saveEditBtn.click();
        }
        });

        editTaskInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                saveEditBtn.click(); 
            }
        });
    renderTasks();
});