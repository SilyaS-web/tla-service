let phone = '';
let is_confirmed = false;
let input = document.querySelector('#phone');
let btn = document.querySelector('#tg-confirmation__btn');

input.oninput = function () {
    btn.innerHTML = 'Перейти';
    btn.classList.remove("success");
    is_confirmed = false;
};

setInterval(() => {
    if (phone != input.value || !is_confirmed) {
        phone = input.value;
        $.post('/apist/tg/confirmed', {
            phone: phone
        }, function () {
            btn.querySelector('a').innerHTML = 'Подтверждено';
            btn.classList.add("success");
            is_confirmed = true;
        });
    }
}, 1000)
