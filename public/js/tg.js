let phone = '';
let is_confirmed = false;
let input = document.querySelector('#phone');
let confirmation_block = document.querySelector('#tg-confirmation');
let block = document.querySelector('#tg-confirmation__block');

input.oninput = function () {
    confirmation_block.style.display = 'flex';
    block.style.display = 'none';
    is_confirmed = false;
};

setInterval(() => {
    if (phone != input.value || !is_confirmed) {
        phone = input.value;
        $.post('/apist/tg/confirmed', {
            phone: phone
        }).done(function () {
            confirmation_block.style.display = 'none';
            block.style.display = 'flex';
            is_confirmed = true;
        }).fail(function () {
            confirmation_block.style.display = 'flex';
            block.style.display = 'none';
            is_confirmed = false;
        });
    }
}, 1000)
