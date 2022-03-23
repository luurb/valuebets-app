import * as Sort from './modules/sorting/sorting-init.mjs';
import { printNewTableBody } from './modules/fetch/print-games.mjs';

let carets = document.querySelectorAll('.filters__caret');
let select = document.querySelector('.filters__select');

carets.forEach((caret) => {
  caret.addEventListener('click', () => {
    //Get column which table has to be sorted by. 
    let columnNum = Sort.getColumnNum();
    if (columnNum) {
      carets.forEach((clickedCaret) => {
        clickedCaret.classList.remove('sorted');
      });
      //Change color of clicked carret
      caret.classList.add('sorted');
      Sort.setSortDirection(caret);

      Sort.initSort().then((gamesArr) => printNewTableBody(gamesArr));
    }
  });
});

//Sort table if select input has changed
select.addEventListener('change', () => {
  carets.forEach((caret) => {
    if (caret.classList.contains('sorted')) {
      Sort.initSort().then((gamesArr) => printNewTableBody(gamesArr));
    }
  });
});
