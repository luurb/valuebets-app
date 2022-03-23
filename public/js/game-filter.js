import {dbConnectAwait} from './modules/indexedDb/db-connect.mjs';
import {addToDb} from './modules/indexedDb/db-operation.mjs';

let filterBtn = document.querySelector('.main-table__button');
//Execute correct function after checking which checkboxes user checked
filterBtn.addEventListener('click', () => {
    let checkbox = document.querySelectorAll('.main-table__checkbox:checked');
    let checkBoxLength = checkbox.length;

    for (let i = 0; i < checkBoxLength; i++) {
        let tr = checkbox[i].parentNode.parentNode.parentNode;
        let condition = checkbox[i].className.indexOf('del');
        let game = createGame(tr);
        (condition === -1) ? addGametoHistory(game, tr) : hideGame(game, tr);
    }
});

function hideGame(game, tr) {
    dbConnectAwait('hide_games')
    .then(hideGamesDb => 
        addToDb({game: game}, hideGamesDb, 'hide_games'));
        
    tr.className = 'tr-delete-blink';
    setTimeout(() => {
        tr.remove();
    }, 1000);
}

function addGametoHistory(game, tr) {
    hideGame(game, tr);
    console.log('Added game');
    /*
    Function add game to bet history on server side db
    */
}

function createGame(tr) {
    let game = [];
    let tdList = tr.querySelectorAll('td');
    game['date'] = tdList[3].textContent;
    game['teams'] = tdList[4].textContent;
    game['bet'] = tdList[5].textContent;

    return game;
}
