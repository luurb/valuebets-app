import {checkboxSwitch} from './checked-switch.mjs'
import {printNewTableBody} from './print-games.mjs'; 
import {sort} from '../sorting/sorting-init.mjs';
import {dbConnectAwait} from '../indexedDb/db-connect.mjs';
import {hideGamesDbFilter, getUpdatedArr} from 
'../indexedDb/db-operation.mjs';


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