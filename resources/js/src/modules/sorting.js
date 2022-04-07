import { printNewTableBody } from './fetch/print-games.js';
import { getGamesArr, dbConnectAwait } from './cache.js';

let carets = document.querySelectorAll('.filters__caret');
let sortingBox = document.querySelector('.filters__sorting-box');
let sortDirection;

sortingBox.addEventListener('click', (e) => {
    if (e.target.tagName === 'SPAN') {
        let sortSpan = document.querySelector('.sort-span');

        if (sortSpan) {
            sortSpan.classList.remove('sort-span');
        }

        e.target.classList.add('sort-span');

        let caret = document.querySelector('.sorted');

        if (caret) {
            initSort().then((gamesArr) => printNewTableBody(gamesArr));
        }
    }
});

carets.forEach((caret) => {
    caret.addEventListener('click', () => {
        carets.forEach((element) => {
            element.classList.remove('sorted');

            //Change color of clicked carret
            caret.classList.add('sorted');
        });

        setSortDirection(caret);

        let sortSpan = document.querySelector('.sort-span');

        if (sortSpan) {
            initSort().then((gamesArr) => printNewTableBody(gamesArr));
        }
    });
});

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
    let sortByValue = getSortByValue();
    if (typeof sortByValue !== 'undefined') {
        arr.sort((first, second) => {
            if (sortByValue === 'delay') {
                let firstDelay = new Date(Date.now()) - first[sortByValue];
                let secondDelay = new Date(Date.now()) - second[sortByValue];
                return sortDirection * (firstDelay > secondDelay ? 1 : -1);
            } else if (sortByValue === 'date_time') {
                return (
                    sortDirection * (first[sortByValue] > second[sortByValue] ? 1 : -1)
                );
            } else {
                return sortDirection * (first[sortByValue] - second[sortByValue]);
            }
        });
    }
    return arr;
}

function setSortDirection(caret) {
    sortDirection = 1;
    if (caret.classList.contains('fa-caret-down')) sortDirection = -1;
}

function getSortByValue() {
    let sortSpan = document.querySelector('.sort-span');

    if (sortSpan) {
        let sortByValue = sortSpan.textContent.toLowerCase();
        sortByValue = sortByValue === 'date' ? 'date_time' : sortByValue;
        
        return sortByValue;
    }
}

export { sort };
