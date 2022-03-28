import * as Sort from './modules/sorting/sorting-init.mjs';
import { printNewTableBody } from './modules/fetch/print-games.mjs';

let carets = document.querySelectorAll('.filters__caret');
let sortingBox = document.querySelector('.filters__sorting-box');

sortingBox.addEventListener('click', (e) => {
    if (e.target.tagName === 'SPAN') {
        let sortSpan = document.querySelector('.sort-span');

        if (sortSpan) {
            sortSpan.classList.remove('sort-span');
        }

        e.target.classList.add('sort-span');

        let caret = document.querySelector('.sorted');

        if (caret) {
            Sort.initSort().then((gamesArr) => printNewTableBody(gamesArr));
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

        Sort.setSortDirection(caret);

        let sortSpan = document.querySelector('.sort-span');

        if (sortSpan) {
            Sort.initSort().then((gamesArr) => printNewTableBody(gamesArr));
        }
    });
});
