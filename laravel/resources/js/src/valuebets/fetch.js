import { initPrint } from '../modules/fetch/print-init.js';
import { initTimer, clearCountDown } from '../modules/timer/count-down.js';
import axios from 'axios';

let time = document.querySelector('.filters__refresh-box .filters__iter-num');
let refreshButton = document.querySelector('.filters__refresh');

makeRequest();

function makeRequest() {
    axios
        .get('valuebets/fetch')
        .then((response) => {
            initPrint(response['data']);
            let timeout = localStorage.getItem('timeout');
            timeout
                ? initTimer(timeout * 60000, makeRequest)
                : initTimer(Number(time.textContent) * 60000, makeRequest);
        })
        .catch((e) => {
            if (e.name == 'NetworkError') {
                console.log('Check your Internet connection');
            } else if (e instanceof TypeError) {
                console.log('Something wrong with our server ' + e.message);
            } else {
                console.error(e);
            }
        });
}

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
