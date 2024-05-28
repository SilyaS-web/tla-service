function getHost(e) {
    let t;
    switch (!0) {
        case e >= 0 && e <= 143:
            t = "01";
            break;
        case e >= 144 && e <= 287:
            t = "02";
            break;
        case e >= 288 && e <= 431:
            t = "03";
            break;
        case e >= 432 && e <= 719:
            t = "04";
            break;
        case e >= 720 && e <= 1007:
            t = "05";
            break;
        case e >= 1008 && e <= 1061:
            t = "06";
            break;
        case e >= 1062 && e <= 1115:
            t = "07";
            break;
        case e >= 1116 && e <= 1169:
            t = "08";
            break;
        case e >= 1170 && e <= 1313:
            t = "09";
            break;
        case e >= 1314 && e <= 1601:
            t = "10";
            break;
        case e >= 1602 && e <= 1655:
            t = "11";
            break;
        case e >= 1656 && e <= 1919:
            t = "12";
            break;
        case e >= 1920 && e <= 2045:
            t = "13";
            break;
        case e >= 2046 && e <= 2189:
            t = "14";
            break;
        case e >= 2090 && e <= 2405:
            t = "15";
            break;
        case e >= 2406 && e <= 2621:
            t = "16";
            break;
        default:
            t = "17"
    }
    return `basket-${t}.wbbasket.ru`
}

function getUrl(nm) {
    const r = parseInt(nm, 10);
    const n = ~~(r / 1e5);
    const a = ~~(r / 1e3);
    let o = getHost(n);
    return `https://${o}/vol${n}/part${a}/${r}/info/price-history.json`;
}


async function getStatistics(nm) {
    let response = await fetch(getUrl(nm));

    if (response.ok) {
        return json = await response.json();
    } else {
        alert("Ошибка HTTP: " + response.status);
    }
}


