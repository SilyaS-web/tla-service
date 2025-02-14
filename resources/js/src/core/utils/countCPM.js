function countCPM(cover){
    if (!cover) return '-';

    if (!this.product_price) return '-';

    const result = (this.product_price / cover) * 1000;

    return Math.round(result) === 0 ? (result).toFixed(3) : Math.round(result);
}

export {countCPM}

