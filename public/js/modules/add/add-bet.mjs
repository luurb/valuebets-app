import {printMessage} from './print-message.mjs';

let token = document
    .querySelector('meta[name=csrf-token]')
    .getAttribute('content');

function addGamesToHistory(gamesArr) {
    fetch('/valuebets', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(gamesArr)
    })
        .then((response) => {
            if (!response.ok) {
                return null;
            }

            let type = response.headers.get('content-type');
            if (type !== 'application/json') {
                throw new TypeError('Expected application/json, got ' + type);
            }

            return response.json();
        })
        .then (data => {
            printMessage(data);
        })
        .catch((e) => {
            if (e.name == 'NetworkError') {
                alert('Check your Internet connection');
            } else if (e instanceof TypeError) {
                alert('Something wrong with our server' + e.message);
            } else {
                console.error(e);
            }
        });
}

export { addGamesToHistory };
