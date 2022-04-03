import { addMessage } from '../modules/print-message.js';

let deleteButton = document.querySelector('.main-table__nav-trash');

deleteButton.addEventListener('click', () => {
    let dataForm = new FormData(document.querySelector('#delete-form'));
    let games = dataForm.getAll('delete[]');
    let checkedBoxes = document.querySelectorAll('.main-table__checkbox--del:checked');

    if (games.length !== 0) {
        deleteGameFromHistory({ games: games });
    }

    for (let checkedBox of checkedBoxes) {
        hideGame(checkedBox.closest('.main-table__bet-wrapper'));
    }
});

function hideGame(betWrapper) {
    betWrapper.classList.add('bet-delete-blink');
    setTimeout(() => {
        betWrapper.remove();
    }, 1000);
}

function deleteGameFromHistory(gamesArr) {
    let token = document
        .querySelector('meta[name=csrf-token]')
        .getAttribute('content');

    fetch('/history', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(gamesArr),
    })
        .then((response) => {
            if (!response.ok) {
                return null;
            }

            let type = response.headers.get('content-type');
            if (type !== 'application/json') {
                throw new TypeError('Expected application/json, got ' + type);
            }

            return response.json();
        })
        .then((data) => {
            addMessage(data);
        })
        .catch((e) => {
            if (e.name == 'NetworkError') {
                alert('Check your Internet connection');
            } else if (e instanceof TypeError) {
                alert('Something wrong with our server' + e.message);
            } else {
                console.error(e);
            }
        });
}
