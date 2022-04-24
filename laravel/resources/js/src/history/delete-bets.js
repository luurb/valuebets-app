import { addMessage } from '../modules/print-message.js';
import axios from 'axios';

let deleteButton = document.querySelector('.main-table__nav-trash');

deleteButton.addEventListener('click', () => {
    let dataForm = new FormData(document.querySelector('#delete-form'));
    let games = dataForm.getAll('delete[]');
    let checkedBoxes = document.querySelectorAll(
        '.main-table__checkbox--del:checked'
    );

    if (games.length !== 0) {
        deleteGameFromHistory(games);
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
    axios
        .delete('/history/delete', {
            data: {
                games: gamesArr,
            },
        })
        .then((res) => {
            addMessage(res['data']);
        })
        .catch((e) => {
            if (e.name == 'NetworkError') {
                console.log('Check your Internet connection');
            } else if (e instanceof TypeError) {
                console.log('Something wrong with our server' + e.message);
            } else {
                console.error(e);
            }
        });
}
