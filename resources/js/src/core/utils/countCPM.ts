function countCPM(cover:number, price:number):number|string{
    if (!cover) return '-';

    if (!price) return '-';

    const result:number = (price / cover) * 1000;

    return Math.round(result) === 0 ? (result).toFixed(3) : Math.round(result);
}

export {countCPM}
