let refreshBox = document.querySelector('.filters__refresh-box');
let refreshTimeoutToPrint = refreshBox.querySelector('.filters__iter-num');
let timeBox = document.querySelector('.filters__time-box');
let eventDuring = timeBox.querySelector('.filters__iter-num');
let timeInput = timeBox.querySelector("input[type='hidden']");

const minRefreshTimeout= 3;
const maxRefreshTimeout= 15;
const minTime = 1;
const maxTime = 6;

//Refresh option
refreshBox.addEventListener('click', (e) => {
    let refreshTimeout = Number(refreshTimeoutToPrint.textContent);
    if (refreshTimeout > minRefreshTimeout && refreshTimeout < maxRefreshTimeout) {
        if (e.target.textContent === '+') {
            ++refreshTimeout;
        } else if (e.target.textContent === '-') {
            --refreshTimeout;
        }
    } else if (refreshTimeout === minRefreshTimeout) {
        if (e.target.textContent === '+') {
            ++refreshTimeout;
        }
    } else {
        if (e.target.textContent === '-') {
            --refreshTimeout;
        }
    }
    refreshTimeoutToPrint.textContent = refreshTimeout;
});

//Event during
timeBox.addEventListener('click', (e) => {
    let time = Number(eventDuring.textContent);
    if (time > minTime && time < maxTime) {
        if (e.target.textContent === '+') {
            ++time;
        } else if (e.target.textContent === '-') {
            --time;
        }
    } else if (time === minTime) {
        if (e.target.textContent === '+') {
            ++time;
        }
    } else {
        if (e.target.textContent === '-') {
            --time;
        }
    }
    eventDuring.textContent = time;
    timeInput.value = time;
});

