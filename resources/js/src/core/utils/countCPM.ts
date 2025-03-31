function countCPM(cover:number, price:number):string|number{
    if (!cover) return '-';

    if (!price) return '-';

    const result = (price / cover) * 1000;

    return Math.round(result) === 0 ? (result).toFixed(3) : Math.round(result);
}

export {countCPM}

