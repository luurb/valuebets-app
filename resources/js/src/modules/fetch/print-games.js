import {addSportIcon} from '../add-icons.js';

//Function create new body of games table
function printNewTableBody(gamesArr) {
    let table = document.querySelector('.main-table__table');
    let oldTbody = table.querySelector('tbody');
     
    let newTrList = createNewTrList(gamesArr);
    let newTbody = oldTbody.cloneNode();
    let trLength = newTrList.length;

    for (let i = 0; i < trLength; i++) {
        let tr = newTrList[i];
        newTbody.appendChild(tr);
        //Nedded to remove class for animation to be able
        //to add another animation to that element later
        if (tr.className === 'tr-add-blink') {
            setTimeout(() => {
                newTrList[i].classList.remove('tr-add-blink');
            }, 4000)
        }
    }

    oldTbody.remove();
    table.appendChild(newTbody); 
    addSportIcon();
}

//Function create new rows list for valubets table 
function createNewTrList(gamesArr) {
    let gamesLength = gamesArr.length;
    let trList = [];

    for (let i = 0; i < gamesLength; i++) {
        let tr = document.createElement('tr');
        let game = gamesArr[i];
        let gameLength = gamesArr[i].length;
        
        for (let j = 0; j < gameLength - 2; j++) {
            let td = document.createElement('td');
            switch (j) {
                case 0: {
                    td.innerHTML = '<i class="fa-regular fa-clock"></i>' +
                    '<span class="main-table__valuebets-clock"> ' + 
                    getClockTime(game[9]) + '</span>';
                    break;
                }
                case 2: {
                    td.innerHTML = '<span class="main-table__sport-span">' 
                    + game[j] + '</span>';
                    break;
                }
                case 4: {
                    let a = document.createElement('a');
                    a.setAttribute("href", "https://www.oddsportal.com/search/");
                    a.setAttribute("target", "_blank");
                    a.textContent = game[j];
                    td.appendChild(a);
                    break;
                }
                case 5: 
                    td.className = 'bet';
                    td.textContent = game[j];
                    break;
                case 6: 
                    td.className = 'odd';
                    td.textContent = game[j];
                    break;
                case 7: {
                    td.textContent = game[j] + '%';
                    td.className = 'value';
                    break;
                }
                default:
                    td.textContent = game[j];
            }
            tr.appendChild(td);
        }
        let td = document.createElement('td');
        td.innerHTML = 
        `<label>
            <input type="checkbox" form="filter-form" name=add
            class="main-table__checkbox main-table__checkbox--add none">                                           
            <span class="main-table__span main-table__valuebets-span">Add</span>
        </label>
        <label>
            <input type="checkbox" form="filter-form" name=delete
            class="main-table__checkbox main-table__checkbox--del none">
            <span class="main-table__span main-table__valuebets-span">Del</span>
        </label>`;
        tr.appendChild(td);
        tr.className = game[8];
        trList.push(tr);
    }
    
    return trList;
}

//Function return delay for given game
function getClockTime(time) {
    let timeDiff = Math.floor((new Date(Date.now()) - time) / 60000);
    if (timeDiff == 0)
        return '< 1 min';

    return timeDiff + ' min';
}

export {printNewTableBody, createNewTrList};