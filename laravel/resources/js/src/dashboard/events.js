//Change input text when file was choosen
let imageUploadInput = document.querySelector('.dashboard__file-input input');
let imageUploadSpan = document.querySelector('.dashboard__file-input span');
imageUploadInput.addEventListener('change', () => {
    let fileName = imageUploadInput.files[0].name;
    imageUploadSpan.textContent = fileName;
});

//Delete account message with confirmation
let deleteDiv = document.querySelector('.dashboard__delete-div');
deleteDiv.addEventListener('click', () => {
    let infoDiv = document.createElement('div');
    let form = deleteDiv.parentNode;
    infoDiv.className = 'error-text';
    infoDiv.textContent = 'Please confirm (all your data will be deleted)';
    form.insertBefore(infoDiv, deleteDiv);

    let deleteButton = document.createElement('button');
    deleteButton.className = 'dashboard__delete-button';
    deleteButton.type = 'submit';
    deleteButton.textContent = 'Confirm';
    form.removeChild(deleteDiv);
    form.appendChild(deleteButton);
});

//Edit name