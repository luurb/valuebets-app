let counterList = document.querySelector('.pagination__counter-list');

counterList.addEventListener('click', (e) => {
    let counterBox = document.querySelector('.pagination__results-counter');
    let counter = e.target.textContent;
    let counterSpan = counterBox.querySelector('span');
    let oldCounter = counterSpan.textContent;

    if (oldCounter !== counter) {
        counterSpan.textContent = counter;
        return (window.location.href = '/history?counter=' + counter);
    }
});
