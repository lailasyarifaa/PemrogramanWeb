let display = document.getElementById('display');

function appendToDisplay(value) {
    display.value += value;
}

function clearAll() {
    display.value = '';
}

function calculate() {
    let input = display.value;

    // Replace '^' with '**' for exponentiation
    input = input.replace('^', '**');

    try {
        let result = eval(input);
        display.value = result;
    } catch (error) {
        display.value = 'Error';
    }
}
