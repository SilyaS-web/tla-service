@extends('layout.layout')

@section('content')
<section class="edit-profile">
    <div class="edit-profile__container _container">
        <div class="edit-profile__body">
            <div class="edit-profile__title title">
                Редактировать данные
            </div>
            <div class="edit-profile__content">
                <div class="tab-content__profile-img">
                    <img src="img/profile-icon.svg" alt="">
                    <div class="tab-content__profile-img-text">
                        <p>Фото профиля</p>
                        <div class="form-group form-group--file">
                            <label class="tab-content__profile-img-upload input-file" for="profile-img">
                                Загрузите изображение товара
                                <input type="file" name="name" class="" id="profile-img">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="tab-content__form">
                    <div class="tab-content__form-right">
                        <div class="form-group">
                            <label for="">Имя</label>
                            <input type="text" class="input" name="name" id="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email" class="input" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" valie="{{ $user->phone }}">
                        </div>
                        <script>
                            $(function() {
                                $("#phone").mask("8(999) 999-9999");
                            });

                        </script>
                        <div class="form-group">
                            <label for="">Ссылка на маркетплейс</label>
                            <input type="text" class="input" id="marketplace" name="marketplace_link">
                        </div>
                        <button class="btn btn-primary desktop">Сохранить</button>
                    </div>
                    <div class="tab-content__form-left">
                        <label for="">Вы размещаете рекламу для себя или являетесь посредником?</label>
                        <div class="input-checkbox-w">
                            <input type="checkbox" class="checkbox whois" id="broker">
                            <label for="">Я посредник</label>
                        </div>
                        <div class="input-checkbox-w">
                            <input type="checkbox" class="checkbox whois" id="advertiser">
                            <label for="">Я селлер</label>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="">Тип организации</label>
                            <input type="text" class="input" id="type" name="marketplace_link">
                        </div>
                        <div class="form-group">
                            <label for="">ИНН</label>
                            <input type="text" class="input" id="inn">
                        </div>
                    </div>
                    <button class="btn btn-primary mobile">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('scripts')
<script src="{{ asset("libs/meter/script.js") }}"></script>
<script>
    var mediaQuery = window.matchMedia('(max-width: 911px)');

    var coverageGraph;

    if (mediaQuery.matches) {
        coverageGraph = document.getElementById('coverage-graph');
        erGraph = document.getElementById('er');
        cpmGraph = document.getElementById('cpm');
        pGraph = document.getElementById('projects');
    } else {
        coverageGraph = document.getElementById('coverage-graph');
        erGraph = document.getElementById('er');
        cpmGraph = document.getElementById('cpm');
        pGraph = document.getElementById('projects');
    }

    var data = {
        "orders": 2637
        , "earnings": 4750732.0
        , "sale_percent": 0.0
        , "fromDate": "2021-04-03"
        , "prices_history": [{
                "dt": "2024-04-18"
                , "price": 1684.0
            }
            , {
                "dt": "2024-04-19"
                , "price": 1725.0
            }
            , {
                "dt": "2024-04-20"
                , "price": 1725.0
            }
            , {
                "dt": "2024-04-21"
                , "price": 1725.0
            }
            , {
                "dt": "2024-04-22"
                , "price": 1704.0
            }
            , {
                "dt": "2024-04-23"
                , "price": 1776.0
            }
            , {
                "dt": "2024-04-24"
                , "price": 1848.0
            }
            , {
                "dt": "2024-04-25"
                , "price": 1725.0
            }
            , {
                "dt": "2024-04-26"
                , "price": 1949.0
            }
            , {
                "dt": "2024-04-27"
                , "price": 1949.0
            }
            , {
                "dt": "2024-04-28"
                , "price": 1949.0
            }
            , {
                "dt": "2024-04-29"
                , "price": 1949.0
            }
            , {
                "dt": "2024-04-30"
                , "price": 1949.0
            }
            , {
                "dt": "2024-05-01"
                , "price": 1949.0
            }
        , ]
    , }


    new Chart(coverageGraph, {
        type: 'bar'
        , data: {
            labels: data.prices_history.map(item => item.dt.split('-')[2])
            , datasets: [{
                label: 'Охваты'
                , data: data.prices_history.map(item => item.price)
            , }]
        }
        , options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    var labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    var data = {
        labels: labels
        , datasets: [{
            label: 'ER'
            , data: [10, 32, 45, 9, 55, 89, 123, 15, 102, 11, 15, 245]
            , borderColor: '#FE5E00'
            , backgroundColor: '#FAF5EF'
        , }, ]
    };

    new Chart(erGraph, {
        type: 'line'
        , data: data
        , options: {
            responsive: true
            , plugins: {
                legend: {
                    position: 'top'
                , }
            , }
        }
    , });


    var labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    var data = {
        labels: labels
        , datasets: [{
            label: 'CPM'
            , data: [144, 12, 555, 9, 55, 123, 123, 15, 102, 11, 51, 245]
            , borderColor: '#FE5E00'
            , backgroundColor: '#FAF5EF'
        , }, ]
    };

    new Chart(cpmGraph, {
        type: 'line'
        , data: data
        , options: {
            responsive: true
            , plugins: {
                legend: {
                    position: 'top'
                , }
            , }
        }
    , });

    var data = {
        labels: ['Всего', 'Выполнено']
        , datasets: [{
            label: 'Интеграции'
            , data: [126, 120]
            , backgroundColor: ['#98CBED', '#FE5E00']
        , }]
    };

    new Chart(pGraph, {
        type: 'pie'
        , data: data
        , options: {
            responsive: true
            , plugins: {
                legend: {
                    position: 'top'
                , }
            , }
        }
    , });

</script>
<script>
    var mediaQuery = window.matchMedia('(max-width: 911px)');

    var prices_ctx, orders_ctx;

    if (mediaQuery.matches) {
        prices_ctx = document.getElementById('prices-graph-mobile');
        orders_ctx = document.getElementById('orders-graph-mobile');
    } else {
        prices_ctx = document.getElementById('prices-graph-desktop');
        orders_ctx = document.getElementById('orders-graph-desktop');
    }

    var data = {}
    var orders = data.orders_history.map(item => item.orders);
    var prices = data.prices_history.map(item => item.price);
    var date = data.prices_history.map(item => item.dt.split('-')[2]);

    console.log(orders, prices, date);

    new Chart(orders_ctx, {
        type: 'bar'
        , data: {
            labels: data.prices_history.map(item => item.dt.split('-')[2])
            , datasets: [{
                label: 'Заказы'
                , data: data.orders_history.map(item => item.orders)
            , }]
        }
        , options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    new Chart(prices_ctx, {
        type: 'bar'
        , data: {
            labels: data.prices_history.map(item => item.dt.split('-')[2])
            , datasets: [{
                label: 'Выручка'
                , data: data.prices_history.map(item => item.price)
            , }]
        }
        , options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
<script src="{{ asset('js/wb.js') }}"></script>
@endsection
