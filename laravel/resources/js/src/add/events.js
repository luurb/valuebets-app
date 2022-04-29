let resultBox = document.querySelector('.add-bet__result-box');
let resultList = document.querySelector('.add-bet__result-list');

resultBox.addEventListener('click', () => {
    let className = 'max-height-8';
    resultList.classList.contains(className)
        ? resultList.classList.remove(className)
        : resultList.classList.add(className);
});

resultList.addEventListener('click', (e) => {
    let resultInput = resultBox.querySelector('input');
    let result = e.target.textContent;
    resultInput.value = result;
    resultBox.querySelector('span').textContent = result;
});