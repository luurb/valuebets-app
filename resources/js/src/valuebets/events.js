let number = document.querySelector('.filters__refresh-num');
let wrapper = document.querySelector('.filters__refresh-wrapper');
const minNumber = 3;

//Refresh option
wrapper.addEventListener('click', (e) => {
    let x = Number(number.textContent);
    if (x > minNumber && x < 15) {
        if (e.target.textContent === '+') {
            ++x;
        } else if (e.target.textContent === '-') {
            --x;
        }
    } else if (x === minNumber) {
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

