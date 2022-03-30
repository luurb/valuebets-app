let minutes;
let seconds;
let iter;
let makeRequest;

function initTimer(interval, callback) {
    seconds = interval / 1000;
    minutes = Math.floor(seconds / 60);
    seconds = seconds - minutes * 60;
    printTimer();
    makeRequest = callback;
    iter = setInterval(setTimer, 1000);
}

function printTimer() {
    let timerBox = document.querySelector('.nav-box__timer');
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    minutes = (minutes < 10) ? '0' + minutes : minutes;

    timerBox.textContent = minutes + ':' + seconds;
}

function setTimer() {
    if (seconds == '00' && minutes == 0) {
        clearCountDown();
        makeRequest();
    } else {
        if (seconds === '00') {
            seconds = 59;
            minutes = Number(minutes);
            minutes--;
        } else {
            seconds = Number(seconds);
            minutes = Number(minutes);
            seconds--;
        }
        printTimer();
    }
}

function clearCountDown() {
    clearInterval(iter);
    iter = null;
}

export {initTimer, clearCountDown};