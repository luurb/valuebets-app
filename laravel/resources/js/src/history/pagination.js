let counterList = document.querySelector('.pagination__counter-list');
let counterBtn = document.querySelector('.pagination__results-counter');

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

counterBtn.addEventListener('click', () => {
    let className = 'max-height-8';
    counterList.classList.contains(className)
        ? counterList.classList.remove(className)
        : counterList.classList.add(className);
});
