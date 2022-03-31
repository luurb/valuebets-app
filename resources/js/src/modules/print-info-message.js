function printInfoMessage(message, e) {
    let targetDiv = e.target.querySelector('.info-message');
    if (targetDiv) {
        e.target.classList.remove('relative');
        targetDiv.remove();
    } else {
        let div = document.createElement('div');
        div.setAttribute('class', 'info-message');
        div.textContent = message;
        e.target.appendChild(div);
    }
}

export {printInfoMessage};