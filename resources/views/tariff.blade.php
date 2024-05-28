@extends('layout.layout')

@section('content')
<section class="tariff">
    <div class="tariff__container  _container">
        <div class="tariff__body">
            <div class="tariff__title title">
                Тарифы
            </div>
            <div class="profile-tabs__content-item">
                <div class="tab-content__plans plans">
                    <div class="plans__body">
                        <div class="plans__current">
                            <div class="plans__current-item">
                                <p class="plans__current-title">
                                    Ваш текущий тариф: <span> {{ auth()->user()->seller->tariff }}</span>
                                </p>
                            </div>
                            <div class="plans__current-item">
                                <p class="plans__current-title">
                                    Заявок осталось: <span>{{ auth()->user()->seller->remaining_tariff }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="planItem__container">
                            <div class="planItem planItem--free">
                                <div class="card">
                                    <div class="card__header">
                                        <h2>Начальный</h2>
                                    </div>
                                    <div class="card__desc">Оплатив этот тариф вы получите возможность создавать интеграции</div>
                                </div>

                                <div class="price">2500 ₽<span>/ месяц</span></div>

                                <ul class="featureList">
                                    <li>Поддержка чата</li>
                                    <li>Возможность создавать 500 интеграций в месяц</li>
                                </ul>
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="max-width:160px" type="submit">Оплатить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    let response = fetch("https://anabar.ai/api/chrome/v1/product/wb/150000211", {
        "headers": {
            "accept": "*/*"
            , "accept-language": "ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7"
            , "priority": "u=1, i"
            , "sec-ch-ua": "\"Google Chrome\";v=\"125\", \"Chromium\";v=\"125\", \"Not.A/Brand\";v=\"24\""
            , "sec-ch-ua-mobile": "?0"
            , "sec-ch-ua-platform": "\"Windows\""
            , "sec-fetch-dest": "empty"
            , "sec-fetch-mode": "cors"
            , "sec-fetch-site": "cross-site"
            , "cookie": "_ym_uid=1715183653727565142; _ym_d=1715183653; _ymab_param=tf7wZFLDwVBcQyli3tGkT4AH8FV2XqRvd2LdmTJirQRRWS6OZndTxIFRkfZ_r3R5HsOmGU7rBvwOwgkFCthtJhUzDH4; _ct_server=2600000000047472551; remember_token=218237|e9e573a6b3907b2dd8aa8b08371f48a4dc16dc59de313f9f365b4b09a7888182907281f316cf23bc91d57c86ad31fbeef41e0720133e3067bb588a11469e28c4; _hjSessionUser_3289482=eyJpZCI6IjFiMGY0ODQ3LTM0MGItNTY3ZC04ZTFlLWQyZTFhMjI1MmMwNiIsImNyZWF0ZWQiOjE3MTUxODQyMzQ4NjMsImV4aXN0aW5nIjp0cnVlfQ==; session=.eJwljktqxEAMRO_S6xjUUv_kyxi5JZGBxAnu8WrI3dNmdkVBvXqvsPlp4zOsLl_DPsL20LCGwtq6dqyAykC1ZmmdXHonRk7NCyqqKwBESliwRZibqN0ZISkJg1Kx3XPxvURLwLlmU2NpWDmbe2SwXLmCUNZIM5YGzVWIUrhFxrhMN3mGNdaYc2uTPPtfO7_lsGP2z_O6lYeN8fg53uoG6sSyLwK8Lwk1Lq0WWKjrPn-z1O43_hp2vhcYG1INf_8ABkxz.ZlUq6A.0B3D4AtxjQPBx2hgXN5OR2F-HBA"
            , "Referer": "https://www.wildberries.ru/catalog/150000211/detail.aspx"
            , "Referrer-Policy": "no-referrer-when-downgrade"
        }
        , "body": null
        , "method": "GET"
    });

    if (response.ok) {
        console.log(response.json());
    } else {
        alert("Ошибка HTTP: " + response.status);
    }

</script>
@endsection
