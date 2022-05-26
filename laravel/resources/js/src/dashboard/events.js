import axios from 'axios';
//Change input text when file was choosen
let imageUploadInput = document.querySelector('.dashboard__file-input input');
let imageUploadSpan = document.querySelector('.dashboard__file-input span');
imageUploadInput.addEventListener('change', () => {
    let fileName = imageUploadInput.files[0].name;
    imageUploadSpan.textContent = fileName;
});

//Delete account message with confirmation
let deleteAccountBtn = document.querySelector('.delete-account-button');
let form = deleteAccountBtn.parentElement;

deleteAccountBtn.addEventListener('click', printAccountDeletingBox);

function printAccountDeletingBox() {
    form.removeChild(deleteAccountBtn);
    form.innerHTML += 
        `<div class="delete-confirmation-box">
            <div class="error-text">
                Please confirm (all of your data will be deleted)
            </div>
            <button type="submit" class="dashboard__delete-button">
                Confirm
            </button>
            <button type="button" class="dashboard__button cancel-button">
                Cancel 
            </button>
        </div>`;

    // Print back delete button with event listener
    let cancelButton = form.querySelector('.cancel-button');
    cancelButton.addEventListener('click', () => {
        form.removeChild(form.querySelector('.delete-confirmation-box'));
        form.innerHTML += 
            `<button type="button" class="dashboard__button delete-account-button">
                Delete account
            </button>`;
        deleteAccountBtn = form.querySelector('.delete-account-button');
        deleteAccountBtn.addEventListener('click', printAccountDeletingBox);
    });
}

//Edit name
let editNameBtn = document.querySelector('.edit-name-button');
editNameBtn.addEventListener('click', printNameEditBox);

function printNameEditBox() {
   let inputBox = editNameBtn.parentNode;
   inputBox.removeChild(editNameBtn);
   let nameSpan = inputBox.querySelector('.dashboard__input');
   let name = nameSpan.textContent.trim();
   inputBox.removeChild(nameSpan);

   inputBox.innerHTML += 
        `<input type="text" name="name" class="dashboard__input">
        <div class="dashboard__edit-box">
            <button type="button" class="dashboard__edit-button confirm-edit-name-button">
                Edit
            </button>
            <button type="button" class="dashboard__edit-button cancel-button">
                Cancel
            </button>
        </div>`;
    let nameInput = inputBox.querySelector('.dashboard__input');
    nameInput.focus();

    //Cancel editting name
    inputBox.querySelector('.cancel-button').addEventListener('click', () => {
        cancelEditingName(name, inputBox, 'name');
    });

    //Confirm editting name
    inputBox.querySelector('.confirm-edit-name-button').addEventListener('click', () => {
        editName(nameInput, name);
    });
}

function editName(nameInput, oldName) {
    let name = nameInput.value;
    let inputBox = nameInput.parentNode;
    let inputsWrapper = inputBox.parentNode;
    let messages = {
        0: 'Something went wrong',
        1: 'Name changed successfully',
        2: 'Name already exists'
    }

    if (name.length < 3) {
        printErrorDiv('Name has to have at least 3 characters');
    } else if (name == oldName) {
        printErrorDiv('Name has to be different than old name');
    } else {
        let token = document
            .querySelector('meta[name=csrf-token]')
            .getAttribute('content');

        let config = {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
        };
        axios
            .patch('/dashboard/name', { name: name }, config)
            .then(response => {
                let status = response['data'] ['status'];
                if(status != 1) {
                    printErrorDiv(messages[status]);
                } else {
                    cancelEditingName(name, inputBox);
                    printMessage(messages[status]);
                }
            })
    }

    function printErrorDiv(message) {
        if (inputsWrapper.querySelector('.name-error')) {
            inputsWrapper.removeChild(inputsWrapper.querySelector('.name-error'));
        }
        let errorDiv = document.createElement('div');
        errorDiv.className = 'error-text name-error';
        errorDiv.textContent = message;
        nameInput.classList.add('error-input');
        inputsWrapper.insertBefore(errorDiv, inputBox);
    }

}

function cancelEditingName(name, inputBox) {
    inputBox.removeChild(inputBox.querySelector('input'));
    inputBox.removeChild(inputBox.querySelector('.dashboard__edit-box'));
    inputBox.innerHTML += 
        `<span class="dashboard__input">
            ${name}
        </span>
        <button type="button" class="dashboard__edit-button edit-name-button">
            Edit
        </button>`;
    
    editNameBtn = inputBox.querySelector('.edit-name-button');

    let errorDiv = inputBox.parentNode.querySelector('.name-error');
    if (errorDiv) {
        inputBox.parentNode.removeChild(errorDiv);
    }
    editNameBtn.addEventListener('click', printNameEditBox);

}


//Edit password 


function printMessage(message) {
    let body = document.querySelector('body');
    let div = document.createElement('div');
    div.className = 'pop-up';
    div.innerHTML = `<div>${message}</div>`
    body.appendChild(div);

    setTimeout(() => {
        body.removeChild(div);
    }, 3000);
}
