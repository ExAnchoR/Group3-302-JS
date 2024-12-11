document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.getElementById('taskInput');
    const addTaskBtn = document.getElementById('addTask');
    const taskList = document.getElementById('taskList');
    const filterBtns = document.querySelectorAll('.filter-btn');

    // local storages
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

    // render task list
    function renderTasks() {
        taskList.innerHTML = '';
        tasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.innerHTML = `
                <span>${task.text}</span>
                <div>
                    <button onclick="toggleComplete(${index})">Toggle</button>
                    <button onclick="deleteTask(${index})">Delete</button>
                </div>
            `;
            taskList.appendChild(li);
        });
        saveTasks();
    }
    // add task
    function addTask() {
        const text = taskInput.value.trim();
        if (text) {
            tasks.push({ text, completed: false });
            taskInput.value = '';
            renderTasks();
        }
    }

    // conplete task
    window.toggleComplete = (index) => {
        tasks[index].completed = !tasks[index].completed;
        renderTasks();
    };

    // delete task
    window.deleteTask = (index) => {
        const li = taskList.children[index];
        li.classList.add('removing');
        li.addEventListener('animationend', () => {
            tasks.splice(index, 1);
            renderTasks();
        });
    };

    // save tasks
    function saveTasks() {
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    // filter tasks
    function filterTasks(filter) {
        const filteredTasks = tasks.filter(task => {
            if (filter === 'all') return true;
            if (filter === 'completed') return task.completed;
            if (filter === 'pending') return !task.completed;
        });
        renderFilteredTasks(filteredTasks);
    }

    // render the filter
    function renderFilteredTasks(filteredTasks) {
        taskList.innerHTML = '';
        filteredTasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.innerHTML = `
                <span>${task.text}</span>
                <div>
                    <button onclick="toggleComplete(${tasks.indexOf(task)})">Toggle</button>
                    <button onclick="deleteTask(${tasks.indexOf(task)})">Delete</button>
                </div>
            `;
            taskList.appendChild(li);
        });
    }

    // event listeners
    addTaskBtn.addEventListener('click', addTask);
    taskInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') addTask();
    });

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterTasks(btn.dataset.filter);
        });
    });
    // render task list (idk why i do this it just works)
    function renderTasks() {
        taskList.innerHTML = '';
        tasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.innerHTML = `
                <span>${task.text}</span>
                <div>
                    <button onclick="editTask(${index})">Edit</button>
                    <button onclick="toggleComplete(${index})">Toggle</button>
                    <button onclick="deleteTask(${index})">Delete</button>
                </div>
            `;
            taskList.appendChild(li);
        });
        saveTasks();
    }
    
    // render the filter (this one to idk why)
    function renderFilteredTasks(filteredTasks) {
        taskList.innerHTML = '';
        filteredTasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.innerHTML = `
                <span>${task.text}</span>
                <div>
                    <button onclick="editTask(${tasks.indexOf(task)})">Edit</button>
                    <button onclick="toggleComplete(${tasks.indexOf(task)})">Toggle</button>
                    <button onclick="deleteTask(${tasks.indexOf(task)})">Delete</button>
                </div>
            `;
            taskList.appendChild(li);
        });
    }
    
    // edit tasks
    window.editTask = (index) => {
        const li = taskList.children[index];
        const span = li.querySelector('span');
        const text = span.textContent;
        
        span.innerHTML = `<input type="text" value="${text}">`;
        const input = span.querySelector('input');
        input.focus();
        
        input.addEventListener('blur', function() {
            const newText = this.value.trim();
            if (newText && newText !== text) {
                tasks[index].text = newText;
                renderTasks();
            } else {
                span.textContent = text;
            }
        });
        
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.blur();
            }
        });
    };
    // render tasks
    window.toggleComplete = (index) => {
        tasks[index].completed = !tasks[index].completed;
        renderTasks();
    };
    
    // delete tasks
    window.deleteTask = (index) => {
        const li = taskList.children[index];
        li.classList.add('removing');
        li.addEventListener('animationend', () => {
            tasks.splice(index, 1);
            renderTasks();
        });
    };

    renderTasks();
});