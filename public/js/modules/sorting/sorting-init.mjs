import { dbConnectAwait } from '../indexedDb/db-connect.mjs';
import { getGamesArr } from '../indexedDb/db-operation.mjs';

let sortDirection;
let columnNumObj = {
    Delay: 9,
    Date: 3,
    Odd: 6,
    Value: 7,
};

//Init sort by getting games table from IndexedDB
//and execute sort func after promise resolve
function initSort() {
    return new Promise((resolve, reject) => {
        dbConnectAwait('games')
            .then((gamesDb) => getGamesArr(gamesDb, 'games'))
            .then((response) => {
                resolve(sort(response));
            });
    });
}

function sort(arr) {
    let column = getColumnNum();
    if (typeof column !== 'undefined') {
        arr.sort((first, second) => {
            if (column === 9) {
                let firstDelay = new Date(Date.now()) - first[column];
                let secondDelay = new Date(Date.now()) - second[column];
                return sortDirection * (firstDelay > secondDelay ? 1 : -1);
            } else if (column === 3) {
                return (
                    sortDirection * (first[column] > second[column] ? 1 : -1)
                );
            } else {
                return sortDirection * (first[column] - second[column]);
            }
        });
    }
    return arr;
}

function setSortDirection(caret) {
    sortDirection = 1;
    if (caret.classList.contains('fa-caret-down')) sortDirection = -1;
}

//Function return column number for sorting after user choose
//specific option
function getColumnNum() {
  let sortSpan = document.querySelector('.sort-span');

  if (sortSpan) {
    return columnNumObj[sortSpan.textContent];
  }
}
export { getColumnNum, setSortDirection, sort, initSort };
