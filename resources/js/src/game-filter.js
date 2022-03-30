import { dbConnectAwait, addGamesToIndexedDb} from './modules/cache.js';
import { addGamesToHistory } from './modules/add/add-bet.js';

let filterBtn = document.querySelector('.main-table__delete-button');
//Execute correct function after checking which checkboxes user checked
filterBtn.addEventListener('click', () => {
    let checkedBoxes = document.querySelectorAll('.main-table__checkbox:checked');
    let checkBoxLength = checkedBoxes.length;

    let gamesToSave = [];
    let gamesToHide = [];

    for (let checkedBox of checkedBoxes) {
        let tr = checkedBox.closest('tr');
        let game = createGame(tr);
        let name = checkedBox.getAttribute('name');

        if (name === 'add') {
            gamesToSave.push(game);
        } else {
            gamesToHide.push(game);
        }

        hideGame(tr);
    }

    addGamesToHistory({
        games: gamesToSave,
        counter: checkBoxLength,
    });

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
