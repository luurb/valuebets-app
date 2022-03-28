import { dbConnectAwait } from './modules/indexedDb/db-connect.mjs';
import { addGamesToIndexedDb } from './modules/indexedDb/db-operation.mjs';
import { addGamesToHistory } from './modules/add/add-bet.mjs';

let filterBtn = document.querySelector('.main-table__button');
//Execute correct function after checking which checkboxes user checked
filterBtn.addEventListener('click', () => {
    let checkbox = document.querySelectorAll('.main-table__checkbox:checked');
    let checkBoxLength = checkbox.length;

    let gamesToSave = [];
    let gamesToHide = [];

    for (let i = 0; i < checkBoxLength; i++) {
        let tr = checkbox[i].parentNode.parentNode.parentNode;
        let condition = checkbox[i].className.indexOf('del');
        let game = createGame(tr);
        gamesToHide.push(game);

        if (condition === -1) {
            gamesToSave.push(game);
        }

        hideGame(tr);
    }

    if (gamesToSave.length !== 0) {
        addGamesToHistory(gamesToSave);
    }
    
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
