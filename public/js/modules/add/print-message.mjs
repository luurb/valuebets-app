function printMessage(data) {
    let navBox = document.querySelector('.nav-box__wrapper');
    let navBoxMessage = document.querySelector('.nav-box__message');
    let response = data['response'];
    let counter = data['counter'];

    let message = '';
    let icon = '';
    if (response === 'true') {
        message = counter + ' bets were added to bet history';
        icon = '<i class="fa-solid fa-check"></i>';
    } else {
        message = 'Something went wrong';
        icon = '<i class="fa-solid fa-xmark"></i>';
    }

    let div = document.createElement('div');
    div.setAttribute('class', 'nav-box__message');

    if (navBoxMessage) {
        navBoxMessage.remove();
    }

    div.innerHTML = icon;
    navBox.appendChild(div);

    div.addEventListener('click',() => {
        printTitle(message, div);
    });
}

function printTitle(message, box) {
    let title = document.querySelector('.nav-box__message-text');
    if (! title) {
        title = document.createElement('div');
        title.setAttribute('class', 'nav-box__message-text');
        title.textContent = message;

        box.appendChild(title);
    } else {
        title.remove();
    }
}

export { printMessage };
