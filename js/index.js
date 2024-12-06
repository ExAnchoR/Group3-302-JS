const toDoInput = document.getElementById('toDoInput');
        const toDoList = document.getElementById('toDoList');

        toDoInput.addEventListener('keyup', (event) => {
            if (event.key === 'Enter') {
                const toDoText = toDoInput.value.trim();
                if (toDoText !== '') {
                    const newToDo = document.createElement('li');
                    newToDo.textContent = toDoText;
                    toDoList.appendChild(newToDo);
                    toDoInput.value = '';
                }
            }
        });
