//Function add message with icon in nav-box after user delete or add bet
export function addMessage(data) {
    let navBox = document.querySelector('.nav-box__left');
    let navBoxMessage = document.querySelector('.nav-box__message');
    let counter = data['counter'];
    let messages = {
        1: {
            message:
                'Added: ' +
                counter['saved'] +
                '. Deleted: ' +
                counter['deleted'],
            icon: '<i class="fa-solid fa-check"></i>',
        },
        2: {
            message: 'Deleted bets: ' + counter,
            icon: '<i class="fa-solid fa-check"></i>',
        },
        3: {
            message: 'Bet was modified',
            icon: '<i class="fa-solid fa-check"></i>',
        },
        0: {
            message: 'Something went wrong',
            icon: '<i class="fa-solid fa-xmark"></i>',
        },
    };

    let messageNumber = data['response'];
    let response = messages[messageNumber];

    let div = document.createElement('div');
    div.setAttribute('class', 'nav-box__message');

    if (navBoxMessage) {
        navBoxMessage.remove();
    }

    div.innerHTML = response.icon;
    navBox.appendChild(div);

    div.addEventListener('click', () => {
        printTitle(response.message, div);
    });
}

//Function print or hide message after user click icon in nav-box
function printTitle(message, box) {
    let title = document.querySelector('.nav-box__message-text');
    if (!title) {
        title = document.createElement('div');
        title.setAttribute('class', 'nav-box__message-text');
        title.textContent = message;

        box.appendChild(title);
    } else {
        title.remove();
    }
}