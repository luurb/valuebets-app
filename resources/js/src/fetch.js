import {initPrint} from './modules/fetch/print-init.js';
import {initTimer, clearCountDown} from './modules/timer/count-down.js';

let time = document.querySelector('.filters__refresh-num');
let refreshButton = document.querySelector('.filters__refresh');

makeRequest();

/*function makeRequest() {
    fetch('./feed/json.php')
        .then(response => {
            if (! response.ok) {
                return null;
            }

            let type = response.headers.get('content-type');
            if (type !== 'text/html; charset=UTF-8') {
                throw new TypeError('Expected text/html, got ' + type);
            }

            return response.text();
        })
        .then(response => {
            response = JSON.parse(response);
            initPrint(response);
            initTimer(Number(time.textContent) * 60000, makeRequest);
        })
        .catch(e => {
            if (e.name == 'NetworkError') {
                alert('Check your Internet connection');
            } else if (e instanceof TypeError) {
                alert('Something wrong with our server' + e.message);
            } else {
                console.error(e);
            }
        });
}*/

//Testing
function makeRequest() {
    fetch('/storage/games.json')
        .then(response => {
            if (! response.ok) {
                return null;
            }

            let type = response.headers.get('content-type');
            if (type !== 'application/json') {
                throw new TypeError('Expected text/html, got ' + type);
            }

            return response.json();
        })
        .then(response => {
            initPrint(response);
            initTimer(500000, makeRequest);
        })
        .catch(e => {
            if (e.name == 'NetworkError') {
                alert('Check your Internet connection');
            } else if (e instanceof TypeError) {
                alert('Something wrong with our server' + e.message);
            } else {
                console.error(e);
            }
        });
};


//Prevent usert from multiple clicks on refresh button
let clicked = false;

//Refresh timer and print updated table
refreshButton.addEventListener('click', () => {
    if (!clicked) {
        clicked = true;
        clearCountDown();
        makeRequest();
        setTimeout(() => {
            clicked = false;
        }, 2000);
    }
});


