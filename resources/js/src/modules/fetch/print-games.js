//Function create new body of games table
function printNewTableBody(gamesArr) {
    let tableWrapper = document.querySelector('.main-table__wrapper');
    let oldBetsBox = document.querySelector('.main-table__bets');
    let newBetsBox = oldBetsBox.cloneNode();
    newBetsBox = createNewBetsBox(gamesArr, newBetsBox);

    //Nedded to remove class for animation to be able
    //to add another animation to that element later
    newBetsBox.childNodes.forEach((betWrapper) => {
        if (betWrapper.classList.contains('bet-add-blink')) {
            setTimeout(() => {
                betWrapper.classList.remove('bet-add-blink');
            }, 4000);
        }
    });

    oldBetsBox.remove();
    newBetsBox.classList.add('betsbox-blink');
    tableWrapper.appendChild(newBetsBox);
}

//Function create new rows list for valubets table
function createNewBetsBox(gamesArr, newBetsBox) {
    let gamesArrLength = gamesArr.length;
    for (let i = 0; i < gamesArrLength; i++) {
        let game = gamesArr[i];
        let betWrapper = document.createElement('div');
        betWrapper.setAttribute('class', 'main-table__bet-wrapper');

        if (game['class'] !== '') {
            betWrapper.classList.add(game['class']);
        }

        let downRows = document.createElement('div');
        downRows.setAttribute('class', 'main-table__down-rows');

        let firstRow = getFirstRow(game);
        let secondRow = getSecondRow(game);
        let thirdRow = getThirdRow(game);

        downRows.appendChild(secondRow);
        downRows.appendChild(thirdRow);

        betWrapper.appendChild(firstRow);
        betWrapper.appendChild(downRows);

        newBetsBox.appendChild(betWrapper);
    }

    return newBetsBox;
}

function getFirstRow(game) {
    let firstRow = document.createElement('div');
    firstRow.setAttribute('class', 'main-table__row');
    firstRow.innerHTML = `
        <div class="main-table__data relative max-width-30">
            <span class="main-table__title">
                bookie:
            </span>
            <span class="main-table__data-span bookie">${game['bookie']}</span>
        </div>
        <div class="main-table__data relative">
            <span class="main-table__title">
                bet:
            </span>
            <span class="main-table__data-span bet">${game['bet']}</span>
            </span>
        </div>
        <div class="main-table__inputs relative">
            <label>
                <input type="checkbox" name="add" 
                class="main-table__checkbox--add main-table__checkbox none"
                form="filter-form">
                <i class="fa-solid fa-floppy-disk main-table__input"></i>
            </label>
            <label>
                <input type="checkbox" name="delete"
                class="main-table__checkbox--del main-table__checkbox none" 
                form="filter-form">
                <i class="fa-solid fa-trash main-table__input"></i>
            </label>
        </div>`;

    return firstRow;
}

function getSecondRow(game) {
    let secondRow = document.createElement('div');
    secondRow.setAttribute('class', 'main-table__row');
    secondRow.innerHTML = `
        <div class="main-table__data relative delay">
            <span class="main-table__title">
                delay:
            </span>
            <span class="main-table__data-span">
                <i class="fa-regular fa-clock"></i>
                ${getClockTime(game['delay'])}
            </span>
        </div>
        <div class="main-table__data relative">
            <span class="main-table__title">
                sport:
            </span>
            <span class="main-table__data-span">
                <span class="sport none">${game['sport']}</span>
                <img src="./images/svg/${game['sport'].toLowerCase()}.svg" class="main-table__img"/>
            </span>
        </div>
        <div class="main-table__data relative">
            <span class="main-table__title">
                value:
            </span>
            <span class="main-table__data-span value">${game['value']}%</span>
        </div>
        <div class="main-table__data relative">
            <span class="main-table__title">
                odd:
            </span>
            <span class="main-table__data-span odd">${game['odd']}</span>
        </div>`;

    return secondRow;
}

function getThirdRow(game) {
    let thirdRow = document.createElement('div');
    thirdRow.setAttribute('class', 'main-table__row');
    let a = document.createElement('a');
    a;
    thirdRow.innerHTML = `
        <div class="main-table__data relative">
            <div class="main-table__bet-info date">${game['date_time']}</div>
            <div class="main-table__teams-box">
                <div class="main-table__teams teams">${game['teams']}</div>
                <div class="main-table__league league">${game['league']}</div>
            </div>
        </div>`;

    return thirdRow;
}

//Function return delay for given game
function getClockTime(time) {
    let timeDiff = Math.floor((new Date(Date.now()) - time) / 60000);
    if (timeDiff == 0) return '< 1 min';

    return timeDiff + ' min';
}

export { printNewTableBody };
