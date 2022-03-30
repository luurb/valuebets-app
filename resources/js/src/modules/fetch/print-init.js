import {checkboxSwitch} from '../checkbox-switch.js'
import {printNewTableBody} from './print-games.js'; 
import {sort} from '../sorting.js';
import {dbConnectAwait, hideGamesDbFilter, getUpdatedArr} from '../cache.js';

//Function print valuebets table 
async function initPrint(gamesArr) {
    let tbody = document.querySelector('tbody');
    tbody.className = 'tbody-blink';
    let hideGamesDb = await dbConnectAwait('hide_games');
    if (hideGamesDb) {
        let filteredGamesArr = await hideGamesDbFilter(
            hideGamesDb, gamesArr, 'hide_games');
        if (filteredGamesArr) {
            dbConnectAwait('games')
            .then(gamesDb => 
                getUpdatedArr(gamesDb, filteredGamesArr, 'games')
            )
            .then(updatedGamesArr => {
                printNewTableBody(sort(updatedGamesArr));
                let tbody = document.querySelector('.main-table__table tbody');
                tbody.addEventListener('click', e => {
                    checkboxSwitch(e);
                });
            });
        }
    }
}

export {initPrint};