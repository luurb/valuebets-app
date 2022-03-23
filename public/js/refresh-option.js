//Event delegation for training :)

let number = document.querySelector('.filters__refresh-num');
let wrapper = document.querySelector('.filters__refresh-wrapper');

wrapper.addEventListener('click', e => {
let x = Number(number.textContent);
if (x > 2 && x < 15) {
    if (e.target.textContent === '+') {
        ++x;
    } else if (e.target.textContent === '-') {
        --x;
    }
} else if (x === 2) {
    if (e.target.textContent === '+') {
        ++x;
    } 
} else {
    if (e.target.textContent === '-') {
        --x;
    } 
} 
number.textContent = x;
});
