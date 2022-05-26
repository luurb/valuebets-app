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
    form.innerHTML += `<div class="delete-confirmation-box">
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
        form.innerHTML += `<button type="button" class="dashboard__button delete-account-button">
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

    inputBox.innerHTML += `<input type="text" name="name" class="dashboard__input">
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
    inputBox
        .querySelector('.confirm-edit-name-button')
        .addEventListener('click', () => {
            editName(nameInput, name);
        });
}

function editName(nameInput, oldName) {
    let name = nameInput.value;
    let inputBox = nameInput.parentNode;
    let inputsWrapper = inputBox.parentNode;
    let messages = {
        0: 'Something went wrong. Try again later',
        1: 'Name changed successfully',
        2: 'Name already exists',
    };

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
            .then((response) => {
                let status = response['data']['status'];
                if (status != 1) {
                    printErrorDiv(messages[status]);
                } else {
                    cancelEditingName(name, inputBox);
                    printMessage(messages[status]);
                }
            })
            .catch((e) => {
                printMessage('Something went wrong');
            });
    }

    function printErrorDiv(message) {
        if (inputsWrapper.querySelector('.name-error')) {
            inputsWrapper.removeChild(
                inputsWrapper.querySelector('.name-error')
            );
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
    inputBox.innerHTML += `<span class="dashboard__input">
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
let editPassBtn = document.querySelector('.edit-pass-button');
editPassBtn.addEventListener('click', () => {
    printPasswordEditBox(editPassBtn.parentNode);
});

function printPasswordEditBox(inputBox) {
    inputBox.innerHTML = `<div class="dashboard__account-inputs">
            <div class="dashboard__account-input-box">
                <span class="dashboard__input-name">
                    Password:
                </span>
                <input type="password" name="password" class="dashboard__input">
            </div>
            <div class="dashboard__account-input-box">
                <span class="dashboard__input-name">
                    New password:
                </span>
                <input type="password" name="new_password" class="dashboard__input">
            </div>
            <div class="dashboard__account-input-box">
                <span class="dashboard__input-name">
                    Confirm password:
                </span>
                <input type="password" name="confirm_password" class="dashboard__input">
            </div>
            <div class="dashboard__account-input-box">
                <div class="dashboard__password-edit-box ">
                    <button class="dashboard__edit-button confirm-edit-pass-button">
                        Edit
                    </button>
                    <button class="dashboard__edit-button cancel-pass-button margin-l-10">
                        Cancel 
                    </button>
                </div>
            </div>
        </div>`;
    inputBox.querySelector('input[name="password"]').focus();

    //Confirm password changing
    inputBox
        .querySelector('.confirm-edit-pass-button')
        .addEventListener('click', () => {
            editPassword(inputBox);
        });

    //Cancel password changing
    inputBox
        .querySelector('.cancel-pass-button')
        .addEventListener('click', () => {
            cancelEditingPassword(inputBox);
        });
}

function cancelEditingPassword(inputBox) {
    inputBox.innerHTML = `<span class="dashboard__input-name">
        Password:
    </span>
    <span class="dashboard__input">******</span>
    <button class="dashboard__edit-button edit-pass-button">
        Edit
    </button>`;

    inputBox
        .querySelector('.edit-pass-button')
        .addEventListener('click', () => {
            printPasswordEditBox(inputBox);
        });
}

function editPassword(inputBox) {
    let passwordInputs = inputBox.querySelectorAll('input');
    let password = inputBox.querySelector('input[name="password"]').value;
    let newPassword = inputBox.querySelector(
        'input[name="new_password"]'
    ).value;
    let confirmPassword = inputBox.querySelector(
        'input[name="confirm_password"]'
    ).value;
    console.log(newPassword, confirmPassword);
    let checkCredentials = 0;
    let messages = {
        0: 'Something went wrong. Try again later',
        1: 'Password changed successfully',
        2: 'Incorrect password',
    };

    for (let input of passwordInputs) {
        checkCredentials = 0;
        let passLength = input.value.length;
        if (passLength == 0) {
            printErrorDiv('Please fill all fields');
            break;
        }

        if (passLength < 6) {
            printErrorDiv('Password has to contain at least 6 characters');
            break;
        }

        if (newPassword != confirmPassword) {
            printErrorDiv(
                'Confirmed password has to be the same as new password'
            );
            break;
        }

        checkCredentials = 1;
    }

    if (checkCredentials != 0) {
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
            .patch(
                '/dashboard/password',
                {
                    password: password,
                    newPassword: newPassword,
                },
                config
            )
            .then((response) => {
                let status = response['data']['status'];
                if (status != 2) {
                    cancelEditingPassword(inputBox);
                    printMessage(messages[status]);
                } else {
                    printErrorDiv(messages[status]);
                }
            })
            .catch((e) => {
                printMessage(messages[0]);
            });
    }

    function printErrorDiv(message) {
        if (inputBox.querySelector('.pass-error')) {
            inputBox.firstChild.removeChild(
                inputBox.querySelector('.pass-error')
            );
        }
        let errorDiv = document.createElement('div');
        errorDiv.className = 'error-text pass-error';
        errorDiv.textContent = message;
        inputBox.firstChild.insertBefore(
            errorDiv,
            inputBox.firstChild.firstChild
        );
    }
}

function printMessage(message) {
    let body = document.querySelector('body');
    let div = document.createElement('div');
    div.className = 'pop-up';
    div.innerHTML = `<div>${message}</div>`;
    body.appendChild(div);

    setTimeout(() => {
        body.removeChild(div);
    }, 3000);
}
