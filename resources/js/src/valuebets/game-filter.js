import { dbConnectAwait, addGamesToIndexedDb} from '../modules/cache.js';
import {addMessage} from '../modules/print-message.js';

let filterBtn = document.querySelector('.main-table__delete-button');
//Execute correct function after checking which checkboxes user checked
filterBtn.addEventListener('click', () => {
    let checkedBoxes = document.querySelectorAll('.main-table__checkbox:checked');
    let checkBoxLength = checkedBoxes.length;

    let gamesToSave = [];
    let gamesToHide = [];
    let rowsToHide = [];

    for (let checkedBox of checkedBoxes) {
        let tr = checkedBox.closest('tr');
        let game = createGame(tr);
        let name = checkedBox.getAttribute('name');

        if (name === 'add') {
            gamesToSave.push(game);
        } else {
            gamesToHide.push(game);
        }

        rowsToHide.push(tr);
    }

    addGamesToHistory({
        games: gamesToSave,
        counter: checkBoxLength,
    }, rowsToHide);

    addGamesToCache(gamesToHide);
});

function hideGame(tr) {
    tr.className = 'tr-delete-blink';
    setTimeout(() => {
        tr.remove();
    }, 1000);
}

function addGamesToCache(games) {
    dbConnectAwait('hide_games').then((hideGamesDb) =>
        addGamesToIndexedDb(games, hideGamesDb, 'hide_games')
    );
}

function createGame(tr) {
    let game = {};
    let tdList = tr.querySelectorAll('td');
    game['bookie'] = tdList[1].textContent;
    game['sport'] = tdList[2].textContent;
    game['date'] = tdList[3].textContent;
    game['teams'] = tdList[4].textContent;
    game['bet'] = tdList[5].textContent;
    game['odd'] = tdList[6].textContent;
    game['value'] = tdList[7].textContent;

    return game;
}



function addGamesToHistory(gamesArr, rowsToHide) {
    let token = document
        .querySelector('meta[name=csrf-token]')
        .getAttribute('content');

    fetch('/valuebets', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(gamesArr)
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
        .then (data => {
            if (data['response'] === 4) {
                return window.location.href = '/login';
            }

            rowsToHide.forEach(row => {
                hideGame(row);
            });
            
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