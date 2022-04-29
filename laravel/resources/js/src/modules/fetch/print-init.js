import {checkboxSwitch} from '../checkbox-switch.js'
import {printNewTableBody} from './print-games.js'; 
import {sort} from '../sorting.js';
import {dbConnectAwait, hideGamesDbFilter, getUpdatedArr} from '../cache.js';

//Function print valuebetsBox table 
async function initPrint(gamesArr) {
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
                addBetsCounter(updatedGamesArr.length)
                printNewTableBody(sort(updatedGamesArr));
                let betsWrapper= document.querySelector('.main-table__wrapper');
                betsWrapper.addEventListener('click', e => {
                    checkboxSwitch(e);
                });
            });
        }
    }
}

function addBetsCounter(counter) {
    let navBox = document.querySelector('.nav-box__left');
    let counterDiv = document.querySelector('.nav-box__counter');
    
    if (! counterDiv) {
        counterDiv = document.createElement('div');
        counterDiv.setAttribute('class', 'nav-box__counter');
        navBox.insertBefore(counterDiv, navBox.firstChild);
    }

    let message = (counter == 1) ? 'valuebet' : 'valuebets';
    counterDiv.textContent = `Found ${counter} ${message}`;
}

export {initPrint};