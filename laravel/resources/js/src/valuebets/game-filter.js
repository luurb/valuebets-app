import { dbConnectAwait, addGamesToIndexedDb } from '../modules/cache.js';
import { addMessage } from '../modules/print-message.js';
import axios from 'axios';

let filterBtn = document.querySelector('.main-table__nav-filter');

//Execute correct function after checking which checkboxes user checked
filterBtn.addEventListener('click', () => {
    let checkedBoxes = document.querySelectorAll(
        '.main-table__checkbox:checked'
    );
    let checkBoxLength = checkedBoxes.length;

    let gamesToSave = [];
    let gamesToHide = [];
    let betsToHide = [];

    for (let checkedBox of checkedBoxes) {
        let betWrapper = checkedBox.closest('.main-table__bet-wrapper');
        let game = createGame(betWrapper);
        let name = checkedBox.getAttribute('name');

        if (name === 'add') {
            gamesToSave.push(game);
        }

        gamesToHide.push(game);
        betsToHide.push(betWrapper);
    }

    addGamesToHistory(
        {
            games: gamesToSave,
            counter: checkBoxLength,
        },
        betsToHide
    );

    addGamesToCache(gamesToHide);
});

function addGamesToCache(games) {
    dbConnectAwait('hide_games').then((hideGamesDb) =>
        addGamesToIndexedDb(games, hideGamesDb, 'hide_games')
    );
}

function createGame(betWrapper) {
    let game = {};
    game['bookie'] = betWrapper.querySelector('.bookie').textContent;
    game['sport'] = betWrapper.querySelector('.sport').textContent;
    game['date'] = betWrapper.querySelector('.date').textContent;
    game['teams'] = betWrapper.querySelector('.teams').textContent;
    game['league'] = betWrapper.querySelector('.league').textContent;
    game['bet'] = betWrapper.querySelector('.bet').textContent;
    game['odd'] = betWrapper.querySelector('.odd').textContent;
    game['value'] = betWrapper.querySelector('.value').textContent;

    return game;
}

function addGamesToHistory(gamesArr, betsToHide) {
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
        .post('/valuebets', gamesArr, config)
        .then((response) => {
            if (response['data']['response'] === 4) {
                return (window.location.href = '/login');
            }

            betsToHide.forEach((betWrapper) => {
                hideGame(betWrapper);
            });

            addMessage(response['data']);
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

function hideGame(betWrapper) {
    betWrapper.classList.add('bet-delete-blink');
    setTimeout(() => {
        betWrapper.remove();
    }, 1000);
}
