//Margin calc - three way
let homeOddInput = document.querySelector('input[name="home_odd"]');
let drawOddInput = document.querySelector('input[name="draw_odd"]');
let awayOddInput = document.querySelector('input[name="away_odd"]');
let threeWayBox = document.querySelector('.three-way');

//Margin calc - two way
let firstOddInput = document.querySelector('input[name="first_odd"]');
let secondOddInput = document.querySelector('input[name="second_odd"]');
let twoWayBox = document.querySelector('.two-way');

//Value calc
let checkedOddInput = document.querySelector('input[name="checked_odd"]');
let realOddInput = document.querySelector('input[name="real_odd"]');
let payoutInput = document.querySelector('input[name="payout"]');
let valueBox = document.querySelector('.value');

threeWayBox.addEventListener('input', (e) => {
    let odds = {
        home: homeOddInput.value,
        draw: drawOddInput.value,
        away: awayOddInput.value,
    };
    let inputsBox = threeWayBox.parentNode;

    if (validate(odds, inputsBox, e.target.value)) {
        printMargin(odds, inputsBox);
    }
});

twoWayBox.addEventListener('input', (e) => {
    let odds = {
        first: firstOddInput.value,
        second: secondOddInput.value,
    };
    let inputsBox = twoWayBox.parentNode;

    if (validate(odds, inputsBox, e.target.value)) {
        printMargin(odds, inputsBox);
    }
});

valueBox.addEventListener('input', (e) => {
    let odds = {
        checked: checkedOddInput.value,
        real: realOddInput.value,
        payout: payoutInput.value,
    };
    let inputsBox = valueBox.parentNode;

    if (validate(odds, inputsBox, e.target.value)) {
        printValue(odds, inputsBox);
    }
});

function validate(odds, inputsBox, odd) {
    odd = odd.replace(',', '.');
    if (!odd || !Number(odd) || odd <= 1) {
        if (odd != '') {
            removeResultDiv(inputsBox);
            printErrorDiv(inputsBox, 'Please type correct data');
            return false;
        }
    }

    for (let key in odds) {
        if (!odds[key]) {
            removeResultDiv(inputsBox);
            printErrorDiv(inputsBox, 'Please fill all fields');
            return false;
        }
    }

    removeResultDiv(inputsBox);
    return true;
}

function printErrorDiv(inputsBox, message) {
    if (!inputsBox.querySelector('.tools__result')) {
        let errorDiv = document.createElement('div');
        errorDiv.setAttribute('class', 'tools__result error-text');
        errorDiv.textContent = message;
        inputsBox.appendChild(errorDiv);
    }
}

function removeResultDiv(inputsBox) {
    let resultDiv = inputsBox.querySelector('.tools__result');
    if (resultDiv) {
        inputsBox.removeChild(resultDiv);
    }
}

function printMargin(odds, inputsBox) {
    let margin = 0;

    for (let key in odds) {
        odd = odds[key].replace(',', '.');
        margin += 1 / odd;
    }

    margin = 100 * (margin - 1);
    margin = Math.round(margin * 100) / 100;

    let resultDiv = document.createElement('div');
    resultDiv.setAttribute('class', 'tools__result');

    let marginColor;
    if (margin < 5) {
        marginColor = 'green-bold';
    } else if (margin > 5 && margin < 7) {
        marginColor = 'gold-bold';
    } else {
        marginColor = 'red-bold';
    }

    resultDiv.innerHTML = `Bookie margin: <span class="${marginColor}">${margin}%</span>`;

    inputsBox.appendChild(resultDiv);
}

function printValue(odds, inputsBox) {
    for (let key in odds) {
        odd = odds[key].replace(',', '.');
    }

    let checked = odds['checked'];
    let real = odds['real'];
    let payout = odds['payout'];

    let overvalue = (1 / real) * payout - (1 / checked) * 100;

    let value = checked / (100 / ((1 / real) * payout));

    overvalue = Math.round(overvalue * 100) / 100;
    value = (value - 1) * 100;
    value = Math.round(value * 100) / 100;

    let resultDiv = document.createElement('div');
    resultDiv.setAttribute('class', 'tools__result');

    let resultColor;
    if (value <= 0) {
        resultColor = 'red-bold';
    } else {
        resultColor = 'green-bold';
    }

    resultDiv.innerHTML = `
    Probability difference: ${overvalue}% 
    <div>
        Value: <span class="${resultColor}">${value}%</span>
    </div>`;

    inputsBox.appendChild(resultDiv);
}
